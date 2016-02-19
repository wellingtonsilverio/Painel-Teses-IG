<?php
	if(isset($_POST['criar'])){
		$insertMembro = $objConn->prepare("INSERT INTO `membro_da_banca` (`titulo`,`nome`,`cpf`,`rg`,`data_nacimento`,`telefone`,`endereco`,`email`,`formacao_academica`,`instituicao_IES`,`ano`,`instituicao_origem`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		if($insertMembro->execute(array($_POST['titulo'],$_POST['nome'],$_POST['cpf'],$_POST['rg'],$_POST['data'],$_POST['tel'],$_POST['end'],$_POST['email'],$_POST['for'],$_POST['inst'],$_POST['ano'],$_POST['origem']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 5, "com nome: ".$_POST['nome']);
		}
	}
	if(isset($_POST['adicionar'])){
		$insertMembroBanca = $objConn->prepare("INSERT INTO `defesa_professor` (`defesa`,`membro_da_banca`,`orientador`,`titular`) VALUES (?,?,?,?)");
		if($insertMembroBanca->execute(array($_POST['adicionar'], $_POST['participante'], $_POST['nivel'], $_POST['cat']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 7, "o participante ".$_POST['participante']."na banca: ".$_POST['adicionar']);
		}
	}
	if(isset($_POST['deleteMembro'])){
		$deleteMembro = $objConn->prepare("DELETE FROM `defesa_professor` WHERE `id` = ?");
		if($deleteMembro->execute(array($_POST['deleteMembro']))){
			GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 11, "Deletou o membro ".$_POST['deleteDefesaMembro']." da banca ".$_POST['deleteMembroDefesa']);
		}
	}
