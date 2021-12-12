<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.colaboradores',$idExcluir);
		echo "<script>alert('colaboradores excluido com sucesso');</script>";

	}
?>
<div class="box-content">

<h2><i class="fa fa-pencil"></i> Cadastrar Colaborador</h2>


<form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label>Nome:</label>
		<input type="text" name="nome">
	</div><!--form-group-->
	
	<div class="form-group">
		<label>Cargo:</label>
		<input type="text" name="cargo">
	</div><!--form-group-->
	
	<div class="form-group">
		<label>Instagram:</label>
		<input type="text" name="instagram">
	</div><!--form-group-->
	
	<div class="form-group">
		<label>Facebook:</label>
		<input type="text" name="facebook">
	</div><!--form-group-->

	<div class="form-group">
		<label>Selecione a foto:</label>
		<input multiple type="file" name="imagem">
	</div><!--form-group-->
	
	<div class="form-group">
		<input type="hidden" name="tipo_acao" value="cadastrar_colaborador">
	</div>
	<input type="submit" name="acao" value="Cadastrar Colaborador!">

</form>

</div><!--box-content-->
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Colaboradores Cadastrados</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder="Procure pelo nome" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->
	<div class="boxes">
	<?php
		$query = "";
		if(isset($_POST['acao'])){
			$busca = $_POST['busca'];
			$query = " WHERE nome LIKE '%$busca%'";
		}
		$colaboradores = MySql::conectar()->prepare("SELECT * FROM `tb_site.colaboradores` $query");
		$colaboradores->execute();
		$colaboradores = $colaboradores->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($colaboradores).'</b> resultado(s)</p></div>';
		}
		foreach($colaboradores as $key => $value){
			
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
					<p><b><i class="fa fa-pencil"></i> Nome:</b> <?php echo $value['nome']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Cargo:</b> <?php echo $value['cargo']; ?></p>
					<?php
						if($value['facebook'] != ''){
					?>
				        <p><b><i class="fa fa-pencil"></i> Facebook:</b> <?php echo $value['facebook']; ?></p>
					<?php
						}
						if($value['instagram'] != ''){
					?>
				        <p><b><i class="fa fa-pencil"></i> Instagram:</b> <?php echo $value['instagram']; ?></p>                       
					<?php }?>
					<div class="group-btn">
						<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-colaboradores?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-colaborador?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->

