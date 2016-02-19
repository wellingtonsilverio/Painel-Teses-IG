<div class="editor">
	<?php
	if(isset($_POST['sigla']) && isset($_POST['pais']) && isset($_POST['cidade'])){
		$insertFaculdade = $objConn->prepare("INSERT INTO `faculdade` (`siglas`,`nome`,`rua`,`bairro`,`cidade`,`estado`,`pais`) VALUES (?,?,?,?,?,?,?)");
		if($insertFaculdade->execute(array($_POST['sigla'],$_POST['nome'],$_POST['rua'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['pais']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	?>
	<h1>Adicionar nova faculdade</h1>
	<div class='input-control text'>
		<form method="POST">
			Sigla da faculdade<input type="text" name="sigla" id="" placeholder="Sigla">
			Nome da faculdade<input type="text" name="nome" id="" placeholder="Nome">
			CEP da faculdade<input type="text" name="cep" class="cep" id="" placeholder="CEP">
			<input type="hidden" name="rua" id="rua">
			<input type="hidden" name="bairro" id="bairro">
			<input type="hidden" name="cidade" id="cidade">
			<input type="hidden" name="estado" id="estado">
			<input type="hidden" name="pais" id="pais">
			<button type="submit" class='button' disabled id="buttonFaculdade">Adicionar faculdade</button>
		</form>
	</div>
</div>
<script>
$('document').ready(function(){
	$('.cep').keyup(function(){
		var $this = $(this);
		var cep = $this.val();
		if(cep.length >= 8){
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
				if (resultadoCEP["resultado"] != 0) {
	                $("#rua").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
	                $("#bairro").val(unescape(resultadoCEP["bairro"]));
	                $("#cidade").val(unescape(resultadoCEP["cidade"]));
	                $("#estado").val(unescape(resultadoCEP["uf"]));
	                $("#pais").val("Brasil");
	                $("#buttonFaculdade").removeAttr("disabled");
	            }
			});
		}
	});
});
</script>