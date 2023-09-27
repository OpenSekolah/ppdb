<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SkillCompetence;

class SkillCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$arrayData = [
			[
				'name' => 'TBSM',
				'desc' => 'Teknik dan Bisnis Sepeda Motor'
			],
			[
				'name' => 'TKRO',
				'desc' => 'Teknik Kendaraan Ringan Otomotif'
			],
			[
				'name' => 'PPLG',
				'desc' => 'Pengembangan Perangkat Lunak dan Gim',
			],
			[
				'name' => 'MULTIMEDIA',
				'desc' => 'BROADCASTING & PERFILMAN'
			],
			[
				'name' => 'APHP',
				'desc' => 'Agribisnis Pengolahan Hasil Pertanian'
			],
		];

		foreach($arrayData as $value) {
			SkillCompetence::create($value);
		}

    }
}
