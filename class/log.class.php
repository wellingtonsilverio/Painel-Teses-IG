<?php
require_once "class/conexao.class.php";
 
class GerarLog{

	public static $instance;

	private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new GerarLog();

        return self::$instance;
    }

	function inserirLog($msg){
		date_default_timezone_set('America/Sao_Paulo');

		$data = date("d-m-y");
		$hora = date("H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		 
		//Nome do arquivo:
		$arquivo = "logs/Logger_$data.txt";
		 
		//Texto a ser impresso no log:
		$texto = "[$hora][$ip]> $msg \n";
		 
		$manipular = fopen("$arquivo", "a+b");
		fwrite($manipular, $texto);
		fclose($manipular);
		 
	}
	function logGerais($usuario, $oquefez, $comentario){
		$ip = $_SERVER['REMOTE_ADDR'];

		$insertLog = Conexao::getInstance()->prepare("INSERT INTO `dbigeografia`.`loggerais` (`id`, `usuario`, `oquefez`, `data`, `ip`, `comentario`) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, ?, ?)");
		$insertLog->execute(array($usuario, $oquefez, $ip, $comentario));
	}
}
 
?>