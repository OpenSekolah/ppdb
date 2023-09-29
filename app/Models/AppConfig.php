<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class AppConfig extends Model
{
    use HasFactory, Uuid;

	protected $fillable = [
		'option',
		'value',
    ];

    public $timestamps = true;

    public $incrementing = false;

	public static function setSetting($key, $setting)
    {
        $old = AppConfig::where('option', $key)->first() ?? false;

        if ($old) {
            $old->value = $setting;
            $old->save();

            return;
        }

        $set = new AppConfig();
        $set->option = $key;
        $set->value = $setting;
        $set->save();
    }

    public static function getSetting($key)
    {
        $setting = static::where('option', $key)->first() ?? false;

        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }

	public static function getSettingMulty($key = [])
    {
        $setting = static::whereIn('option', $key)->get();

        if ($setting) {
            $result = [];
			foreach($setting as $value) {
				$result[$value->option] = $value->value;
			}

			return $result;
        } else {
            return [];
        }
    }

	public static function createWebApp($request) {
		$data = $request;

		foreach($data as $key => $value) {
			static::setSetting($key, $value);
		}
	}
}
