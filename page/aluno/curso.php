<div class="editor">
	<?php
	if(isset($_POST['curso'])){
		$insertCurso = $objConn->prepare("INSERT INTO `curso` (`nome`,`instituto`) VALUES (?,?)");
		if($insertCurso->execute(array($_POST['curso'],$_POST['instituto']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_POST['alterar'])){
		$updateCursoAluno = $objConn->prepare("UPDATE `aluno` SET `curso` = ? WHERE `RA` = ?");
		if($updateCursoAluno->execute(array($_POST['alterar'], $_GET['aluno']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_GET['aluno'])){
		$selectAluno = $objConn->prepare("SELECT * FROM `aluno` WHERE `ra` = ?");
		$selectAluno->execute(array($_GET['aluno']));
		if($aluno = $selectAluno->fetchObject()){
			echo "<h1>Cursos</h1>";
			$selectCursos = $objConn->prepare("SELECT * FROM `curso`");
			$selectCursos->execute();
			echo "<form method='POST'><div class='input-control text'><select name='alterar' id=''>";
			while($curso = $selectCursos->fetchObject()){
				$selectInstituto = $objConn->prepare("SELECT * FROM `instituto` WHERE `id` = ?");
				$selectInstituto->execute(array($curso->instituto));
				$instituto = $selectInstituto->fetchObject();
				$selectFaculdade = $objConn->prepare("SELECT * FROM `faculdade` WHERE `id` = ?");
				$selectFaculdade->execute(array($instituto->faculdade));
				$faculdade = $selectFaculdade->fetchObject();
				echo "<option value='".$curso->id."'";
				if($curso->id == $aluno->curso){
					echo "selected";
				}
				echo ">".$curso->nome."(".$instituto->nome." - ".$faculdade->siglas.")</option>";
			}
			echo "</select></div>
				<br/>
				<button type='submit' class='button'>Alterar curso do aluno</button>
				</form>";
			echo "<h1>Adicionar um novo curso</h1>
			<form method='POST'>
				<div class='input-control text'>
					Nome do curso<input type='text' name='curso' id='' placeholder='Nome do curso'>
					<div class='input-control select'>
						Instituto do curso<select name='instituto' id=''>";
						$selectInstitutos = $objConn->prepare("SELECT * FROM `instituto`");
						$selectInstitutos->execute();
						while($instituto = $selectInstitutos->fetchObject()){
							$selectFaculdade = $objConn->prepare("SELECT * FROM `faculdade` WHERE `id` = ?");
							$selectFaculdade->execute(array($instituto->faculdade));
							$faculdade = $selectFaculdade->fetchObject();
							echo "<option value='".$instituto->id."'>".$instituto->nome."(".$faculdade->siglas.")</option>";
						}
						echo "</select>
					</div>
				<br/>
				<br/>
				<br/>
				<button type='submit' class='button'>Adicionar curso</button>
				</div>
			</form>
				";
		}else{
			echo "<h1>Adicione primeiro o aluno</h1>";
		}
	}
	?>
</div>