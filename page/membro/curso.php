<div class="editor">
	<?php
	if(isset($_POST['curso'])){
		$insertCurso = $objConn->prepare("INSERT INTO `curso` (`nome`,`instituto`) VALUES (?,?)");
		if($insertCurso->execute(array($_POST['curso'],$_POST['instituto']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
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
	?>
</div>