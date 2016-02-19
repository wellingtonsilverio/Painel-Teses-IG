<?php
	if(isset($_POST['criar'])){
		$insertAluno = $objConn->prepare("INSERT INTO `aluno` (`ra`,`nome`, `curso`) VALUES (?,?,?)");
		if($insertAluno->execute(array($_POST['ra'],$_POST['nome'], "1"))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 3, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			header("Location: index.php?p=registros");
		}
	}
	if(isset($_POST['editar'])){
		$updateAluno = $objConn->prepare("UPDATE `aluno` SET `RA` = ?, `nome` = ?, `curso` = ? WHERE `RA` = ?");
		if($updateAluno->execute(array($_POST['ra'],$_POST['nome'], "1", $_POST['editar']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 8, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			header("Location: index.php?p=registros");
		}
	}
	if(isset($_POST['deletar'])){
		$updateAluno = $objConn->prepare("DELETE FROM `aluno` WHERE `RA` = ?");
		if($updateAluno->execute(array($_POST['deletar']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 9, "com ra: ".$_POST['ra']." e nome: ".$_POST['nome']);
			header("Location: index.php?p=registros");
		}
	}
?>
<div class="painelInput">
	<div class="input-control text">
		<h1>Alunos</h1>
		<form method="post">
			<span style="width:24% !important;"><input type="text" name="ra" style="width:24% !important;" placeholder="RA:" /></span>
			<span style="width:39% !important;"><input type="text" name="nome" style="width:40% !important;" placeholder="Nome Completo:"  /></span>
			<span style="width:34% !important;"><select name="instituto" style="width:34% !important;"><option value="1">Geografia</option></select></span>
			<input type='hidden' name='criar' value='aluno'>
			<br><br>
			<button type="submit" class='button' style="position: relative;">Adicionar novo aluno</button>
		</form>
		<h1>Editar Aluno(a)</h1>
		<form method="post">
			<select name="selectAluno" id="" onchange="this.form.submit()">
				<option>>> Escolha um aluno para editar-lo/Deleta-lo</option>
				<?php
					$selectMembro = $objConn->prepare("SELECT * FROM `aluno` ORDER BY `nome` ASC");
					$selectMembro->execute();
					while($membro = $selectMembro->fetchObject()){
						echo "<option value='".$membro->RA."'>".$membro->nome." RA: ".$membro->RA."</option>";
					}
				?>
			</select>
		</form>
		<?php
		if(isset($_POST['selectAluno'])){
			$selectAluno = $objConn->prepare("SELECT * FROM `aluno` WHERE `RA` = ?");
			$selectAluno->execute(array($_POST['selectAluno']));
			$Aluno = $selectAluno->fetchObject();
			?>
			<br>
			<form method="post">
				<span style="width:24% !important;"><input type="text" name="ra" style="width:24% !important;" placeholder="RA:" value="<?=$Aluno->RA?>" /></span>
				<span style="width:39% !important;"><input type="text" name="nome" style="width:40% !important;" placeholder="Nome Completo:" value="<?=$Aluno->nome?>" /></span>
				<span style="width:34% !important;"><select name="instituto" style="width:34% !important;"><option value="1">Geografia</option></select></span>
				<input type='hidden' name='editar' value='<?=$_POST['selectAluno']?>'>
				<br><br>
				<button type="submit" class='button' style="position: relative;">Editar aluno</button>
			</form>
			<form method="post">
				<input type='hidden' name='deletar' value='<?=$_POST['selectAluno']?>'>
				<br><br>
				<button type="submit" class='button danger' style="position: relative;">Deletar <?=$Aluno->nome?></button>
			</form>
			<?php
		}
		?>
	</div>
</div>