<div class="editor">
	<?php
	if(isset($_POST['alterar'])){
		$updateAluno = $objConn->prepare("UPDATE `aluno` SET `ra` = ?, `nome` = ? WHERE `ra` = ?");
		if($updateAluno->execute(array($_POST['ra'],$_POST['nome'],$_GET['aluno']))){
			header("Location: index.php?p=aluno&aluno=".$_POST['ra']."&pa=aluno");
		}
	}
	if(isset($_POST['criar'])){
		$insertAluno = $objConn->prepare("INSERT INTO `aluno` (`ra`,`nome`) VALUES (?,?)");
		if($insertAluno->execute(array($_POST['ra'],$_POST['nome']))){
			header("Location: index.php?p=aluno&aluno=".$_POST['ra']."&pa=aluno");
		}
	}
	if(isset($_GET['aluno'])){
		$selectAluno = $objConn->prepare("SELECT * FROM `aluno` WHERE `ra` = ?");
		$selectAluno->execute(array($_GET['aluno']));
		if($aluno = $selectAluno->fetchObject()){
			echo "<h1>Editar aluno(a) ".$aluno->nome."</h1>
			<div class='input-control text'>
				<form method='POST'>
					RA do aluno<input type='text' name='ra' value='".$aluno->RA."' placeholder='RA'>
					Nome do aluno<input type='text' name='nome' value='".$aluno->nome."' placeholder='Nome Completo'>
					<input type='hidden' name='alterar' value='aluno'>
					<button class='button'>Editar aluno</button>
				</form>
			</div>
			";
		}else{
			echo "<h1>Adicionar novo aluno</h1>
			<div class='input-control text'>
				<form method='POST'>
					RA do aluno<input type='text' name='ra' value='".$ra."' placeholder='RA'>
					Nome do aluno<input type='text' name='nome' value='".$nome."' placeholder='Nome Completo'>
					<input type='hidden' name='criar' value='aluno'>
					<button class='button'>Adicionar aluno</button>
				</form>
			</div>
			";
		}
	}
	?>
	
</div>