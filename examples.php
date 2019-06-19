<?php include_once 'class/Autoloader.class.php';?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<title>Examples</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <header>
	<?php echo new Header(substr(__FILE__, strlen(__DIR__)+1));	?>
  </header>
	<font face=verdana>
	<center>
	
	<h1>Examples</h1>
	<table>
		<tr>
			<td style="text-align: center;">
				<img src='img/lasersComparison.png' width=756><br><br>
				
				<table class=lista>
				<tr>
					<th>Laser label					</th>
					<th>Wall Distance(cm)			</th>
					<th>Interference Distance(cm)	</th>
					<th>Difraction Grating			</th>
					<th>Calculated Wavelength		</th>
				</tr>
				<tr style='color:blue'>
					<td>405</td>
					<td>200</td>
					<td>42,3</td>
					<td>500</td>
					<td>414</td>
				</tr>
				<tr style='color:green'>
					<td>532</td>
					<td>200</td>
					<td>55,6</td>
					<td>500</td>
					<td>536</td>
				</tr>
				<tr style='color:red'>
					<td>650</td>
					<td>200</td>
					<td>70,7</td>
					<td>500</td>
					<td>667</td>
				</tr>
				</table>
			</td>
		</tr>	
	</table><br>
	</font>
  </body>
</html>