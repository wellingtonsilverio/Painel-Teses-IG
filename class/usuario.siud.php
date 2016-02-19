<?php
require_once "usuario.class.php";

class UsuarioSIUD{
	public static $instance;

	private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new UsuarioSIUD();

        return self::$instance;
    }

    public function Select($ID){
    	
    }
    public function SelectAll(){
    	
    }
    public function SelectLogin(Usuario $objUsuario){
    	$sql = "SELECT * FROM `usuario` WHERE `email` = ? AND `senha` = ?";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute(array($objUsuario->getEmail(), $objUsuario->getSenha()));
        return $p_sql->fetch(PDO::FETCH_ASSOC);
    }
    public function Insert(Usuario $objUsuario){
    	
            $sql = "INSERT INTO usuario (		
                email,
                senha,
                permissao) 
                VALUES (?, ?, ?)";

            $p_sql = Conexao::getInstance()->prepare($sql);

            return $p_sql->execute(array($objUsuario->getEmail(),$objUsuario->getSenha(),$objUsuario->getPermissao()));
        
    	
    }
    public function Update(Usuario $objUsuario){
    	
    }
    public function Delete(Usuario $objUsuario){
    	
    }

}
?>