<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.galeria',$idExcluir);
		echo "<script>alert('Produto excluido com sucesso');</script>";

	}
?>
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
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Fotos Cadastradas</h2>
	
	<div class="boxes">
		<?php
			$foto = Painel::selectAll('tb_site.galeria');
			foreach($foto as $value){
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
							
							<div class="group-btn">
								<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-galeria?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
								<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar-fotos?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
							</div><!--group-btn-->
						</div><!--body-box-->
					</div><!--box-single-->
				</div><!--box-single-wraper-->

		<?php 
			} 
		?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->