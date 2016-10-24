<?php 
	$u = $_POST["iduser"];
	require_once "db/users/".$u."/config.php";
	$__config__["tictac"] = intval($_POST["tictac"]) * 1000;
	file_put_contents("db/users/".$u."/config.php",  "<?php\n\t".'$__config__'." = " . var_export($__config__, true) . ";\n?>");
	header("Location: collected.php?u=".$u);
?>