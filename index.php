<?php include_once 'class/Autoloader.class.php';?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<title>Laser Wavelength by Difraction Calculator</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <header>
	<?php echo new Header(substr(__FILE__, strlen(__DIR__)+1));	?>
  </header>
	<font face=verdana>
	<center>
	
	<h1>Laser Wavelength by Difraction Calculator</h1>
		<p>
			<img src='img/photo.png' width=600>
			<table class=formulario>
			<form method='post'>
				<tr>
					<td>
					Distance between wall and difraction grating <font face=consolas size=4><b>(L)</b></font>
					<input type='text' name='distanciaForm' size='14' placeholder='cm' required>
					</td>
				</tr>
				<tr>
					<td>
					Distance between the 0th and 1st interference <font face=consolas size=4><b>(D)</b></font>
					<input type='text' name='desvioForm' size='14' placeholder='cm' required>
					</td>
				</tr>
				<tr>
					<td>
					Lines per Millimeter on the difraction grating lens <font face=consolas size=4><b>(g)</b></font>
					<input type='text' name='lenteForm' size='14' required>
					</td>
				</tr>
				<tr>
					<td>
					Comment (30 chars max)
					<input type='text' name='comentarioForm' size='14' maxlength="30">
					</td>
				</tr>
				<tr>
					<td>
					Save to history (IP will be stored)<input type="checkbox" name="agree">
					<input type='submit' name='calcular' value='Calculate'>
					</td>
				</tr>
			</form>
				<tr>
					<td>
					<?php
					$geoip = new GeoIP();

					$banco = new Database;
					
					if(isset($_POST['calcular']))
					{   
						$calculo = new Calculo($_POST['distanciaForm'],$_POST['desvioForm'],$_POST['lenteForm']);
						$wavelength = $calculo->calcularWavelength();
						
						If (!$wavelength) {
							echo "<font color=RED><strong>ERROR!</strong></font>";
						}
						else
						{
							if(isset($_POST['agree']))
							{   
								$banco->salvarCalculo($calculo, $wavelength, $_POST['comentarioForm'], $geoip->country_code(),$geoip->ip);
							}
							else{
								$banco->salvarCalculo($calculo, $wavelength, $_POST['comentarioForm'], $geoip->country_code(),"0.0.0.0");
							}
							echo '<center><h1>The wavelength is <b>'.$wavelength.'nm</b><font color='.Calculo::wavtorgb($wavelength).'> █</font></h1></center>';
						}
					}
					if(isset($_POST['forget']))
					{   
						$banco->suprimirRegistrosIP($geoip->ip);
					}
					?> 
					</td>
				</tr>
			</table>
			<?php
				$tabelaCalculosIP = $banco->tabelaCalculosIP($geoip->ip);

				If ($tabelaCalculosIP){
					echo "<p>Last 10 saved calculations done from your IP <img height=16 src='http://api.hostip.info/images/flags/".(new GeoIP())->country_code().".gif'><br>";
					
				$headers = [
						'distancia' => 'Wall Distance(cm)',
						'lente' => 'Difraction Grating',
						'wavelength' => 'Wavelength(nm)',
						'comentario' => 'Comment',
						];
				$dados = [];
				foreach ($tabelaCalculosIP as $dado) {
					$dado['wavelength'] = '<b><font color='.Calculo::wavtorgb($dado['wavelength']).">█ </font>".$dado['wavelength'].'nm</b>';
					$dados[]=$dado;
				}
				echo new Tabela('lista', $headers, $dados, ['wavelength']);
					
				echo"<form method='post'><input type='submit' name='forget' value='Forget me!'></form></p>";
				}
				else{
					echo "<p><font face=consolas size=2>There are no calculatios made from your IP or you have not given permission to store it</font></p>";
				}
			?>
		</p>	
	</font>
  </body>
</html>