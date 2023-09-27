<?php

function generalMoney($number = 0, $format = 'RP.') {
	return $format . ' ' . number_format($number, 0, ',', '.');
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

function generalStatus() {
	return [
		[
			'id' => '',
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
