<div class="editor">
	<?php
	if(isset($_POST['dissertacao'])){
		$insertDiserMembro = $objConn->prepare("INSERT INTO `defesa_professor` (`defesa`,`membro_da_banca`,`orientador`) VALUES (?,?,?)");
		if($insertDiserMembro->execute(array($_POST['dissertacao'],$_POST['membro'],$_POST['tipo']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_POST['defmembro'])){
		$deleteDefMembro = $objConn->prepare("DELETE FROM `defesa_professor` WHERE `id` = ?");
		if($deleteDefMembro->execute(array($_POST['defmembro']))){
			header("Location: index.php?p=".$_GET['p']."&aluno=".$_GET['aluno']."&pa=".$_GET['pa']."");
		}
	}
	if(isset($_GET['aluno'])){
		$selectAluno = $objConn->prepare("SELECT * FROM `aluno` WHERE `ra` = ?");
		$selectAluno->execute(array($_GET['aluno']));
		if($aluno = $selectAluno->fetchObject()){
			$selectDissertacao = $objConn->prepare("SELECT * FROM `defesa` WHERE `aluno` = ?");
			$selectDissertacao->execute(array($aluno->RA));
			while($defesa = $selectDissertacao->fetchObject()){
		?>
		<h1>Adicionar Membro</h1>
		<h3><?=$defesa->titulo?></h3>
		<form method="POST">
			<div class='input-control text'>
				<select name="membro" id="">
					<?php
					$selectMembros = $objConn->prepare("SELECT * FROM `membro_da_banca` ORDER BY `nome` ASC");
					$selectMembros->execute();
					while($membro = $selectMembros->fetchObject()){
						echo "<option value='".$membro->id."'>".$membro->nome."</option>";
					}
					?>
				</select>
				<select name="tipo" id="">
					<option value="0">Membro</option>
					<option value="2">Orientador</option>
					<option value="1">Co-orientador</option>
				</select>
				<input type="hidden" name="dissertacao" value="<?=$defesa->id?>">
				<button type="submit" class='button'>Adicionar Membro na defesa</button>
			</div>
		</form>
		<?php
				$selectDefesaMembro = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `defesa` = ?");
				$selectDefesaMembro->execute(array($defesa->id));
				if($selectDefesaMembro->RowCount()) echo "<br/><br/><br/><br/><br/><br/><br/><h1>Editar Membros</h1>";
				while($DefesaMembro = $selectDefesaMembro->fetchObject()){
					$selectMembros = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
					$selectMembros->execute(array($DefesaMembro->membro_da_banca));
					while($membro = $selectMembros->fetchObject()){
						echo "<form method='POST'>";
						if($DefesaMembro->orientador == "2") echo "<span class='mif-justice mif-lg fg-green'></span>"; else if($DefesaMembro->orientador == "1") echo "<span class='mif-users mif-lg fg-green'></span>"; else echo "<span class='mif-user mif-lg fg-blue'></span>";
						echo " ".$membro->nome." <input type='hidden' name='defmembro' value='".$DefesaMembro->id."'><button type='submit' class='button fg-crimson btn-remove'><span class='mif-user-minus fg-crimson'></span> &nbsp;Reirar membro</button></form>";
					}
				}
				echo "<hr/>";
			}
		}
	}
	?>
</div>