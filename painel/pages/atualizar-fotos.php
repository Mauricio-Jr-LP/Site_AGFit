<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$slide = Painel::select('tb_site.galeria','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Atualizar foto Slide</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				
				if($imagem['name'] != ''){

					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$arr = ['imagem'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.galeria'];
						Painel::update($arr);
						$foto = Painel::select('tb_site.galeria','id = ?',array($id));
						Painel::alert('sucesso','Atualzada!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['imagem'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.galeria'];
					Painel::update($arr);
					$slide = Painel::select('tb_site.galeria','id = ?',array($id));
					Painel::alert('sucesso','O Slide foi editado com sucesso!');
				}

			}
		?>

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $foto['imagem']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->