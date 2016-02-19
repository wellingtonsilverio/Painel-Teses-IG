<?php
	if(isset($_POST['criar'])){
		$data = $_POST['data'];
		$ano = $data[6].$data[7].$data[8].$data[9];
		$mes = $data[3].$data[4];
		$dia = $data[0].$data[1];
		$hora = "00:00";
		$datacerto = $ano."-".$mes."-".$dia." ".$hora.":00";
		$insertDissertacao = $objConn->prepare("INSERT INTO `defesa` (`nivel`,`aluno`,`titulo`,`local`,`data`) VALUES (?,?,?,?,?)");
		if($insertDissertacao->execute(array($_POST['nivel'],$_POST['aluno'],$_POST['titulo'],$_POST['local'],$datacerto))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 4, "do aluno: ".$_POST['aluno']." e titulo: ".$_POST['titulo']);
			header("Location: index.php?p=registros");
		}
	}
	if(isset($_POST['editar'])){
		$data = $_POST['data'];
		$ano = $data[6].$data[7].$data[8].$data[9];
		$mes = $data[3].$data[4];
		$dia = $data[0].$data[1];
		$hora = "00:00";
		$datacerto = $ano."-".$mes."-".$dia." ".$hora.":00";
		$insertDissertacao = $objConn->prepare("UPDATE `defesa` SET `nivel` = ?, `aluno` = ?, `titulo` = ?, `local` = ?, `data` = ? WHERE `id` = ?;");
		if($insertDissertacao->execute(array($_POST['nivel'],$_POST['aluno'],$_POST['titulo'],$_POST['local'],$datacerto,$_POST['dissertacaoId']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 6, "do aluno: ".$_POST['aluno']." e titulo: ".$_POST['titulo']);
		}
	}
	if(isset($_POST['deletar'])){
		$delettDissertacao = $objConn->prepare("DELETE FROM `defesa` WHERE `id` = ?");
		if($delettDissertacao->execute(array($_POST['deletar']))){
			$delettDissertacaoResto = $objConn->prepare("DELETE FROM `defesa_professor` WHERE `defesa` = ?");
			$delettDissertacao->execute(array($_POST['deletar']));
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 10, "com ID: ".$_POST['deletar']);
		}
	}
?>
<div class="painelInput">
	<div class="input-control text">
		<h1>Dissertações</h1><form method="post">
		<span style="width:90% !important;"><select name="dissertacaoId" style="width:100% !important;" onchange="this.form.submit()">
			<option>>> Escolha uma dissertação para editar</option>
			<?php
				$selectDissertacao = $objConn->prepare("SELECT * FROM `defesa` ORDER BY `titulo` ASC");
				$selectDissertacao->execute();
				while($dissertacao = $selectDissertacao->fetchObject()){
					echo "<option value='".$dissertacao->id."'>".$dissertacao->titulo." (".$dissertacao->nivel.")</option>";
				}
			?>
		</select></span></form>
		<br/><br/>
		<?php
		if(isset($_POST['dissertacaoId'])){
			$selectDissertacaog = $objConn->prepare("SELECT * FROM `defesa` WHERE `id` = ?");
			$selectDissertacaog->execute(array($_POST['dissertacaoId']));
			$dissertacao = $selectDissertacaog->fetchObject();
			?>
		<h3>Editar <?=$dissertacao->titulo;?></h3>
		<form method="post">
			<input type="hidden" name="dissertacaoId" value="<?=$dissertacao->id?>">
			<span style="width:39% !important;"><select name="nivel" style="width:99% !important;" onchange="this.form.submit()">
				<option value="Mestrado" <?php if($dissertacao->nivel == "Mestrado") echo "selected";?>>Mestrado</option>
				<option value="Doutorado" <?php if($dissertacao->nivel == "Doutorado") echo "selected";?>>Doutorado</option>
			</select></span>
			<span style="width:60% !important;"><input type="hidden" name="aluno" onchange="this.form.submit()" value="<?=$dissertacao->aluno;?>" placeholder="Aluno" style="width:60% !important;"></span>
			<span style="width:100% !important;"><input type="text" name="titulo" onchange="this.form.submit()" value="<?=$dissertacao->titulo;?>" placeholder="Titulo" style="width:100% !important;"></span>
			<span style="width:49% !important;"><input type="text" name="local" onchange="this.form.submit()" value="<?=$dissertacao->local;?>" placeholder="Local" style="width:49% !important;"></span>
			<span style="width:49% !important;"><input type="text" name="data" onchange="this.form.submit()" value="<?=$dissertacao->data[8].$dissertacao->data[9]."/".$dissertacao->data[5].$dissertacao->data[6]."/".$dissertacao->data[0].$dissertacao->data[1].$dissertacao->data[2].$dissertacao->data[3];?>" placeholder="Data(DD/MM/AAAA)" style="width:49% !important;"></span>
			<input type='hidden' name='editar' value='dissertacao'>
		</form>
		<br/>
		<form method="post">
			<input type='hidden' name='deletar' value='<?=$dissertacao->id;?>'>
			<button type="submit" class='button danger' style="position: relative;">Deletar <?=$dissertacao->titulo;?></button>
		</form>
			<?php
		}else if(true){
			?>
		<h3>Criar nova dissertação</h3>
		<form method="post">
			<span style="width:39% !important;"><select name="nivel" style="width:39% !important;">
				<option>>> Escolha o nivel da Defesa</option>
				<option value="Mestrado">Mestrado</option>
				<option value="Doutorado">Doutorado</option>
			</select></span>
			<span style="width:60% !important;"><select name="aluno" id="" style="width:60% !important;">
				<option>>> Escolha o aluno para Defesa</option>
				<?php
				$selectAluno = $objConn->prepare("SELECT * FROM `aluno` ORDER BY `nome` ASC");
				$selectAluno->execute();
				while($aluno = $selectAluno->fetchObject()){
					echo "<option value='".$aluno->RA."'>".$aluno->nome."(".$aluno->RA.")</option>";
				}
				?>
			</select></span>
			<span style="width:100% !important;"><input type="text" name="titulo" placeholder="Titulo" style="width:100% !important;"></span>
			<span style="width:49% !important;"><input type="text" name="local" value="Auditório do Instituto de Geociência da Universidade Estadual de Campinas" placeholder="Local" style="width:49% !important;"></span>
			<span style="width:49% !important;"><input type="text" name="data" placeholder="Data(DD/MM/AAAA)" style="width:49% !important;"></span>
			<input type='hidden' name='criar' value='dissertacao'>
			<br><br>
			<button class="button" style="position: relative;" type="submit">Criar a dissertação</button>
		</form>
			<?php
		}
		?>
	</div>
</div>