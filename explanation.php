<?php include_once 'class/Autoloader.class.php';?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<title>Explanation</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
		<?php echo new Header(substr(__FILE__, strlen(__DIR__)+1)); ?>
	</header>
	<font face=verdana>
	<center>
	
	<h1>Explanation</h1>
	<table class=formulario>
		<tr>
			<td style="text-align: left;">
				<center><img src='img/diagram.png' width=539></center>
				
				<p>
					The wavelenght of a laser can be calculated from 3 variables:  <br><br>
					
					<font face=consolas>
					g = Lines/mm in the difraction grating<br>
					D = Distance from 0th to 1st interference<br>
					L = Distance from wall to difraction grating<br>
					</font>
				</p>
				
				<p>
					<b>The formula</b><br>
					<font face=consolas size=4>
					=(1000000/<b>G</b>*SEN(ATAN((<b>L</b>)/(<b>D</b>))))
					<br>
					</font>
				</p>
				
				<center>
					<img src='img/formula.png' width=480><br>
					
					<iframe width="539" height="304" src="https://www.youtube.com/embed/i9WS7Jo2TAY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
					<a href='https://youtu.be/i9WS7Jo2TAY'><font size=1 color=grey>Video explanation by Brainiac75 on Youtube</font></a>
				</center>
				
			</td>
		</tr>	
	</table><br>
	</font>
  </body>
</html>