<div class="box-content">

	<h2><i class="fa fa-pencil"></i> Adicionar foto</h2>


	<form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">
		

		<div class="form-group">
			<label>Selecione as imagens:</label>
			<input multiple type="file" name="imagem">
		</div><!--form-group-->
		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="cadastrar_foto">
		</div>
		<input type="submit" name="acao" value="Adicionar Foto!">

	</form>

</div><!--box-content-->