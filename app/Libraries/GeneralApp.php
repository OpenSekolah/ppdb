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
		if($value['id'] != '') {
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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
			'id' => '',
			'name' => '++++++Pilih++++++'
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

function generalEducation() {
	return [
		[
			'id' => '',
			'name' => '++++++Pilih++++++'
		],
		[
			'id' => 'SD/Sederajat',
			'name' => 'SD/Sederajat'
		],
		[
			'id' => 'SMP/Sederajat',
			'name' => 'SMP/Sederajat'
		],
		[
			'id' => 'SMA/Sederajat',
			'name' => 'SMA/Sederajat'
		],
		[
			'id' => 'D1',
			'name' => 'D1'
		],
		[
			'id' => 'D2',
			'name' => 'D2'
		],
		[
			'id' => 'D3',
			'name' => 'D3'
		],
		[
			'id' => 'D4/S1',
			'name' => 'D4/S1'
		],
		[
			'id' => 'S2',
			'name' => 'S2'
		],
		[
			'id' => 'S3',
			'name' => 'S3'
		],
		[
			'id' => 'Tidak Bersekolah',
			'name' => 'Tidak Bersekolah'
		],
	];
}

function generalWork() {
	return [
		[
			'id' => '',
			'name' => '++++++Pilih++++++'
		],
		[
			'id' => 'Tidak Bekerja',
			'name' => 'Tidak Bekerja'
		],
		[
			'id' => 'Pensiunan',
			'name' => 'Pensiunan'
		],
		[
			'id' => 'PNS',
			'name' => 'PNS'
		],
		[
			'id' => 'TNI/Polisi',
			'name' => 'TNI/Polisi'
		],
		[
			'id' => 'Guru/Dosen',
			'name' => 'Guru/Dosen'
		],
		[
			'id' => 'Pegawai Swasta',
			'name' => 'Pegawai Swasta'
		],
		[
			'id' => 'Wiraswasta',
			'name' => 'Wiraswasta'
		],
		[
			'id' => 'Pengacara/Jaksa/Hakim/Notaris',
			'name' => 'Pengacara/Jaksa/Hakim/Notaris'
		],
		[
			'id' => 'Seniman/Pelukis/Artis/Sejenis',
			'name' => 'Seniman/Pelukis/Artis/Sejenis'
		],
		[
			'id' => 'Dokter/Bidan/Perawat',
			'name' => 'Dokter/Bidan/Perawat'
		],
		[
			'id' => 'Pilot/Pramugara',
			'name' => 'Pilot/Pramugara'
		],
		[
			'id' => 'Pedagang',
			'name' => 'Pedagang'
		],
		[
			'id' => 'Petani/Peternak',
			'name' => 'Petani/Peternak'
		],
		[
			'id' => 'Nelayan',
			'name' => 'Nelayan'
		],
		[
			'id' => 'Buruh (Tani/Pabrik/Bangunan)',
			'name' => 'Buruh (Tani/Pabrik/Bangunan)'
		],
		[
			'id' => 'Sopir/Masinis/Kondektur',
			'name' => 'Sopir/Masinis/Kondektur'
		],
		[
			'id' => 'Politikus',
			'name' => 'Politikus'
		],
		[
			'id' => 'Lainnya',
			'name' => 'Lainnya'
		],
	];
}

function generalIncome() {
	return [
		[
			'id' => '',
			'name' => '++++++Pilih++++++'
		],
		[
			'id' => 'Kurang dari 500.000',
			'name' => 'Kurang dari 500.000'
		],
		[
			'id' => '500.000 - 1.000.000',
			'name' => '500.000 - 1.000.000'
		],
		[
			'id' => '1.000.001 - 2.000.000',
			'name' => '1.000.001 - 2.000.000'
		],
		[
			'id' => '2.000.001 - 3.000.000',
			'name' => '2.000.001 - 3.000.000'
		],
		[
			'id' => '3.000.001 - 5.000.000',
			'name' => '3.000.001 - 5.000.000'
		],
		[
			'id' => 'Lebih dari 5.000.000',
			'name' => 'Lebih dari 5.000.000'
		],
		[
			'id' => 'Tidak ada',
			'name' => 'Tidak ada'
		],
		
	];
}

function generalParentGuardianStatus() {
	return [
		[
			'id' => '',
			'name' => '++++++Pilih++++++'
		],
		[
			'id' => 'Masih Hidup',
			'name' => 'Masih Hidup'
		],
		[
			'id' => 'Meninggal Dunia',
			'name' => 'Meninggal Dunia'
		],
		[
			'id' => 'Tidak Diketahui',
			'name' => 'Tidak Diketahui'
		],
		
	];
}
