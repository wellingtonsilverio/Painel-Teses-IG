<div class="editor">
	<?php
	if(isset($_POST['criar'])){
		$data = $_POST['data'];
		$ano = $data[0].$data[1].$data[2].$data[3];
		$mes = $data[5].$data[6];
		$dia = $data[8].$data[9];
		$hora = $_POST['hora'];
		$datacerto = $ano."-".$mes."-".$dia." ".$hora.":00";
		$insertDissertacao = $objConn->prepare("INSERT INTO `defesa` (`nivel`,`aluno`,`titulo`,`local`,`data`) VALUES (?,?,?,?,?)");
		if($insertDissertacao->execute(array($_POST['nivel'],$_GET['aluno'],$_POST['titulo'],$_POST['local'],$datacerto))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_POST['alterar'])){
		$data = $_POST['data'];
		$ano = $data[0].$data[1].$data[2].$data[3];
		$mes = $data[5].$data[6];
		$dia = $data[8].$data[9];
		$hora = $_POST['hora'];
		$datacerto = $ano."-".$mes."-".$dia." ".$hora.":00";
		$updateDissertacao = $objConn->prepare("UPDATE `defesa` SET `nivel` = ?, `titulo` = ?, `local` = ?, `data` = ? WHERE `aluno` = ?");
		if($updateDissertacao->execute(array($_POST['nivel'],$_POST['titulo'],$_POST['local'],$datacerto,$_GET['aluno']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_GET['aluno'])){
		$selectAluno = $objConn->prepare("SELECT * FROM `aluno` WHERE `ra` = ?");
		$selectAluno->execute(array($_GET['aluno']));
		if($aluno = $selectAluno->fetchObject()){
			$selectDissertacao = $objConn->prepare("SELECT * FROM `defesa` WHERE `aluno` = ?");
			$selectDissertacao->execute(array($aluno->RA));
			while($dissertacao = $selectDissertacao->fetchObject()){
	?>
	<h1>Editar dissertação</h1>
	<div class='input-control text'>
		<form method="POST">
			Nível da dissertação<select name="nivel" id="">
				<option value="Mestrado" <?php if($dissertacao->nivel == "Mestrado"){ echo "selected"; } ?> >Mestrado</option>
				<option value="Doutorado" <?php if($dissertacao->nivel == "Doutorado"){ echo "selected"; } ?> >Doutorado</option>
			</select>
			Titulo da dissetação<textarea name="titulo" id="" placeholder="Titulo" class="extendText"><?=$dissertacao->titulo?></textarea>
			Local da apresentacao da dissetação<textarea rows="2" name="local" id="local" placeholder="Local"><?=$dissertacao->local?></textarea>
			Data da dissetação<br/><div class="input-control text" data-role="datepicker"><input type="text" name="data" id="" value="<?php
						$data = $dissertacao->data; $ano = $data[0].$data[1].$data[2].$data[3]; $mes = $data[5].$data[6]; $dia = $data[8].$data[9]; $hora = $data[11].$data[12].$data[13].$data[14].$data[15]; echo $ano.".".$mes.".".$dia;
					?>"></div><input type="text" class="hora" name="hora" value="<?=$hora?>"><b>Hrs.</b><br/>
			<input type="hidden" name="alterar" value="alterar">
			<button type="submit" class='button'>Editar dissertação</button>
		</form>
	</div>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<?php
			}
	?>
	<h1>Criar dissertação</h1>
	<div class='input-control text'>
		<form method="POST">
			Nível da dissertação<select name="nivel" id="">
				<option value="Mestrado">Mestrado</option>
				<option value="Doutorado">Doutorado</option>
			</select>
			Titulo da dissetação<textarea name="titulo" id="" placeholder="Titulo" class="extendText"/></textarea>
			Local da apresentacao da dissetação<textarea rows="2" name="local" id="local" placeholder="Local">Auditório do Instituto de Geociência da Universidade Estadual de Campinas</textarea>
			Data da dissetação<br/><div class="input-control text" data-role="datepicker"><input type="text" name="data" id=""></div><input type="text" class="hora" name="hora"><b>Hrs.</b><br/>
			<input type="hidden" name="criar" value="criar">
			<button type="submit" class='button'>Criar dissertação</button>
		</form><br/><br/><br/>
	</div>
	<?php
		}else{
			echo "<h1>Adicione primeiro o aluno</h1>";
		}
	}
	?>
</div>