<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Itens em Destaque</h2>
	
	<?php
		$produto = MySql::conectar()->prepare("SELECT * FROM `tb_site.config.specials` ");
		$produto->execute();
		$produto = $produto->fetchAll();
		
		foreach($produto as $key => $value){
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
					<p><b><i class="fa fa-pencil"></i> Ordem:</b> <?php echo $value['id']; ?>º</p>
					<p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome']; ?></p>
					
					<div class="group-btn">
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar-specials?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->

