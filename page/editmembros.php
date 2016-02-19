<?php
	if(isset($_POST['editar'])){
		$editarMembro = $objConn->prepare("UPDATE `membro_da_banca` SET `titulo`=?,`nome`=?,`cpf`=?,`rg`=?,`data_nacimento`=?,`telefone`=?,`endereco`=?,`email`=?,`formacao_academica`=?,`instituicao_IES`=?,`ano`=?,`instituicao_origem`=? WHERE `id` = ?");
		if($editarMembro->execute(array($_POST['titulo'],$_POST['nome'],$_POST['cpf'],$_POST['rg'],$_POST['data'],$_POST['tel'],$_POST['end'],$_POST['email'],$_POST['for'],$_POST['inst'],$_POST['ano'],$_POST['origem'],$_POST['editar']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 11, "com nome: ".$_POST['nome']);
		}
	}
	if(isset($_POST['deletar'])){
		$editarMembro = $objConn->prepare("DELETE FROM `membro_da_banca` WHERE `id` = ?");
		if($editarMembro->execute(array($_POST['deletar']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 12, "com id: ".$_POST['deletar']);
		}
	}
?>
<div class="painelInput">
	<div class="input-control text">
		<h1>Editar Membro</h1><form method="post">
		<form action="" method="post">
			<select name="editMembro" id="" onchange="this.form.submit()">
				<option>>> Escolha uma membro para editar</option>
				<?php
					$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` ORDER BY `nome` ASC");
					$selectMembro->execute();
					while($membro = $selectMembro->fetchObject()){
						echo "<option value='".$membro->id."'>".$membro->nome."</option>";
					}
				?>
			</select>
		</form>
		<br>
		<br>
		<?php
		if(isset($_POST['editMembro']) || isset($_GET['membro'])){
			if(isset($_POST['editMembro'])){
				$id = $_POST['editMembro'];
			}else{
				$id = $_GET['membro'];
			}
			$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
			$selectMembro->execute(array($id));
			$Membro = $selectMembro->fetchObject();
			?>
			<form method="post">
				<span><input type="text" name="titulo" placeholder="Titulo:" style="width:20% !important;" value="<?=$Membro->titulo?>"></span>
				<span><input type="text" name="nome" placeholder="Nome:" style="width:79% !important;" value="<?=$Membro->nome?>"></span>
				<span><input type="text" name="cpf" placeholder="CPF:" style="width:50% !important;" value="<?=$Membro->cpf?>"></span>
				<span><input type="text" name="rg" placeholder="RG:" style="width:49% !important;" value="<?=$Membro->rg?>"></span>
				<span><input type="text" name="data" placeholder="Data de Nacimento:" style="width:40% !important;" value="<?=$Membro->data_nacimento?>"></span>
				<span><input type="text" name="tel" placeholder="Telefone" style="width:59% !important;" value="<?=$Membro->telefone?>"></span>
				<span><input type="text" name="end" placeholder="Endereço:" style="width:60% !important;" value="<?=$Membro->endereco?>"></span>
				<span><input type="text" name="email" placeholder="E-mail:" style="width:39% !important;" value="<?=$Membro->email?>"></span>
				<span><input type="text" name="for" placeholder="Formação Academica" style="width:25% !important;" value="<?=$Membro->formacao_academica?>"></span>
				<span>
					<select name="inst" id="" style="width:25% !important;">
						<?php
						$selectFaculdades = $objConn->prepare("SELECT * FROM `instituto`");
						$selectFaculdades->execute();
						while($faculdade = $selectFaculdades->fetchObject()){
							echo "<option value='".$faculdade->id."'";
							echo ($faculdade->id == $Membro->instituicao_IES) ? "selected" : "";
							echo ">".$faculdade->nome."(".$faculdade->sigla.")</option>";
						}
						?>
					</select>
				</span>
				<span><input type="text" name="ano" placeholder="Ano IES:" style="width:5% !important;" value="<?=$Membro->ano?>"></span>
				<span>
					<select name="origem" id="" style="width:25% !important;">
						<?php
						$selectFaculdades = $objConn->prepare("SELECT * FROM `instituto`");
						$selectFaculdades->execute();
						while($faculdade = $selectFaculdades->fetchObject()){
							echo "<option value='".$faculdade->id."'";
							echo ($faculdade->id == $Membro->instituicao_origem) ? "selected" : "";
							echo ">".$faculdade->nome."(".$faculdade->sigla.")</option>";
						}
						?>
					</select>
				</span>
				<input type='hidden' name='editar' value='<?=$Membro->id?>'>
				<span><button type="submit" class="button" style="width:18% !important; position: relative;">Editar Membro</button></span>
			</form>
			<br>
			<form method="post">
				<input type='hidden' name='deletar' value='<?=$Membro->id?>'>
				<span><button type="submit" class="button danger" style="position: relative;">Deletar <?=$Membro->nome?></button></span>
			</form>
		<?php 
			echo '<p>';
			$selectBancas = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `membro_da_banca` = ? ORDER BY `defesa` DESC");
			$selectBancas->execute(array($Membro->id));
			while($Bancas = $selectBancas->fetchObject()) {
				$selectInfos =  $objConn->prepare("SELECT * FROM `defesa` WHERE `id` = ?");
				$selectInfos->execute(array($Bancas->defesa));
				$Infos = $selectInfos->fetchObject();
				echo "<h3>".$Infos->titulo." - ".$Infos->nivel;
				if($Bancas->orientador == 0) echo " (Orientador)";
				echo "</h3>";
				$selectAlunoe = $objConn->prepare("SELECT * FROM `aluno` WHERE `RA` = ?");
				$selectAlunoe->execute(array($Infos->aluno));
				$Alunoe = $selectAlunoe->fetchObject();
				echo "<h4>".$Alunoe->nome." (".$Infos->aluno.")</h4>";
				echo "<h5>".$Infos->local."</h5>";
				$data = strftime("%A, %d de %B de %Y",strtotime($Infos->data));
				echo "<h5>Apresentado: ".utf8_encode($data)."</h5>";
				echo "<ul>
					<p>Banca composta por:</p>";
				$selectBancaM = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `defesa` = ? ORDER BY `orientador` ASC");
				$selectBancaM->execute(array($Infos->id));
				while($BancaM = $selectBancaM->fetchObject()){
					$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
					$selectMembro->execute(array($BancaM->membro_da_banca));
					$Membro = $selectMembro->fetchObject();
					echo "<li>".$Membro->nome;
					if($BancaM->orientador == 0) echo " (Orientador)";
					echo "</li>";
				}
				echo "</ul>";
				echo '<hr>';
			}
			echo'</p>';
		} ?>
	</div>
</div>