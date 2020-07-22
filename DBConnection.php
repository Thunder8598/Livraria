<?php
	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
	function conectar(){
		$hostdb = '127.0.0.1';
		$userdb = 'root';
		$passdb = '';
		$namedb = 'db-loja';
		
		if ($con = mysqli_connect($hostdb, $userdb, $passdb, $namedb))
			return $con;
		else
			return 0;
	}
?>