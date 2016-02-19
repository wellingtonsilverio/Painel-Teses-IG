<div class="painelInput">
	<div class="input-control text">
		<h1>Registros</h1>
		<?php
		$selectLog = $objConn->prepare("SELECT * FROM `loggerais` ORDER BY `id` DESC");
		$selectLog->execute();
		while($log = $selectLog->fetchObject()){
			$selectUsr = $objConn->prepare("SELECT * FROM `usuario` where `id` = ?");
			$selectUsr->execute(array($log->usuario));
			if($usr = $selectUsr->fetchObject())
				echo "<div><h4>".$usr->nome."</h4>";
			if($log->oquefez == "1"){
				echo "Logou no sistema";
			}else if($log->oquefez == "2"){
				echo "Deslogou do sistema";
			}else if($log->oquefez == "3"){
				echo "Adicionou um novo aluno";
			}else if($log->oquefez == "4"){
				echo "Adicionou uma nova dissertação";
			}else if($log->oquefez == "5"){
				echo "Adicionou um novo membro";
			}else if($log->oquefez == "6"){
				echo "Editou uma dissertação";
			}else if($log->oquefez == "7"){
				echo "Adicionou um membro na banca";
			}else if($log->oquefez == "8"){
				echo "Editou um aluno";
			}else if($log->oquefez == "9"){
				echo "Deletou um aluno";
			}else if($log->oquefez == "10"){
				echo "Deletou uma dissertação";
			}else if($log->oquefez == "11"){
				echo "Editou um membro";
			}else if($log->oquefez == "12"){
				echo "Deletou um membro";
			}
			echo " as ".$log->data;
			if(!empty($log->comentario))
				echo ": ".$log->comentario.".</div>";
		}
		?>
	</div>
</div>