<?php
if(isset($_GET['aluno'])){
	if(is_numeric($_GET['aluno'])){
		$ra = $_GET['aluno'];
		$nome = "";
	}else{
		$ra = "";
		$nome = $_GET['aluno'];
	}
}
?>
<div class="row cells3">
	<div class="cell">
		<div class="menu bg-olive lag fg-white">
			<h1 class="titulo-menu">Alunos</h1>
			<ul class="menu-pagina">
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=aluno"><li>Aluno</li></a>
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=curso"><li>Cursos</li></a>
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=instituto"><li>Instituto</li></a>
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=faculdade"><li>Faculdade</li></a>
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=dissertacao"><li>Dissertação</li></a>
				<a href="?p=aluno&amp;aluno=<?=$_GET['aluno']?>&amp;pa=membro"><li>Membros da banca</li></a>
			</ul>
		</div>
	</div>
	<div class="cell colspan2">
		<?php
			if(isset($_GET['pa'])){
				include "aluno/".$_GET['pa'].".php";
			}else{
				include "aluno/aluno.php";
			}
		?>
	</div>
</div>