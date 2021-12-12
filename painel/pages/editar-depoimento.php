<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$depoimento = Painel::select('tb_site.feedbacks','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				
				$nome = $_POST['nome'];
				$cargo = $_POST['cargo'];
				$feedback = $_POST['feedback'];
				$estrelas = $_POST['estrelas'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				
				if($imagem['name'] != ''){

					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$arr = ['nome'=>$nome,'cargo'=>$cargo,'feedback'=>$feedback,'estrelas'=>$estrelas,'imagem'=>$imagem,
						'id'=>$id,'nome_tabela'=>'tb_site.feedbacks'];
						Painel::update($arr);
						$feedbacks = Painel::select('tb_site.slides','id = ?',array($id));
						Painel::alert('sucesso','O Slide foi editado junto com a imagem!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['nome'=>$nome,'cargo'=>$cargo,'feedback'=>$feedback,'estrelas'=>$estrelas,'imagem'=>$imagem,
						'id'=>$id,'nome_tabela'=>'tb_site.feedbacks'];
					Painel::update($arr);
					$feedbacks = Painel::select('tb_site.feedbacks','id = ?',array($id));
					Painel::alert('sucesso','O feedback foi editado com sucesso!');
				}

			}
		?>

		<div class="form-group">
			<label>Nome do cliente:</label>
			<input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Referência:</label>
			<input type="text" name="cargo" value="<?php echo $depoimento['cargo']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Feedback:</label>
			<input type="text" name="feedback" value="<?php echo $depoimento['feedback']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->
		
		<div class="form-group">
			<label>Número de estrelas:</label>
			<input type="number" name="estrelas" value="<?php echo $depoimento['estrelas']; ?>">
		</div><!--form-group-->
		
		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_feedback">
		</div>
		
		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->
	</form>



</div><!--box-content-->