<?php
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\ApplicationConfig;

function generalMoney($number = 0, $format = 'RP.') {
	return $format . ' ' . number_format($number, 0, ',', '.');
}

function generalRandomHexColor()
{
	$color = '#';
	for ($i = 0; $i < 6; $i++) {
		$color .= dechex(rand(0, 15));
	}
	return $color;
}

function generalRandomRGBA($radom_alpha)
{
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    // $alpha = (rand(0, 100) / 100); // Generating an alpha value between 0 and 1
	if($radom_alpha) {
		$alpha = $radom_alpha;
	} else {
		$alpha = (rand(0, 100) / 100); // Generating an alpha value between 0 and 1
	}
    

    return "rgba($red, $green, $blue, $alpha)";
}

function generalInputText($string = "") {
	return strip_tags(trim(ucwords($string)));
}

function generalUuidToNumber(string $str) {
	$chars = str_split($str);
	$count = 0;
	foreach($chars as $char){
		$count += ord($char);
	}

	return $count;
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
