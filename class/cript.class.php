<?php
class Cockroach{
	public static $instance;

	private function __construct() {
    	$this->gerarCaracteres();
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new Cockroach();

        return self::$instance;
    }

    private $Silverio;

    public function getSilverio(){
    	return $this->Silverio;
    }

    public function gerarCaracteres(){
    	$this->Silverio = array(
	    	'q','w','d','f','g','h','j','k','l',
	    	'ç','z','x','c','v','b','n','m',',','.',';','/','´','[','~',']','\\','\'','1',
	    	'2','3','4','5','6','7','8','9','0','-','=','"','!','@','#','$','%','&',
	    	'*','(',')','_','+','Q','W','E','R','T','Y','U','I','O','P','`','{','A','S',
	    	'D','F','G','H','J','K','L','Ç','^','}','|','Z','X','C','V','B','N','M','<',
	    	'>',':','?','¹','²','³','£','¢','¬','§','ª','º','°','ã','á','à','â','é','è','ê',
	    	'í','ì','î','ó','ò','ô','õ','ú','ù','û','Â','Ã','Á','À','É','È','Ê',
	    	'Í','Ì','Î','Ó','Ò','Ô','Õ','Ú','Ù','Û','e','r','t','y','u','i','o','p','a','s'
	    );
    }

    //Encode(int $pass)
    public function Encode($pass, $string){
    	while($pass > 140){
    		$pass -= 140;
    	}
    	$tamanhoString = strlen($string);
    	$novaString = "";
    	for($i = 0; $i < $tamanhoString; $i++){
    		for($u = 0; $u <= 140; $u++){
    			if($string{$i} == $this->getSilverio()[$u]){
    				$novoI = $u+$pass;
	    			if($novoI > 140){
	    				$novoI -= 140;
	    			}
	    			$novoChar = $this->getSilverio()[$novoI];
	    			/*$novoChar =  decbin(ord($novoChar));
	    			while(strlen($novoChar) < 8){
	    				$novoChar = '0'.$novoChar;
	    			}
	    			$novoChar = $novoChar{7}.$novoChar{6}.$novoChar{5}.$novoChar{4}.$novoChar{3}.$novoChar{2}.$novoChar{1}.$novoChar{0};
	    			$novoChar = chr(bindec($novoChar));*/
	    			$novaString .= $novoChar;
	    			break;
    			}
    		}
    	}
    	return $novaString;
    }
    public function Decode($pass, $string){
    	while($pass > 139){
    		$pass -= 140;
    	}
    	$tamanhoString = strlen($string);
    	$novaString = "";
    	for($i = 0; $i < $tamanhoString; $i++){
			$novoChar = $string{$i};
			/*$novoChar =  decbin(ord($novoChar));
			while(strlen($novoChar) < 8){
				$novoChar = '0'.$novoChar;
			}
			$novoChar = $novoChar{7}.$novoChar{6}.$novoChar{5}.$novoChar{4}.$novoChar{3}.$novoChar{2}.$novoChar{1}.$novoChar{0};
			$novoChar = chr(bindec($novoChar));*/
    		for($u = 0; $u <= 140; $u++){
    			if($novoChar == $this->getSilverio()[$u]){
    				if($u <= $pass){
    					$u += 140;
    				}
    				$novoI = $u-$pass;
	    			$novoChar = $this->getSilverio()[$novoI];
	    			$novaString .= $novoChar;
	    			break;
    			}
    		}
    	}

    	return $novaString;
    }
}
?>