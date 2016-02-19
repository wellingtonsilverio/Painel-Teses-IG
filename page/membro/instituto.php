<div class="editor">
	<?php
	if(isset($_POST['sigla'])){
		$insertInstituto = $objConn->prepare("INSERT INTO `instituto` (`sigla`,`nome`,`departamento`,`faculdade`) VALUES (?,?,?,?)");
		if($insertInstituto->execute(array($_POST['sigla'],$_POST['nome'],$_POST['dep'],$_POST['faculdade']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	?>
	<h1>Adicionar novo institutos</h1>
	<div class='input-control text'>
		<form method="POST">
			Sigla da instituição<input type="text" name="sigla" id="" placeholder="Sigla">
			Nome da instituição<input type="text" name="nome" id="" placeholder="Nome">
			Departamento da instituição<input type="text" name="dep" id="" placeholder="Departamento">
			Faculdade<select name="faculdade" id="">
				<?php
				$selectFaculdades = $objConn->prepare("SELECT * FROM `faculdade`");
				$selectFaculdades->execute();
				while($faculdade = $selectFaculdades->fetchObject()){
					echo "<option value='".$faculdade->id."'>".$faculdade->nome."(".$faculdade->siglas.")</option>";
				}
				?>
			</select>
			<button type="submit" class='button'>Adicionar instituto</button>
		</form>
	</div>
</div>