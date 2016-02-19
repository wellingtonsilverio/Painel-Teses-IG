<?php
	if(isset($_POST['criaruniversidade'])){
		$insertAluno = $objConn->prepare("INSERT INTO `faculdade`(`siglas`, `nome`, `rua`, `bairro`, `cidade`, `estado`, `pais`) VALUES (?,?,?,?,?,?,?)");
		if($insertAluno->execute(array($_POST['siglas'],$_POST['nome'],$_POST['rua'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['pais']))){
			//GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 3, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			//header("Location: index.php?p=registros");
		}
	}
	if(isset($_POST['criarinstituicao'])){
		$insertAluno = $objConn->prepare("INSERT INTO `instituto`(`sigla`, `nome`, `departamento`, `faculdade`) VALUES (?,?,?,?)");
		if($insertAluno->execute(array($_POST['sigla'],$_POST['nome'],$_POST['departamento'],$_POST['faculdade']))){
			//GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 3, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			//header("Location: index.php?p=registros");
		}
	}
	if(isset($_POST['criarsecretaria'])){
		$insertAluno = $objConn->prepare("INSERT INTO `secretaria`(`nome`, `institulo`) VALUES (?,?)");
		if($insertAluno->execute(array($_POST['nome'],$_POST['instituicao']))){
			//GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 3, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			//header("Location: index.php?p=registros");
		}
	}
?>
<div class="painelInput">
	<div class="input-control text">
		<h1>Adicionar Universidade</h1><form method="post">
		<form method="post">
			<span><input type="text" name="siglas" placeholder="Sigla:" style="width:19% !important;"></span>
			<span><input type="text" name="nome" placeholder="Nome:" style="width:80% !important;"></span>
			<span><input type="text" name="rua" placeholder="Rua:" style="width:40% !important;"></span>
			<span><input type="text" name="bairro" placeholder="Bairro:" style="width:59% !important;"></span>
			<span><input type="text" name="cidade" placeholder="Cidade:" style="width:44% !important;"></span>
			<span><input type="text" name="estado" placeholder="Estado:" style="width:35% !important;"></span>
			<span><input type="text" name="pais" placeholder="Pais:" style="width:20% !important;"></span>
			<input type='hidden' name='criaruniversidade' value='universidade'>
			<span><button type="submit" class="button" style="width:100% !important; position: relative;">Adicionar Universidade</button></span>
		</form>
		<h1>Adicionar Instituição</h1><form method="post">
		<form method="post">
			<span><input type="text" name="sigla" placeholder="Sigla:" style="width:19% !important;"></span>
			<span><input type="text" name="nome" placeholder="Nome:" style="width:80% !important;"></span>
			<span><input type="text" name="departamento" placeholder="Departamento:" style="width:49% !important;"></span>
			<span><select name="faculdade" style="width:50% !important;">
				<option>>> Escolha uma Universidade</option>
				<?php
					$selectFaculdade = $objConn->prepare("SELECT * FROM `faculdade` ORDER BY `nome` ASC");
					$selectFaculdade->execute();
					while($faculdade = $selectFaculdade->fetchObject()){
						echo "<option value='".$faculdade->id."'>".$faculdade->nome." (".$faculdade->siglas.")</option>";
					}
				?>
			</select></span>
			<input type='hidden' name='criarinstituicao' value='instituicao'>
			<span><button type="submit" class="button" style="width:100% !important; position: relative;">Adicionar Instituição</button></span>
		</form>
		<h1>Adicionar Secretaria</h1><form method="post">
		<form method="post">
			<span><input type="text" name="nome" placeholder="Nome:" style="width:49% !important;"></span>
			<span><select name="instituicao" style="width:50% !important;">
				<option>>> Escolha uma instituição</option>
				<?php
					$selectFaculdade = $objConn->prepare("SELECT * FROM `instituto` ORDER BY `nome` ASC");
					$selectFaculdade->execute();
					while($faculdade = $selectFaculdade->fetchObject()){
						echo "<option value='".$faculdade->id."'>".$faculdade->nome." (".$faculdade->sigla.")</option>";
					}
				?>
			</select></span>
			<input type='hidden' name='criarsecretaria' value='secretaria'>
			<span><button type="submit" class="button" style="width:100% !important; position: relative;">Adicionar Secretaria</button></span>
		</form>
	</div>
</div>