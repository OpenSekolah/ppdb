<?php

function generalMoney($number = 0, $format = 'RP.') {
	return $format . ' ' . number_format($number, 0, ',', '.');
}

function generalExplodeValidation($data) {
	return implode(",",array_keys(generalGetArrayId($data)));
}

function generalGetArrayId($array = []) {
	$newArray = [];
	foreach($array as $value) {
		if($value['id'] !== '') {
			$newArray[$value['id']] = $value['name'];
		}
	}

	return $newArray;
}

function generalSelectFormat($datas = []) {
	$array = [
		['id' => "", 'name' => '++++++Pilih++++++']
	];
	foreach($datas as $key => $value) {
		$array[] = [
			'id' => $value->id,
			'name' => $value->name
		];
	}

	return $array;
}

function generalRegisterStatus() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => 'verified',
			'name' => 'Diverifikasi'
		],
		[
			'id' => 'accepted',
			'name' => 'Diterima'
		],
		[
			'id' => 'reserved',
			'name' => 'Dicadangkan'
		],
	];
}

function generalStatus() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => 0,
			'name' => 'Tidak Aktif'
		],
		[
			'id' => 1,
			'name' => 'Aktif'
		],
	];
}

function generalResidence() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => 'Tinggal dengan Orangtua/Wali',
			'name' => 'Tinggal dengan Orangtua/Wali'
		],
		[
			'id' => 'Ikut saudara/kerabat',
			'name' => 'Ikut saudara/kerabat'
		],
		[
			'id' => 'Asrama Madrasah',
			'name' => 'Asrama Madrasah'
		],
		[
			'id' => 'Kontrak/kost',
			'name' => 'Kontrak/kost'
		],
		[
			'id' => 'Tinggal di Asrama Pesantren',
			'name' => 'Tinggal di Asrama Pesantren'
		],
		[
			'id' => 'Panti asuhan',
			'name' => 'Panti asuhan'
		],
		[
			'id' => 'Rumah Singgah',
			'name' => 'Rumah Singgah'
		],
		[
			'id' => 'Lainnya',
			'name' => 'Lainnya'
		],
	];
}

function generalTransportation() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => 'Sepeda',
			'name' => 'Sepeda'
		],
		[
			'id' => 'Sepeda Motor',
			'name' => 'Sepeda Motor'
		],
		[
			'id' => 'Mobil Pribadi',
			'name' => 'Mobil Pribadi'
		],
		[
			'id' => 'Antar Jemput Sekolah',
			'name' => 'Antar Jemput Sekolah'
		],
		[
			'id' => 'Angkutan Umum',
			'name' => 'Angkutan Umum'
		],
		[
			'id' => 'Perahu/Sampan',
			'name' => 'Perahu/Sampan'
		],
		[
			'id' => 'Lainnya',
			'name' => 'Lainnya'
		],
	];
}

function generalDistance() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => 'Kurang dari 5 km',
			'name' => 'Kurang dari 5 km'
		],
		[
			'id' => 'Antara 5-10 km',
			'name' => 'Antara 5-10 km'
		],
		[
			'id' => 'Antara 11-20 km',
			'name' => 'Antara 11-20 km'
		],
		[
			'id' => 'Antara 21-30 km',
			'name' => 'Antara 21-30 km'
		],
		[
			'id' => 'Lebih dari 30 km',
			'name' => 'Lebih dari 30 km'
		]
	];
}

function generalTravelingTime() {
	return [
		[
			'id' => '++++++Pilih++++++',
			'name' => ''
		],
		[
			'id' => '1-10 menit',
			'name' => '1-10 menit'
		],
		[
			'id' => '10-19 menit',
			'name' => '10-19 menit'
		],
		[
			'id' => '20-29 menit',
			'name' => '20-29 menit'
		],
		[
			'id' => '30-39 menit',
			'name' => '30-39 menit'
		],
		[
			'id' => '1-2 jam',
			'name' => '1-2 jam'
		],
		[
			'id' => '>2 jam',
			'name' => '>2 jam'
		]
	];
}
