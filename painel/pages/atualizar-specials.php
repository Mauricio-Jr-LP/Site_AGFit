<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$produto = Painel::select('tb_site.config.specials','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<div class="box-content">

	<h2><i class="fa fa-pencil"></i> Atualizar <?php echo $produto['id']; ?>º Destaque</h2>


	<form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">
		
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo $produto['nome']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Descrição em italico</label>
			<input type="text" name="desc1" value="<?php echo $produto['desc1']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Descrição completa</label>
			<textarea type="text" name="desc2" value="<?php echo $produto['desc2']; ?>"></textarea>
		</div><!--form-group-->	
		
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_specials">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form><!--form-->

</div><!--box-content-->