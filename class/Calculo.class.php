<?php
class Calculo{
	private $distancia;
	private $desvio;
	private $lente;
	
	function __construct($distancia,$desvio,$lente){
		$this->distancia = $distancia;
		$this->desvio	 = $desvio;
		$this->lente	 = $lente;	
	}
	
	public function getDistancia(){
		return $this->distancia;
	}
	
	public function getDesvio(){
		return $this->desvio;
	}
	
	public function getLente(){
		return $this->lente;
	}
	
	function calcularWavelength(){
		$distancia = str_replace (",", ".", $this->getDistancia());
		$desvio	   = str_replace (",", ".", $this->getDesvio()	 );
		$lente	   = str_replace (",", ".", $this->getLente()	 );
		
		if (!is_numeric($distancia)&& $distancia <= 0){return false;}
		if (!is_numeric($desvio	  )&& $desvio	 <= 0){return false;}
		if (!is_numeric($lente	  )&& $lente	 <= 0){return false;}
		
		$wavelenght = round(1000000/$lente*SIN(ATAN(($desvio)/($distancia))));
		
		return $wavelenght;
	}
	
	static function wavtorgb($w){
		$w = intval($w);

		if($w >= 320 AND $w < 440){
			$r = abs($w - 440) / (440 - 350);
			$g = 0.0;
			$b = 1.0;

		}elseif($w >= 440 AND $w < 490){
			$r = 0.0;
			$g = abs($w - 440) / (490 - 440);
			$b = 1.0;

		}elseif($w >= 490 AND $w < 510){
			$r = 0.0;
			$g = 1.0;
			$b = abs($w - 510) / (510 - 490);

		}elseif($w >= 510 AND $w < 580){
			$r = abs($w - 510) / (580 - 510);
			$g = 1.0;
			$b = 0.0;

		}elseif($w >= 580 AND $w < 645){
			$r = 1.0;
			$g = abs($w - 645) / (645 - 580);
			$b = 0.0;

		}elseif($w >= 645 AND $w < 780){
			$r = 1.0;
			$g = 0.0;
			$b = 0.0;

		}else{
			$r = 1.0;
			$g = 0.0;
			$b = 0.0;
		}

		if($w >= 320 AND $w < 420){
			$sss = 0.3 + 0.7*($w - 350) / (420 - 350);

		}elseif($w >= 420 AND $w <= 700){
			$sss = 1.0;

		}elseif($w > 700 AND $w <= 814){
			$sss = 0.3 + 0.7*(780 - $w) / (780 - 700);
		}else{
			$sss = 0.0;
		}
		$sss *= 255;

		$r = str_pad(dechex(intval($sss * $r)), 2, "0", STR_PAD_LEFT);
		$g = str_pad(dechex(intval($sss * $g)), 2, "0", STR_PAD_LEFT);
		$b = str_pad(dechex(intval($sss * $b)), 2, "0", STR_PAD_LEFT);

		$return = "#$r$g$b";
		return $return;
	}
}
?>