<?php
	class Tabela{
		
		private $htmlclass;
		private $headers;
		private $dados;
		private $exceptions;
		
		function __construct($class, $headers, $dados, $exceptions=[]){
			$this->htmlclass = $class;
			$this->headers = $headers;
			$this->dados = $dados;
			$this->exceptions = $exceptions;
		}

		public function __toString(){
			return static::criaTabela($this->htmlclass, $this->headers, $this->dados, $this->exceptions);
		}

		static function criaTabela($class, $headers, $dados, $exceptions=[]){
			$tabela = "<table class=".$class."><tr>";
			$chaves = array_keys($headers);
				foreach ($headers as $chaveHeaders => $dadosHeader){
					$tabela .= "<th>".htmlspecialchars($dadosHeader)."</th>";
				}
			$tabela .= "</tr>";
			
			foreach ($dados as $linha){
				$tabela .= "<tr>";
				foreach($chaves as $celulaKey){
					if(in_array($celulaKey, $exceptions)){
						$tabela .= "<td>".$linha[$celulaKey]."</td>";
					}
					else{
						$tabela .= "<td>".htmlspecialchars($linha[$celulaKey])."</td>";
					}
				}
				$tabela .= "</tr>";
			}
			$tabela .= "</table>";
			return $tabela;
		}
	}
?>