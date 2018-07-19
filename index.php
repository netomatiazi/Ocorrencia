<?php



/****/
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
/***/

// define o horario padrao
date_default_timezone_set('America/Sao_Paulo');

	if ($_GET)
	{
		//recebeu parтmetros
		$controle = $_GET['controle'];
		$metodo = $_GET["metodo"];
		require_once "controle/" . $controle. ".class.php";
		$obj = new $controle();
		$obj->$metodo();
	}
	else
	{
		//posiчуo inicial
		require_once "controle/main.class.php";
		$ini = new main();
		$ini->buscarOcorrencia();
	}
?>