<?php
	class Header{
		
		public $filename;
		public $dataset=[
				'index.php'=>'Calculator',
				'explanation.php'=>'Explanation',
				'examples.php'=>'Examples',
				'http://webchat.freenode.net?channels=laserwavelengthcalc&uio=MTY9dHJ1ZSY5PXRydWUmMTE9NjI7e'=>'Chat',
				'stats.php'=>'Statistics'
				];
		
		function __construct($filename){
			$this->filename = $filename;
		}
		
		function __toString(){
			$header = "<ul>";
			
			foreach($this->dataset as $script=>$name){
				$header .= "<li><a href='".$script."'".(($script != $this->filename) ? "" : " class='active'" ).">".$name."</a></li>";
			}
			$header .= "</ul>";

			return $header;
		}
	}
	

	//echo new Header(substr(__FILE__, strlen(__DIR__)+1));
?>