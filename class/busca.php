<?php
require_once "conexao.class.php";

$objCon = Conexao::getInstance();

$pesquisa = $_POST['pesquisa'];

/*$selectAluno = $objCon->prepare("SELECT * FROM `aluno` WHERE `RA` = ? OR `nome` LIKE ? LIMIT 0,3");
$selectAluno->execute(array($pesquisa,"%".$pesquisa."%"));

if($selectAluno->rowCount()){
	echo "<div class='titulo-linha'>Alunos</div>";
}else{
	echo "<a href='?p=aluno&amp;aluno=".$pesquisa."'><div class='linha text-shadow align-center'>Adicionar o aluno ".$pesquisa."</div></a>";
}
while($aluno = $selectAluno->fetchObject()){
	echo "<a href='?p=aluno&amp;aluno=".$aluno->RA."'><div class='linha'>".$aluno->nome."(RA: ".$aluno->RA.")</div></a>";
}*/

$selectMembro = $objCon->prepare("SELECT * FROM `membro_da_banca` WHERE `nome` LIKE ?");
$selectMembro->execute(array("%".$pesquisa."%"));

if($selectMembro->rowCount()){
	echo "<div class='titulo-linha'>Membros das Bancas</div>";
}
while($membro = $selectMembro->fetchObject()){
	echo "<a href='?p=editmembros&amp;membro=".$membro->id."'><div class='linha'>".$membro->nome."</div></a>";
}
/*
$selectDissetacao = $objCon->prepare("SELECT * FROM `defesa` WHERE `aluno` = ? OR `titulo` LIKE ? LIMIT 0,3");
$selectDissetacao->execute(array($pesquisa,"%".$pesquisa."%"));

if($selectDissetacao->rowCount()){
	echo "<div class='titulo-linha'>Dissertações</div></a>";
}
while($dissertacoes = $selectDissetacao->fetchObject()){
	echo "<a href='?p=aluno&aluno=".$dissertacoes->aluno."&pa=membro'><div class='linha'>".$dissertacoes->titulo."(Aluno: ".$dissertacoes->aluno.")</div>";
}*/
?>