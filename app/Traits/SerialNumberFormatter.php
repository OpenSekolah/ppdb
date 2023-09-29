<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Models\AppConfig;

trait SerialNumberFormatter
{
    protected static $model;
    protected static $classbasename;
    private static $nextSequenceNumber;

    /**
     * Handle model event
     */
    protected static function bootSerialNumberFormatter() {
        static::creating(function ($model) {
            self::$model = $model;  
            self::$classbasename = strtolower(class_basename(self::$model));

            if($serial = self::generateSerialNumber()) {
                $model->sequence_number = self::$nextSequenceNumber;
                $model->register_number = $serial;
            }
        });
    }

    private static function getSetting() {
        $settings = AppConfig::getSettingMulty([
            'ppdb_series',
            'ppdb_delimeter',
            'ppdb_sequence',
        ]);

        $data = [];
        if(self::$classbasename == 'registerform') {
            $data = [
                'series' => $settings['ppdb_series'] ?? "PPDB",
                'delimeter' => $settings['ppdb_delimeter'] ?? "-",
                'sequence' => $settings['ppdb_sequence'] ?? 7,
            ];
        }
        
        return $data;
    }

    private static function setSequence() {
        $validate = ["registerform"];
        if(in_array(self::$classbasename,  $validate)) {
            $last = self::$model::orderBy('sequence_number', 'DESC')
                ->where('sequence_number', '<>', null)
                ->take(1)
                ->first();

            self::$nextSequenceNumber = ($last) ? $last->sequence_number + 1 : 1;
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private static function generateSerialNumber()
    {
        if(self::setSequence()) {
            $setting = self::getSetting();
            $series = $setting['series'] ?? false;
            $delimeter = $setting['delimeter'] ?? false;
            $sequence = $setting['sequence'] ?? false;
            $serialNumber = false;
            if($series && $delimeter && $sequence ) {
                //$number = str_pad(self::$nextSequenceNumber, $sequence, 0, STR_PAD_LEFT);
                $padded = Str::padLeft(self::$nextSequenceNumber, $sequence, 0);
                $serialNumber = "{$series}{$delimeter}{$padded}";
            }

            return $serialNumber;
        }
        
        return false;
    }
}
