<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$colaborador = Painel::select('tb_site.colaboradores','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar colaboradores</h2>

	<form class="ajax" atualizar method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" enctype="multipart/form-data">

		<div class="form-group">
    		<label>Nome:</label>
    		<input type="text" name="nome" value="<?php echo $colaborador['nome']; ?>">
    	</div><!--form-group-->
    	
    	<div class="form-group">
    		<label>Cargo:</label>
    		<input type="text" name="cargo" value="<?php echo $colaborador['cargo']; ?>">
    	</div><!--form-group-->
    	
    	<div class="form-group">
    		<label>Instagram:</label>
    		<input type="text" name="instagram" value="<?php echo $colaborador['instagram']; ?>">
    	</div><!--form-group-->
    	
    	<div class="form-group">
    		<label>Facebook:</label>
    		<input type="text" name="facebook" value="<?php echo $colaborador['facebook']; ?>">
    	</div><!--form-group-->
		
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem" />
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_colaborador">
		</div>

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $colaborador['id']; ?>">
		</div>

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->