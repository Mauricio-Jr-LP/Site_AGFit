<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.carrosel',$idExcluir);
		echo "<script>alert('Produto excluido com sucesso');</script>";

	}
?>

<?php
	verificaPermissaoPagina(2);
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Slide</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$palavra_destaque1 = $_POST['palavra_destaque1'];
				$texto = $_POST['texto'];
				$palavra_destaque2 = $_POST['palavra_destaque2'];
				$texto2 = $_POST['texto2'];
				$imagem = $_FILES['imagem'];

				if($nome == ''){
					Painel::alert('erro','Campos Vázios não são permitidos!');
				}else{
					if(Painel::imagemValida($imagem)){
						$verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.carrosel` WHERE nome=?");
						$verifica->execute(array($nome));
						if($verifica->rowCount() == 0){
						$imagem = Painel::uploadFile($imagem);
						$arr = ['palavra_destaque1'=>$palavra_destaque1,'texto'=>$texto,
							'palavra_destaque2'=>$palavra_destaque2,'texto2'=>$texto2,
							'imagem'=>$imagem,'nome'=>$nome,'order_id=>0','nome_tabela'=>'tb_site.carrosel'];
						if(Painel::insert($arr)){
							Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-carrousel?sucesso');
						}

						//Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
						}else{
							Painel::alert('erro','Já existe um slide com esse nome!');
						}
					}else{
						Painel::alert('erro','Selecione uma imagem válida!');
					}
					
				}
				
				
			}
			if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
				Painel::alert('sucesso','O cadastro foi realizado com sucesso!');
			}
		?>
	<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" >
		</div><!--form-group-->	

		<div class="form-group">
			<label>Palavra em Destaque 1</label>
			<input type="text" name="palavra_destaque1">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Texto</label>
			<input type="text" name="texto" >
		</div><!--form-group-->	

		<div class="form-group">
			<label>Palavra em Destaque 2</label>
			<input type="text" name="palavra_destaque2">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Texto</label>
			<input type="text" name="texto2">
		</div><!--form-group-->	

		
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->
		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="cadastrar_carrousel">
		</div>
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->

<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Slides Cadastrados</h2>
	
	<?php
		$carrosel = MySql::conectar()->prepare("SELECT * FROM `tb_site.carrosel` ");
		$carrosel->execute();
		$carrosel = $carrosel->fetchAll();
		
		foreach($carrosel as $key => $value){
	?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="topo-box">
					<?php
						if($value['imagem'] == ''){
					?>
					<h2><i class="fa fa-user"></i></h2>
					<?php }else{ ?>
						<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem']; ?>" />
					<?php } ?>
				</div><!--topo-box-->
				<div class="body-box">
					<p><b><i class="fa fa-pencil"></i> Ordem:</b> <?php echo $value['id']; ?>º</p>
					<p><b><i class="fa fa-pencil"></i> Nome do slide:</b> <?php echo $value['nome']; ?></p>
					
					<div class="group-btn">
						<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-carrosel?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar-carrousel?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->

