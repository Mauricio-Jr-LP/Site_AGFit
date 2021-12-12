<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.produtos',$idExcluir);
		echo "<script>alert('Produto excluido com sucesso');</script>";

	}
?>
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
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Produtos Cadastrados</h2>
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
		$produtos = MySql::conectar()->prepare("SELECT * FROM `tb_site.produtos` $query");
		$produtos->execute();
		$produtos = $produtos->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
		}
		foreach($produtos as $key => $value){
			$result = number_format($value['valor'],2, ',', '.');
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
					<p><b><i class="fa fa-pencil"></i> Código do produto:</b> <?php echo $value['id']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Valor:</b> <?php echo $value['valor']; ?></p>
					<?php
							$categorias = Painel::selectAll('tb_site.categorias');
							foreach ($categorias as $key => $valueCat) {
								if($valueCat['id'] == $value['categoria_id']){
						?>
						<p><b> <i class="fa fa-pencil"></i> Categoria:</b> <?php echo $valueCat['nome']; ?></p>
					<?php }} ?>
					<div class="group-btn">
						<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-produtos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->

