<?php
	$url = explode('/',$_GET['url']);
	if(!isset($url[2]))
	{
	$categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$categoria->execute(array(@$url[1]));
	$categoria = $categoria->fetch();
?>

<!-- ======= Menu Section ======= -->
	<section  id="menu" class="menu">
		<div style="padding-top: 20%;" class="container">

			<div class="section-title">
			<h2>Veja nossos <span>Produtos</span></h2>
			<p>(Clique no filtro e melhore sua busca)</p>
			</div><!-- section-title -->

			<div class="row">
			<div class="col-lg-12 d-flex justify-content-center">
				<ul id="menu-flters">
				<li data-filter="">Todos</li>

					<?php
						$categorias = Painel::selectAll('tb_site.categorias');
						foreach ($categorias as $key => $categoria_value) {
					?>		
					<li data-filter=".filter-<?php $categoria_value['id']?>"> <?php echo $categoria_value['nome']; ?> </li>
							
					<?php 
						} //foreach
					?>
				</ul>
			</div><!-- col-lg-12 d-flex justify-content-center -->
			</div><!-- row -->

			<div class="row menu-container">
				<?php
					$produtos = Painel::selectAll('tb_site.produtos');
						$categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
						$categorias->execute();
						$categorias = $categorias->fetchAll();

					foreach ($categorias as $key => $categoria_value) {
						foreach ($produtos as $key => $value ) {
							if($categoria_value['id'] == $value['categoria_id']){

				?>
						<div class="col-lg-6 menu-item filter<?php $value['categoria_id']?>"> 
							<div class="menu-foto">
								<a href="https://app.fsdelivery.com.br/cardapio_pedido.html" target="about_blank" class="icone-menu">
									<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" alt="" class="img-fluid">
								</a>
							</div><!-- menu-foto -->
							<div class="menu-content">
								<a><?php echo $value['nome']; ?></a>
								<span> R$<?php echo $value['valor']; ?></span>
							</div><!-- menu-content -->
						</div><!-- menu-item -->
				<?php 
					}}} //foreach
				?>
			

			</div><!-- menu-container -->

		</div><!-- container -->
	</section><!-- End Menu Section -->
			</div><!--conteudo-portal-->


			<div class="clear"></div>
	</div><!--center-->

</section><!--container-portal-->

<?php }else{ 
	include('noticia_single.php');
}
?>

