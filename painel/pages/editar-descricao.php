<?php 
	$site = Painel::select('tb_site.config.about',false);
?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar pontos da empresa</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST,true)){
					Painel::alert('sucesso','O site foi editado com sucesso!');
					$site = Painel::select('tb_site.config.about',false);
				}else{
					Painel::alert('erro','Campos vázios não são permitidos.');
				}
			}
		?>

		<div class="form-group">
			<label>Primeiro ponto:</label>
			<input type="text" name="sobre_motivo_1" value="<?php echo $site['sobre_motivo_1'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Segundo ponto:</label>
			<input type="text" name="sobre_motivo_2" value="<?php echo $site['sobre_motivo_2'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Terceiro ponto:</label>
			<input type="text" name="sobre_motivo_3" value="<?php echo $site['sobre_motivo_3']; ?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Video:</label>
			<input type="text" name="linkVideo" value="<?php echo $site['linkVideo']; ?>"/>
		</div><!--form-group-->

		
		<div class="form-group">
			<input type="hidden" name="nome_tabela" value="tb_site.config.about" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->