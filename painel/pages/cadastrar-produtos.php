<div class="box-content">

	<h2><i class="fa fa-pencil"></i> Cadastrar Produto</h2>


	<form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">
		
		<div class="form-group">
			<label>Código:</label>
			<input type="number" name="id">
		</div><!--form-group-->


		<div class="form-group">
			<label>Nome do produto:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Valor:</label>
			<input type="text" placeholder="valor separado por . (ponto)" name="valor"></input>
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
			<label>Selecione as imagens:</label>
			<input multiple type="file" name="imagem">
		</div><!--form-group-->
		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="cadastrar_produto">
		</div>
		<input type="submit" name="acao" value="Cadastrar Produto!">

	</form>

</div><!--box-content-->