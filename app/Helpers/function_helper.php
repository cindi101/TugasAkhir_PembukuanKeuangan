<?php

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");	
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);	
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

function get_bulan($number){
	$arr_bulan = array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
	return $arr_bulan[$number];
}

function get_kode($panjang){
	$randomkode = array(
	 range(1,9),
	 range('a','z'),
	 range('A','Z')
	);
	$karakter = array();
	foreach($randomkode as $key=>$val){
	 foreach($val as $k=>$v){
				   $karakter[] = $v;
	 }
	}
	$randomkode = null;
	for($i=1; $i<=$panjang; $i++){
	 // mengambil array secara acak
	 $randomkode .= $karakter[rand($i, count($karakter) - 1)];
	}
	return $randomkode;
   }

function split_log($text){
	$string = strpos($text, '##');
	$catatan = '<ul>';
	if($string !== FALSE){
		$string2 = explode('##',$text);
		$hitung  = count($string2);
		// var_dump($hitung);
		foreach($string2 as $t){
			$result = str_replace('\n\n', '<br/>', $t);
			$catatan .= '<li>'.$result.'</li>';
		}		
	}else{
		$catatan .= '<li>'.$text.'</li>';
	}
	$catatan .= '</ul>';
	return $catatan;
}

function intCodeRandom($length = 8){
	$intMin = (10 ** $length) / 10; // 100...
	$intMax = (10 ** $length) - 1;  // 999...

	$codeRandom = mt_rand($intMin, $intMax);

	return $codeRandom;
}