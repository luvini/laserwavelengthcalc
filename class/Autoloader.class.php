<?php
class Autoloader{
	static function register(){
		spl_autoload_register(function ($className)
		{
			$className = ltrim($className, '\\');
			$fileName  = '';
			$namespace = '';
			if ($lastNsPos = strrpos($className, '\\')) {
				$namespace = substr($className, 0, $lastNsPos);
				$className = substr($className, $lastNsPos + 1);
				$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.class.php';
			$fileName = 'class'. DIRECTORY_SEPARATOR .$fileName;
			
			if(file_exists($fileName)){
				require_once $fileName;
				//echo $fileName.'<br>';
			}
		});
	}
}
Autoloader::register();
?>