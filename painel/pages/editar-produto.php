<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$produto = Painel::select('tb_site.produtos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Produto</h2>

	<form class="ajax" atualizar method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" enctype="multipart/form-data">

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo $produto['nome']; ?>">
		</div><!--form-group-->	

		<div ref="cpf" class="form-group">
			<label>Valor:</label>
			<input  type="text" placeholder="valor separado por . (ponto)"  name="valor" value="<?php echo $produto['valor']; ?>" />
		</div><!--form-group-->

		<select name="categoria_id">
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem" />
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_produto">
		</div>

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
		</div>

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->