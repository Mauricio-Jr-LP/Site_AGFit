<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	$autoload = function($class){
		if($class == 'Email'){

			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);


	define('INCLUDE_PATH','https://meusitess.com/agfit/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	define('BASE_DIR_PAINEL',__DIR__.'/painel');


	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','meusit92_maurici');
	define('PASSWORD','Mau*2020');
	define('DATABASE','meusit92_agfit');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','AG FIT');

	define('BASE_DIR_PAINEL',__DIR__.'/painel');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','AG FIT');
?>