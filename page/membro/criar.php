<div class="editor">
	<?php
	if(isset($_POST['criar'])){
		$insertMembro = $objConn->prepare("INSERT INTO `membro_da_banca` (`titulo`,`nome`,`cpf`,`rg`,`data_nacimento`,`telefone`,`endereco`,`email`,`formacao_academica`,`instituicao_IES`,`ano`,`instituicao_origem`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		if($insertMembro->execute(array($_POST['titulo'],$_POST['nome'],$_POST['cpf'],$_POST['rg'],$_POST['data'],$_POST['tel'],$_POST['end'],$_POST['email'],$_POST['for'],$_POST['inst'],$_POST['ano'],$_POST['origem']))){
			header("Location: index.php?p=".$_GET['p']."");
		}
	}
	echo "<h1>Adicionar novo membro</h1>
	<div class='input-control text'>
		<form method='POST'>
			Titulo do membro(Dr. Prof.)<input type='text' name='titulo' id='' placeholder='Titulo'>
			Nome do membro<input type='text' name='nome' id='' placeholder='Nome'>
			CPF do membro<input type='text' name='cpf' id='' placeholder='CPF'>
			RG do membro<input type='text' name='rg' id='' placeholder='RG'>
			Data de nacimento do membro<div class='input-control text' data-role='datepicker'><input type='text' name='data' id='' placeholder='Data de nacimento'></div><br/><br/>
			Telefone do membro<input type='text' name='tel' id='' placeholder='Telefone'>
			Endereço do membro<input type='text' name='end' id='' placeholder='Endereço'>
			E-mail do membro<input type='text' name='email' id='' placeholder='E-mail'>
			Formação Academicado membro<input type='text' name='for' id='' placeholder='Formação Academica'>
			Instituto IES<select name='inst' id=''>";
				$selectFaculdades = $objConn->prepare("SELECT * FROM `instituto`");
				$selectFaculdades->execute();
				while($faculdade = $selectFaculdades->fetchObject()){
					echo "<option value='".$faculdade->id."'>".$faculdade->nome."(".$faculdade->sigla.")</option>";
				}
				echo "
			</select>
			Ano de formação do membro<input type='text' name='ano' id='' placeholder='Ano'>
			Faculdade de origem<select name='origem' id=''>";
				$selectFaculdades = $objConn->prepare("SELECT * FROM `faculdade`");
				$selectFaculdades->execute();
				while($faculdade = $selectFaculdades->fetchObject()){
					echo "<option value='".$faculdade->id."'>".$faculdade->nome."(".$faculdade->siglas.")</option>";
				}
				echo "
			</select>
			<input type='hidden' name='criar' value='criar'>
			<button type='submit' class='button'>Adicionar</button>
		</form>
	</div>";
	?>
</div>