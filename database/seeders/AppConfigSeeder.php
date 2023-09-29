<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppConfig;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = [
			['option' => 'app_name', 'value' => 'PPDB SMK ABC'],
			['option' => 'timezone', 'value' => 'Asia/Jakarta'],
            ['option' => 'ppdb_series', 'value' => 'PPDB'],
			['option' => 'ppdb_delimeter', 'value' => '-'],
			['option' => 'ppdb_sequence', 'value' => '7'],
		];
		
		foreach($arrayData as $value) {
			AppConfig::create($value);
		}
    }
}
