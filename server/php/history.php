<?php
	require_once "init_user.php";
	require $folder."history.php";
	array_push($__history__, array("url"=>$_POST["url"],"date"=>date("'Y-m-d-_H-i-s'")));
	file_put_contents($folder."history.php", "<?php\n\t".'$__history__'." = " . var_export($__history__, true) . ";\n?>");
?>