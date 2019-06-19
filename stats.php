<?php
	include_once 'class/Autoloader.class.php';
	
	$banco = new Database;
	
	$qtdCalculos 	   = $banco->qtdCalculos();
	$tabelaCalculos    = $banco->tabelaCalculos();
	$graficoLente      = $banco->graficoLente();
	$graficoWavelength = $banco->graficoWavelength();
	
	If ($graficoWavelength){
		$dadosWavelength = "";
		$dadosCorWavelength = "";
		foreach ($graficoWavelength as $key=>&$dados) {
			$dadosWavelength = $dadosWavelength ."['".$dados['range']."nm',".$dados['count']."],";
			$dadosCorWavelength = $dadosCorWavelength .$key.":{color:'".Calculo::wavtorgb((substr($dados['range'],0,3))+40)."'},";
		}
	}
	
	If ($graficoLente){
		$dadosLente = "";
		foreach ($graficoLente as &$dados) {
			$dadosLente = $dadosLente ."['".$dados['lente']."',".$dados['count']."],";
		}
	}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<title>Stats</title>
    <link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="gstatic/loader.js""></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {

        var dataWavelength = google.visualization.arrayToDataTable([
          ['Wavelength', 'Wavelength'],
          <?php echo $dadosWavelength;?>
        ]);

        var optionsWavelength = {
		  is3D: true,
          title: 'Wavelength',
		  slices: {<?php echo $dadosCorWavelength;?>},
		  width: '100%',
			height: '250',
			chartArea:{
				left:15,
				top: 15,
				width: '100%',
				height: '250',
			}
        };
		var piechartWavelength = new google.visualization.PieChart(document.getElementById('piechartWavelength'));
		piechartWavelength.draw(dataWavelength, optionsWavelength);
        
		var dataLente = google.visualization.arrayToDataTable([
          ['Difraction Grating', 'Grating'],
          <?php echo $dadosLente;?>
        ]);

        var optionsLente = {
			is3D: true,
			title: 'Difraction Grating',
			width: '100%',
			height: '250',
			chartArea:{
				left:15,
				top: 15,
				width: '100%',
				height: '250',
			}
        };
        var piechartLente = new google.visualization.PieChart(document.getElementById('piechartLente'));
		piechartLente.draw(dataLente, optionsLente);
        
      }
    </script>
  </head>
  <body>
  <header>
	<?php echo new Header(substr(__FILE__, strlen(__DIR__)+1)); ?>
  </header>
	<font face=verdana>
		<center>
		<h1 style='margin:10px'>Statistics</h1>
		
		<?php
			If (!$tabelaCalculos) {
				echo "
				<p>
					No calculations have been done up to this moment<br>
				</p>
				";
			}
			else {
				echo "
				<p>
					<b>".$qtdCalculos."</b> calculations have been done up to this moment<br>
											The last 20 are shown in the table bellow
				</p>";

				$headers = [
							'distancia' => 'Wall Distance(cm)',
							'lente' => 'Difraction Grating',
							'wavelength' => 'Wavelength(nm)',
							'comentario' => 'Comment',
							'country_code' => 'Location'
							];
				$dados = [];
				foreach ($tabelaCalculos as $dado) {
					$dado['wavelength'] = '<b><font color='.Calculo::wavtorgb($dado['wavelength']).">█ </font>".$dado['wavelength'].'nm</b>';
					$dado['country_code'] = '<img height=16 src="http://api.hostip.info/images/flags/'.$dado['country_code'].'.gif">';
					$dados[]=$dado;
				}
				echo new Tabela('lista', $headers, $dados, ['wavelength','country_code']);
				
				echo'
				<br>
				<table>
					<tr>
						<td><div id="piechartLente"		 style="width: 380px; height: 250px;"></div></td>
						<td><div id="piechartWavelength" style="width: 380px; height: 250px;"></div></td>
					</tr>
				</table>
				';
			}
		?>
	</font>
  </body>
</html>