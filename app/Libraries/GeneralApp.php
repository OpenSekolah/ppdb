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
