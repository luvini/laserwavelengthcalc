<font face=consolas>
<style>
	.noSpace {
		letter-spacing: -1px;
	}
</style>
<div class=noSpace>
<?php
	include_once '../class/calculo.class.php';
	
	echo "<font style='font-size:4px'>";
	for ($i = 320; $i <= 814; $i++) {
		echo "<font color=".Calculo::wavtorgb($i).">█</font>";
	}echo "</font></div><br>
	";
	
	for ($i = 320; $i <= 814; $i++) {
		echo "<font color=".Calculo::wavtorgb($i).">█ $i"."nm = ".Calculo::wavtorgb($i)."<br></font>
		";
	}
?>