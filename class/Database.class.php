<?php
	class Database
	{
		private $servidor = "localhost";
		private $porta	  = "3306";
		private $usuario  = "u126243361_root";
		private $senha	  = "meepmeep";
		private $base	  = "u126243361_laser";
		private $conexao;
		
		function __construct(){
			$this->conexao = mysqli_connect($this->servidor,$this->usuario,$this->senha,$this->base,$this->porta)
			or die("Failed to connect to database".mysqli_connect_error());
		}
		
		function __destruct(){
			mysqli_close($this->conexao);
			$this->conexao = null;
		}
		
		function salvarCalculo($calculo, $wavelength, $comentario, $country_code,$IP){
			$conexao = $this->conexao;
			
			$distancia = $calculo->getDistancia();
			$lente = $calculo->getLente();
			
			$stmt = $conexao->prepare("INSERT INTO calculations (distancia,  lente,  wavelength,  comentario,  country_code,  IP) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param(						  "ddisss", $distancia, $lente, $wavelength, $comentario, $country_code, $IP);
			$stmt->execute();
			$stmt->close();
		}
		
		function suprimirRegistrosIP($IP){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("UPDATE `calculations` SET IP='0.0.0.0', comentario='' WHERE IP=?");
			$stmt->bind_param(						  										 "s", $IP);
			$stmt->execute();
			$stmt->close();
		}
		
		function qtdCalculos(){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("SELECT max(id) as calculations FROM `calculations`");
			$stmt->execute();
			$arr = $stmt->get_result()->fetch_row();
			$qtdCalculos = $arr[0];
			//if(!$arr) exit('No rows');
			$stmt->close();
			return $qtdCalculos;
		}

		function tabelaCalculos(){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("SELECT * FROM calculations ORDER BY id DESC LIMIT 20");
			$stmt->execute();
			$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			//if(!$arr) exit('No rows');
			$stmt->close();
			return $arr;
		}
		
		function tabelaCalculosIP($IP){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("SELECT * FROM calculations where IP=? ORDER BY id DESC LIMIT 10");
			$stmt->bind_param(						  			 "s", $IP);
			$stmt->execute();
			$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			//if(!$arr) exit('No rows');
			$stmt->close();
			return $arr;
		}
		
		function graficoWavelength(){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("select `wavelength` as `range`, count(*) as 'count'
										from (
										  select case
											when `wavelength` between 000 and 350 then '000-350'   
											when `wavelength` between 351 and 400 then '351-400'  
											when `wavelength` between 401 and 450 then '401-450'  
											when `wavelength` between 451 and 500 then '451-500'  
											when `wavelength` between 501 and 555 then '501-555'  
											when `wavelength` between 556 and 600 then '556-600'  
											when `wavelength` between 601 and 700 then '601-700'  
											else '700+'
											 end as `wavelength`
										  from calculations) t
										  group by
										  `wavelength`");
			$stmt->execute();
			$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			//if(!$arr) exit('No rows');
			$stmt->close();
			return $arr;
		}
		
		function graficoLente(){
			$conexao = $this->conexao;
			$stmt = $conexao->prepare("SELECT DISTINCT
									  lente,
									  COUNT(1) AS `count`
									FROM
									  calculations
									GROUP BY
									  lente");
			$stmt->execute();
			$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			//if(!$arr) exit('No rows');
			$stmt->close();
			return $arr;
		}
		
		function criarBanco(){ 
			$conexao = mysqli_connect($this->servidor,$this->usuario,$this->senha,"",$this->porta);

				if(mysqli_connect_errno()){
					die ('ERRO '.mysqli_connect_errno().' : '.utf8_encode(mysqli_connect_error()));
				}
				else{

					mysqli_query($conexao,"CREATE DATABASE ".$this->base.";");
					
					$conexao = mysqli_connect($this->servidor,$this->usuario,$this->senha,$this->base,$this->porta);
					
					mysqli_query($conexao,"
						CREATE TABLE calculations(
							id					INTEGER		NOT NULL	auto_increment,
							distancia			DOUBLE		NOT NULL,
							lente				DOUBLE		NOT NULL,
							wavelength			DOUBLE		NOT NULL,
							comentario			VARCHAR(30),
							country_code		VARCHAR(4)	NOT NULL,
							IP					VARCHAR(50),
							PRIMARY KEY (id)
						);
					");
					
					for ($i = 381; $i <= 704; $i+=17)
					{
						$sql = "INSERT INTO calculations	(distancia	, lente	, wavelength, comentario, country_code	, IP) 
								VALUES 						(200		,500	,".$i."		,'Teste'	, 'br'		,'0.0.0.0')";
						mysqli_query($conexao, $sql);
						
						echo $i ."nm<br>";
					}
					echo "<b>OK</b>";
					mysqli_close($conexao);
				}
		}
	}
?>
