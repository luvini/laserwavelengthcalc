<?php
require_once('./geoip/geoip2.phar');
use GeoIp2\Database\Reader;
		
	class GeoIP{
		
		public $ip;
		
		function __construct($ip=null){
			$this->ip = $ip ?: self::getRealIpAddr();
		}
		
		function country_code(){
			$reader = new Reader('./geoip/GeoLite2-Country.mmdb');
			try{
			$record = $reader->country($this->ip);
			}catch (Exception $e){
				return "xx";
			}
			return strtolower($record->country->isoCode);
		}
		
		static function getRealIpAddr()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
	}
?>