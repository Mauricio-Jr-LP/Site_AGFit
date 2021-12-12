<?php
	verificaPermissaoPagina(2);
?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadatrar Feedback</h2>

	<form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label>Nome do cliente:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Referência:</label>
			<input type="text" name="cargo">
		</div><!--form-group-->

		<div class="form-group">
			<label>Feedback:</label>
			<input type="text" name="feedback">
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->
		
		<div class="form-group">
			<label>Número de estrelas:</label>
			<input type="number" name="estrelas">
		</div><!--form-group-->
		
		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="cadastrar_feedback">
		</div>
		
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->

<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Feedbacks Cadastrados</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder="Procure por: nome do cliente" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->
	<div class="boxes">
	<?php
		$query = "";
		if(isset($_POST['acao'])){
			$busca = $_POST['busca'];
			$query = " WHERE nome LIKE '%$busca%' ";
		}
		$clientes = MySql::conectar()->prepare("SELECT * FROM `tb_site.feedbacks` $query");
		$clientes->execute();
		$clientes = $clientes->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($clientes).'</b> resultado(s)</p></div>';
		}
		foreach($clientes as $value){
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
					<p><b><i class="fa fa-pencil"></i> Nome do cliente:</b> <?php echo $value['nome']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Feedback:</b> <?php echo $value['feedback']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Estrelas:</b> <?php echo ucfirst($value['estrelas']); ?></p>
					
					<div class="group-btn">
						<a class="btn delete" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-depoimento?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->