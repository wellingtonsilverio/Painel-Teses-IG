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
		<div class="menu bg-darkMagenta lag fg-white">
			<h1 class="titulo-menu">Membros</h1>
			<ul class="menu-pagina menu-paginaa">
				<a href="?p=membro&amp;pa=criar"><li>Criar</li></a>
				<a href="?p=membro&amp;pa=editar"><li>Editar</li></a>
				<a href="?p=membro&amp;pa=curso"><li>Cursos</li></a>
				<a href="?p=membro&amp;pa=instituto"><li>Instituto</li></a>
				<a href="?p=membro&amp;pa=faculdade"><li>Faculdade</li></a>
			</ul>
		</div>
	</div>
	<div class="cell colspan2">
		<?php
			if(isset($_GET['pa'])){
				include "membro/".$_GET['pa'].".php";
			}else{
				include "membro/criar.php";
			}
		?>
	</div>
</div>