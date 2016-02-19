<?php
class Permissao{
	public static $instance;

	private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new Permissao();

        return self::$instance;
    }
	
}
?>