?>
<div class="painelInput">
	<div class="input-control text">
		<h1>Adicionar Membro</h1><form method="post">
		<form method="post">
			<span><input type="text" name="titulo" placeholder="Titulo:" style="width:20% !important;"></span>
			<span><input type="text" class="nomeMembro" name="nome" placeholder="Nome:" style="width:79% !important;" autocomplete='off'><div class="display-membro"></div></span>
			<span><input type="text" name="cpf" placeholder="CPF:" style="width:50% !important;"></span>
			<span><input type="text" name="rg" placeholder="RG:" style="width:49% !important;"></span>
			<span><input type="text" name="data" placeholder="Data de Nacimento:" style="width:40% !important;"></span>
			<span><input type="text" name="tel" placeholder="Telefone" style="width:59% !important;"></span>
			<span><input type="text" name="end" placeholder="Endereço:" style="width:60% !important;"></span>
			<span><input type="text" name="email" placeholder="E-mail:" style="width:39% !important;"></span>
			<span><input type="text" name="for" placeholder="Formação Academica" style="width:25% !important;"></span>
			<span><select name="inst" id="" style="width:25% !important;">
				<option value="">Instituição IES</option>
				<?php
					$selectInstituicao = $objConn->prepare("SELECT * FROM `instituto`");
					$selectInstituicao->execute();
					while($Instituicao = $selectInstituicao->fetchObject())
						echo '<option value="'.$Instituicao->id.'">'.$Instituicao->nome.'('.$Instituicao->sigla.')</option>';
				?>
			</select></span>
			<span><input type="text" name="ano" placeholder="Ano IES:" style="width:5% !important;"></span>
			<span><select name="origem" id="" style="width:25% !important;">
				<option value="">Instituição de origem</option>
				<?php
					$selectInstituicao = $objConn->prepare("SELECT * FROM `instituto`");
					$selectInstituicao->execute();
					while($Instituicao = $selectInstituicao->fetchObject())
						echo '<option value="'.$Instituicao->id.'">'.$Instituicao->nome.'('.$Instituicao->sigla.')</option>';
				?>
			</select></span>
			<input type='hidden' name='criar' value='membro'>
			<span><button type="submit" class="button" style="width:18% !important; position: relative;">Criar Membro</button></span>
		</form>
		<h1>Dissertações</h1><form method="post">
		<span style="width:100% !important;"><select name="dissertacaoId" style="width:100% !important;" onchange="this.form.submit()">
			<option>>> Escolha uma dissertação para Adicionar/editar membros</option>
			<?php
				$selectDissertacao = $objConn->prepare("SELECT * FROM `defesa` ORDER BY `titulo` ASC");
				$selectDissertacao->execute();
				while($dissertacao = $selectDissertacao->fetchObject()){
					echo "<option value='".$dissertacao->id."'>".$dissertacao->titulo." (".$dissertacao->nivel.")</option>";
				}
			?>
		</select></span></form>
		<?php
		if(isset($_POST['dissertacaoId'])){
			$selectDissertacaog = $objConn->prepare("SELECT * FROM `defesa` WHERE `id` = ?");
			$selectDissertacaog->execute(array($_POST['dissertacaoId']));
			$dissertacao = $selectDissertacaog->fetchObject();
			?>
		<h3><?=$dissertacao->titulo;?></h3>
		<br/>
		<div class="grid">
	        <div class="row cells1">
	        	<div class="cell">
	        		<form action="" method="post">
	        			<span><span class="titulo-input">Adicionar participante da banca:</span>
							<span class="span-input"><span class="titulo-input">:</span><select name="participante" style="width:50% !important;" id="">
								<option>>> Escolha uma Membro para Adicionar a dissertação</option>
								<?php
									$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` ORDER BY `nome` ASC");
									$selectMembro->execute();
									while($membro = $selectMembro->fetchObject()){
										echo "<option value='".$membro->id."'>".$membro->titulo." ".$membro->nome."</option>";
									}
								?>
							</select></span>
						</span>
						<span class="span-input"><span class="titulo-input">:</span><select name="nivel" style="width:29% !important;" id="">
							<option value="0">Orientador</option>
							<option value="1">Co-orientador</option>
							<option value="2" selected>Membro</option>
						</select></span>
						<span class="span-input"><span class="titulo-input">:</span><select name="cat" style="width:15% !important;" id="">
							<option value="0">Titular</option>
							<option value="1">Suplente</option>
						</select></span>
						<button type="submit" style="width:5% !important;" class='button'>+</button>
						<input type='hidden' name='adicionar' value='<?=$dissertacao->id;?>'>
	        		</form>
				</div>
			</div>
		</div>
		<div class="grid">
	        <div class="row cells2">
	            <div class="cell">
					<h4>Titulares</h4>
					<?php
						$selectMembroDiss = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `titular` = '0'");
						$selectMembroDiss->execute(array($dissertacao->id));
						while($DefesaMembro = $selectMembroDiss->fetchObject()){
							$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
							$selectMembro->execute(array($DefesaMembro->membro_da_banca));
							$Membro = $selectMembro->fetchObject();
							$selectInstituicao = $objConn->prepare("SELECT * FROM `instituto` WHERE `id` = ?");
							$selectInstituicao->execute(array($Membro->instituicao_origem));
							if($Instituicao = $selectInstituicao->fetchObject()){
								$selectFaculdade = $objConn->prepare("SELECT * FROM `faculdade` WHERE `id` = ?");
								$selectFaculdade->execute(array($Instituicao->faculdade));
								if($Faculdade = $selectFaculdade->fetchObject()){

								}
							}else{
								$Faculdade = null;
							}

							//Verificar quais Dissetacoes ele participou
							$selectParticipou = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `membro_da_banca` = ?");
							$selectParticipou->execute(array($Membro->id));

							//verificar o orientador dessa dissertação
							
							?>
					<div class="row cells2" data-role="hint"
                        data-hint-background="bg-green"
                        data-hint-color="fg-white"
                        data-hint-position="top"
                        data-hint-mode="1"
                        data-hint="<?=$Membro->nome;?>|<?php
                        $Participou = $selectParticipou->fetchObject();
                		//Informacoes da Dissertação que ele participou
                		$selectInfoParticipou = $objConn->prepare('SELECT * FROM `defesa` WHERE `id` = ?');
						$selectInfoParticipou->execute(array($Participou->defesa));
						$InfoParticipou = $selectInfoParticipou->fetchObject();
						$selectOrientadorParticipou = $objConn->prepare('SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `orientador` < ?');
						$selectOrientadorParticipou->execute(array($InfoParticipou->id, '1'));
						$OrientadorParticipou = $selectOrientadorParticipou->fetchObject();
						$selectMembroO = $objConn->prepare('SELECT * FROM `membro_da_banca` WHERE `id` = ?');
						$selectMembroO->execute(array($OrientadorParticipou->membro_da_banca));
						$MembroOrientador = $selectMembroO->fetchObject();
						echo 'Em '.date_format(new DateTime($InfoParticipou->data), 'd/M/Y').' no '.$InfoParticipou->nivel.' como '.(($Participou->titular)? "Suplente" : "Titular").' com orientador '.$MembroOrientador->titulo.' '.$MembroOrientador->nome;
                        	while($Participou = $selectParticipou->fetchObject()){
                        		//Informacoes da Dissertação que ele participou
                        		$selectInfoParticipou = $objConn->prepare('SELECT * FROM `defesa` WHERE `id` = ?');
								$selectInfoParticipou->execute(array($Participou->defesa));
								$InfoParticipou = $selectInfoParticipou->fetchObject();
								$selectOrientadorParticipou = $objConn->prepare('SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `orientador` < ?');
								$selectOrientadorParticipou->execute(array($InfoParticipou->id, '1'));
								$OrientadorParticipou = $selectOrientadorParticipou->fetchObject();
								$selectMembroO = $objConn->prepare('SELECT * FROM `membro_da_banca` WHERE `id` = ?');
								$selectMembroO->execute(array($OrientadorParticipou->membro_da_banca));
								$MembroOrientador = $selectMembroO->fetchObject();
								echo '<hr>'.'Em '.date_format(new DateTime($InfoParticipou->data), 'd/M/Y').' no '.$InfoParticipou->nivel.' como '.(($Participou->titular)? "Suplente" : "Titular").' com orientador '.$MembroOrientador->titulo.' '.$MembroOrientador->nome;
							}
                        ?>">
							<div class="cell">
								<?php if($DefesaMembro->orientador == "2") echo "<span class='mif-justice mif-lg fg-green'></span>"; else if($DefesaMembro->orientador == "1") echo "<span class='mif-users mif-lg fg-green'></span>"; else echo "<span class='mif-user mif-lg fg-blue'></span>"; ?>
								<?=$Membro->nome;?>
							</div>
							<div class="cell">
								(<?=isset($Instituicao->nome)?$Instituicao->nome:"N/A";?> - <?=isset($Faculdade->siglas)?$Faculdade->siglas:"N/A";?>)
								<form method="post">
									<input type="hidden" name="deleteMembro" value="<?=$DefesaMembro->id;?>">
									<input type="hidden" name="deleteMembroDefesa" value="<?=$DefesaMembro->defesa;?>">
									<input type="hidden" name="deleteDefesaMembro" value="<?=$Membro->nome;?>">
									<button type="submit" class="buttonSmall button rounded danger">X</button>
								</form>
							</div>
					</div>
					<?php } ?>
	            </div>
	            <div class="cell">
					<h4>Suplentes</h4>
					<?php
						$selectMembroDiss = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `titular` = '1'");
						$selectMembroDiss->execute(array($dissertacao->id));
						while($DefesaMembro = $selectMembroDiss->fetchObject()){
							$selectMembro = $objConn->prepare("SELECT * FROM `membro_da_banca` WHERE `id` = ?");
							$selectMembro->execute(array($DefesaMembro->membro_da_banca));
							$Membro = $selectMembro->fetchObject();
							$selectInstituicao = $objConn->prepare("SELECT * FROM `instituto` WHERE `id` = ?");
							$selectInstituicao->execute(array($Membro->instituicao_origem));
							if($Instituicao = $selectInstituicao->fetchObject()){
								$selectFaculdade = $objConn->prepare("SELECT * FROM `faculdade` WHERE `id` = ?");
								$selectFaculdade->execute(array($Instituicao->faculdade));
								if($Faculdade = $selectFaculdade->fetchObject()){

								}
							}else{
								$Faculdade = null;
							}

							//Verificar quais Dissetacoes ele participou
							$selectParticipou = $objConn->prepare("SELECT * FROM `defesa_professor` WHERE `membro_da_banca` = ?");
							$selectParticipou->execute(array($Membro->id));

							//verificar o orientador dessa dissertação
							?>
					<div class="row cells2" data-role="hint"
                        data-hint-background="bg-green"
                        data-hint-color="fg-white"
                        data-hint-position="top"
                        data-hint-mode="1"
                        data-hint="<?=$Membro->nome;?>|<?php
                        $Participou = $selectParticipou->fetchObject();
                		//Informacoes da Dissertação que ele participou
                		$selectInfoParticipou = $objConn->prepare('SELECT * FROM `defesa` WHERE `id` = ?');
						$selectInfoParticipou->execute(array($Participou->defesa));
						$InfoParticipou = $selectInfoParticipou->fetchObject();
						$selectOrientadorParticipou = $objConn->prepare('SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `orientador` < ?');
						$selectOrientadorParticipou->execute(array($InfoParticipou->id, '1'));
						$OrientadorParticipou = $selectOrientadorParticipou->fetchObject();
						$selectMembroO = $objConn->prepare('SELECT * FROM `membro_da_banca` WHERE `id` = ?');
						$selectMembroO->execute(array($OrientadorParticipou->membro_da_banca));
						$MembroOrientador = $selectMembroO->fetchObject();
						echo 'Em '.date_format(new DateTime($InfoParticipou->data), 'd/M/Y').' no '.$InfoParticipou->nivel.' como '.(($Participou->titular)? "Suplente" : "Titular").' com orientador '.$MembroOrientador->titulo.' '.$MembroOrientador->nome;
                        	while($Participou = $selectParticipou->fetchObject()){
                        		//Informacoes da Dissertação que ele participou
                        		$selectInfoParticipou = $objConn->prepare('SELECT * FROM `defesa` WHERE `id` = ?');
								$selectInfoParticipou->execute(array($Participou->defesa));
								$InfoParticipou = $selectInfoParticipou->fetchObject();
								$selectOrientadorParticipou = $objConn->prepare('SELECT * FROM `defesa_professor` WHERE `defesa` = ? AND `orientador` < ?');
								$selectOrientadorParticipou->execute(array($InfoParticipou->id, '1'));
								$OrientadorParticipou = $selectOrientadorParticipou->fetchObject();
								$selectMembroO = $objConn->prepare('SELECT * FROM `membro_da_banca` WHERE `id` = ?');
								$selectMembroO->execute(array($OrientadorParticipou->membro_da_banca));
								$MembroOrientador = $selectMembroO->fetchObject();
								echo '<hr>'.'Em '.date_format(new DateTime($InfoParticipou->data), 'd/M/Y').' no '.$InfoParticipou->nivel.' como '.(($Participou->titular)? "Suplente" : "Titular").' com orientador '.$MembroOrientador->titulo.' '.$MembroOrientador->nome;
							}
                        ?>">
							<div class="cell">
								<?php if($DefesaMembro->orientador == "2") echo "<span class='mif-justice mif-lg fg-green'></span>"; else if($DefesaMembro->orientador == "1") echo "<span class='mif-users mif-lg fg-green'></span>"; else echo "<span class='mif-user mif-lg fg-blue'></span>"; ?>
								<?=$Membro->nome;?>
							</div>
							<div class="cell">
								(<?=isset($Instituicao->nome)?$Instituicao->nome:"N/A";?> - <?=isset($Faculdade->siglas)?$Faculdade->siglas:"N/A";?>)
								<form method="post">
									<input type="hidden" name="deleteMembro" value="<?=$DefesaMembro->id;?>">
									<input type="hidden" name="deleteMembroDefesa" value="<?=$DefesaMembro->defesa;?>">
									<input type="hidden" name="deleteDefesaMembro" value="<?=$Membro->nome;?>">
									<button type="submit" class="buttonSmall button rounded danger">X</button>
								</form>
							</div>
					</div>
					<?php } ?>
	            </div>
	        </div>
	    </div>
		<?php } ?>
	</div>
</div>