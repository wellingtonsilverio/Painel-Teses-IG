<div class="editor">
	<?php
	if(isset($_POST['editar'])){
		$updateMembro = $objConn->prepare("UPDATE `membro_da_banca` SET `titulo` = ?,`nome` = ?,`cpf` = ?,`rg` = ?,`data_nacimento` = ?,`telefone` = ?,`endereco` = ?,`email` = ?,`formacao_academica` = ?,`instituicao_IES` = ?,`ano` = ?,`instituicao_origem` = ? WHERE `id` = ?");
		if($updateMembro->execute(array($_POST['titulo'],$_POST['nome'],$_POST['cpf'],$_POST['rg'],$_POST['data'],$_POST['tel'],$_POST['end'],$_POST['email'],$_POST['for'],$_POST['inst'],$_POST['ano'],$_POST['origem'],$_POST['editar']))){
			header("Location: index.php?p=".$_GET['p']."");
		}
	}
	?>
	<h1>Editar Membro</h1>
	<div class='input-control text'>
		<form method="POST">
			<select name="membro" id="">
				<?php
				$selectMembros = $objConn->prepare("SELECT * FROM `membro_da_banca` ORDER BY `nome` ASC");
				$selectMembros->execute();
				while($membro = $selectMembros->fetchObject()){
					echo "<option value='".$membro->id."'>".$membro->nome."</option>";
				}
				?>
			</select>
			<button type="submit" class='button'>Editar Membro</button>
		</form>
	</div>
	<br/><br/><br/><br/>
	<?php
	if(isset($_POST['membro'])){
		$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
		$selectMembro->execute(array($_POST['membro']));
		if($membro = $selectMembro->fetchObject()){
			echo "<h1>Editar membro</h1>
			<div class='input-control text'>
				<form method='POST'>
					Titulo do membro(Dr. Prof.)<input type='text' name='titulo' id='' placeholder='Titulo' value='".$membro->titulo."'>
					Nome do membro<input type='text' name='nome' id='' placeholder='Nome' value='".$membro->nome."'>
					CPF do membro<input type='text' name='cpf' id='' placeholder='CPF' value='".$membro->cpf."'>
					RG do membro<input type='text' name='rg' id='' placeholder='RG' value='".$membro->rg."'>
					Data de nacimento do membro<input type='text' name='data' id='' placeholder='Data de nacimento' value='".$membro->data_nacimento."'>
					Telefone do membro<input type='text' name='tel' id='' placeholder='Telefone' value='".$membro->telefone."'>
					Endereço do membro<input type='text' name='end' id='' placeholder='Endereço' value='".$membro->endereco."'>
					E-mail do membro<input type='text' name='email' id='' placeholder='E-mail' value='".$membro->email."'>
					Formação Academicado membro<input type='text' name='for' id='' placeholder='Formação Academica' value='".$membro->formacao_academica."'>
					Instituto IES<select name='inst' id=''>";
						$selectFaculdades = $objConn->prepare("SELECT * FROM `instituto`");
						$selectFaculdades->execute();
						while($faculdade = $selectFaculdades->fetchObject()){
							$select = "";
							if($membro->instituicao_IES == $faculdade->id) $select = "selected";
							echo "<option value='".$faculdade->id."' ".$select.">".$faculdade->nome."(".$faculdade->sigla.")</option>";
						}
						echo "
					</select>
					Ano de formação do membro<input type='text' name='ano' id='' placeholder='Ano' value='".$membro->ano."'>
					Faculdade de origem<select name='origem' id=''>";
						$selectFaculdades = $objConn->prepare("SELECT * FROM `faculdade`");
						$selectFaculdades->execute();
						while($faculdade = $selectFaculdades->fetchObject()){
							$select = "";
							if($membro->instituicao_IES == $faculdade->id) $select = "selected";
							echo "<option value='".$faculdade->id."' ".$select.">".$faculdade->nome."(".$faculdade->siglas.")</option>";
						}
						echo "
					</select>
					<input type='hidden' name='editar' value='".$membro->id."'>
					<button type='submit' class='button'>Editar</button>
				</form>
			</div>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
		}else{
			echo "Erro";
		}
	}
	?>
</div>