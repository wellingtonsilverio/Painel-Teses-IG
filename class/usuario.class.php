<?php
class Usuario{
	private $ID;
	private $Email;
	private $Senha;
	private $Permissao;

	public function construct(){
		$this->setID(0);
		$this->setEmail("");
		$this->setSenha("");
		$this->setPermissao(0);
	}
	public function _construct($ID, $Email, $Senha, $Permissao){
		$this->setID($ID);
		$this->setEmail($Email);
		$this->setSenha($Senha);
		$this->setPermissao($Permissao);
	}
	public function __construct($Email, $Senha){
		$this->setEmail($Email);
		$this->setSenha($Senha);
		$this->setPermissao(1);
	}

	public function getID(){
		return $this->ID;
	}
	public function getEmail(){
		return $this->Email;
	}
	public function getSenha(){
		return $this->Senha;
	}
	public function getPermissao(){
		return $this->Permissao;
	}

	public function setID($ID){
		$this->ID = $ID;
	}
	public function setEmail($Email){
		$this->Email = $Email;
	}
	public function setSenha($Senha){
		$this->Senha = $Senha;
	}
	public function setPermissao($Permissao){
		$this->Permissao = $Permissao;
	}
}
?>