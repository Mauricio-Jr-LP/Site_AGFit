<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$carrousel = Painel::select('tb_site.carrosel','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<div class="box-content">

	<h2><i class="fa fa-pencil"></i> Atualizar Slide</h2>


	<form method="post" enctype="multipart/form-data">
		
	<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				$nome = $_POST['nome'];
				$palavra_destaque1 = $_POST['palavra_destaque1'];
				$texto = $_POST['texto'];
				$palavra_destaque2 = $_POST['palavra_destaque2'];
				$texto2 = $_POST['texto2'];
				$order_id = $_POST['order_id'];

				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.carrosel` WHERE nome = ? AND order_id = ? AND id != ?");
				$verifica->execute(array($nome,$_POST['order_id'],$id));
				if($verifica->rowCount() == 0){
				if($imagem['name'] != ''){
					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$arr = ['id'=>$id,'nome'=>$nome,'palavra_destaque1'=>$palavra_destaque1,'texto'=>$texto,
							'palavra_destaque2'=>$palavra_destaque2,'texto2'=>$texto2,
							'imagem'=>$imagem,'order_id'=>$order_id,'nome_tabela'=>'tb_site.carrosel'];
						Painel::update($arr);
						$slide = Painel::select('tb_site.noticias','id = ?',array($id));
						Painel::alert('sucesso','A notícia foi editada com junto com a imagem!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$slug = Painel::generateSlug($nome);
					$arr = ['id'=>$id,'nome'=>$nome,'palavra_destaque1'=>$palavra_destaque1,'texto'=>$texto,
							'palavra_destaque2'=>$palavra_destaque2,'texto2'=>$texto2,
							'imagem'=>$imagem,'order_id'=>$order_id,'nome_tabela'=>'tb_site.carrosel'];
					Painel::update($arr);
					$slide = Painel::select('tb_site.carrosel','id = ?',array($id));
					Painel::alert('sucesso','A notícia foi editada com sucesso!');
				}
				}else{
					Painel::alert('erro','Já existe uma notícia com este nome!');
				}

			}
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo $carrousel['nome']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Palavra em Destaque 1</label>
			<input type="text" name="palavra_destaque1" value="<?php echo $carrousel['palavra_destaque1']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Texto</label>
			<input type="text" name="texto" value="<?php echo $carrousel['texto']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Palavra em Destaque 2</label>
			<input type="text" name="palavra_destaque2" value="<?php echo $carrousel['palavra_destaque2']; ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Texto</label>
			<input type="text" name="texto2" value="<?php echo $carrousel['texto2']; ?>">
		</div><!--form-group-->	

		<div style="display: none" class="form-group">
			<label>Texto></label>
			<input type="number" name="order_id" value="<?php echo $carrousel['order_id']; ?>">
		</div><!--form-group-->	


		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $foto['imagem']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_carrousel">
		</div>

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $value['id']; ?>">
		</div>

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->