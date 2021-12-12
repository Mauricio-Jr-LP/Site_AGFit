<?php

	include('../../includeConstants.php');
	/**/
	$data['sucesso'] = true;
	$data['mensagem'] = "";

	if(Painel::logado() == false){
		die("Você não está logado!");
	}
	
	/*Nosso código começa aqui!*/
	if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_cliente'){
		sleep(2);
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$tipo = $_POST['tipo_cliente'];
		$cpf = '';
		$cnpj = '';
		if($tipo == 'fisico'){
			$cpf = $_POST['cpf'];
		}else if($tipo == 'juridico'){
			$cnpj = $_POST['cnpj'];
		}
		$imagem = "";
		if($nome == "" || $email == "" || $tipo == ""){
			$data['sucesso'] = false;
			$data['mensagem'] = "Atenção: Campos vázios não são permitidos!";
		}
		if(isset($_FILES['imagem'])){
			if(Painel::imagemValida($_FILES['imagem'])){
				$imagem = $_FILES['imagem'];
			}else{
				$imagem = "";
				$data['sucesso'] = false;
				$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
			}
		}

		if($data['sucesso']){
			if(is_array($imagem))
				$imagem = Painel::uploadFile($imagem);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.clientes` VALUES (null,?,?,?,?,?)");
			$dadoFinal = ($cpf == '') ? $cnpj : $cpf;
			$sql->execute(array($nome,$email,$tipo,$dadoFinal,$imagem));
			//tudo okay, só cadastrar
			$data['mensagem'] = "O cliente foi cadastrado com sucesso!";
		}

	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'ordenar_empreendimentos'){
		$ids = $_POST['item'];
		$i = 1;
		foreach ($ids as $key => $value) {
			MySql::conectar()->exec("UPDATE `tb_admin.empreendimentos` SET order_id = $i WHERE id = $value");
			$i++;
		}
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_produto'){
		sleep(2);
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$valor = $_POST['valor'];
		$categoria_id = $_POST['categoria_id'];
		$imagem = "";
		if($id == "" || $nome == "" || $valor == ""){
			$data['sucesso'] = false;
			$data['mensagem'] = "Atenção: Campos vázios não são permitidos!";
		}
		if(isset($_FILES['imagem'])){
			if(Painel::imagemValida($_FILES['imagem'])){
				$imagem = $_FILES['imagem'];
			}else{
				$imagem = "";
				$data['sucesso'] = false;
				$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
			}
		}

		if($data['sucesso']){
			if(is_array($imagem))
				$imagem = Painel::uploadFile($imagem);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.produtos` VALUES (?,?,?,?,?,0)");
			$sql->execute(array($id,$nome,$valor,$imagem,$categoria_id));
			//tudo okay, só cadastrar
			//$data['mensagem'] = "O cliente foi cadastrado com sucesso!";
			echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-produtos/';alert('Produto cadastrado com sucesso!');</script>";
		}

			
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_produto'){
		sleep(2);
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$valor = $_POST['valor'];
		$categoria_id = $_POST['categoria_id'];
		$imagem = "";

		if($nome == '' || $valor == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = "Campos vázios não são permitidos!";
		}

		if(isset($_FILES['imagem'])){
				if(Painel::imagemValida($_FILES['imagem'])){
					@unlink('../uploads/'.$imagem);
					$imagem = $_FILES['imagem'];
				}else{
					//$data['sucesso'] = false;
					//$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
					echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-produto'; ?>;alert(' Selecione uma imagem para atualizar!');</script>";
				}
		}

		if($data['sucesso']){
			if(is_array($imagem)){
				$imagem = Painel::uploadFile($imagem);
			}

			$sql = MySql::conectar()->prepare("UPDATE `tb_site.produtos` SET id=?,nome=?,valor=?,categoria_id=?,imagem=? WHERE id = $id");
			$sql->execute(array($id,$nome,$valor,$categoria_id,$imagem));

			//$data['mensagem'] = "O produto foi atualizado com sucesso!";
			echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-produtos';alert('Valores atualizados com sucesso');</script>";
		}

	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_specials'){
		sleep(2);
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$desc1 = $_POST['desc1'];
		$desc2 = $_POST['desc2'];
		$imagem = "";

		if($nome == '' || $desc1 == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = "Campos vázios não são permitidos!";
		}

		if(isset($_FILES['imagem'])){
				if(Painel::imagemValida($_FILES['imagem'])){
					@unlink('../uploads/'.$imagem);
					$imagem = $_FILES['imagem'];
				}else{
					//$data['sucesso'] = false;
					//$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
					echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-specials'; ?>;alert(' Selecione uma imagem para atualizar!');</script>";
				}
		}

		if($data['sucesso']){
			if(is_array($imagem)){
				$imagem = Painel::uploadFile($imagem);
			}

			$sql = MySql::conectar()->prepare("UPDATE `tb_site.config.specials` SET id=?,nome=?,desc1=?,desc2=?,imagem=? WHERE id = $id");
			$sql->execute(array($id,$nome,$desc1,$desc2,$imagem));

			//$data['mensagem'] = "O produto foi atualizado com sucesso!";
			echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-specials';alert('Produto atualizado com sucesso');</script>";
		}

			
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_foto'){
		sleep(2);
		$imagem = "";
		if(isset($_FILES['imagem'])){
			if(Painel::imagemValida($_FILES['imagem'])){
				$imagem = $_FILES['imagem'];
			}else{
				$imagem = "";
				$data['sucesso'] = false;
				$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
			}
		}

		if($data['sucesso']){
			if(is_array($imagem))
				$imagem = Painel::uploadFile($imagem);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.galeria` VALUES (null,?,null)");
			$sql->execute(array($imagem));
			//tudo okay, só cadastrar
			//$data['mensagem'] = "O cliente foi cadastrado com sucesso!";
			echo "<script>window.location='INCLUDE_PATH_PAINEL/gerenciar-galeria';alert('Foto cadastrada com sucesso!');</script>";
		}
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_colaborador'){
		sleep(2);
		$nome = $_POST['nome'];
		$cargo = $_POST['cargo'];
		$facebook = $_POST['facebook'];
		$instagram = $_POST['instagram'];
		$imagem = "";
		if($nome == "" || $cargo == ""){
			$data['sucesso'] = false;
			$data['mensagem'] = "Atenção: Campos vázios não são permitidos!";
		}
		if(isset($_FILES['imagem'])){
			if(Painel::imagemValida($_FILES['imagem'])){
				$imagem = $_FILES['imagem'];
			}else{
				$imagem = "";
				$data['sucesso'] = false;
				$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
			}
		}

		if($data['sucesso']){
			if(is_array($imagem))
				$imagem = Painel::uploadFile($imagem);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.colaboradores` VALUES (null,?,?,?,?,?,0)");
			$sql->execute(array($nome,$cargo,$imagem,$facebook,$instagram));
			//tudo okay, só cadastrar
			echo "<script>window.location='INCLUDE_PATH_PAINEL/gerenciar-colaboradores';alert('Colaborador cadastrado com sucesso!');</script>";
		}

			
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_feedback'){
		sleep(2);
		$nome = $_POST['nome'];
		$cargo = $_POST['cargo'];
		$feedback = $_POST['feedback'];
		$imagem = "";
		$estrelas = $_POST['estrelas'];
		if($nome == "" || $feedback == ""){
			$data['sucesso'] = false;
			$data['mensagem'] = "Atenção: Campos vázios não são permitidos!";
		}
		if(isset($_FILES['imagem'])){
			if(Painel::imagemValida($_FILES['imagem'])){
				$imagem = $_FILES['imagem'];
			}else{
				$imagem = "";
				$data['sucesso'] = false;
				$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
			}
		}

		if($data['sucesso']){
			if(is_array($imagem))
				$imagem = Painel::uploadFile($imagem);
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.feedbacks` VALUES (null,?,?,?,?,?,0)");
			$sql->execute(array($nome,$cargo,$feedback,$imagem,$estrelas));
			//tudo okay, só cadastrar
			echo "<script>window.location='https://meusitess.com/agfit/painel/cadastrar-feedback';alert('Feedback cadastrado com sucesso!');</script>";
		}

	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_colaborador'){
		sleep(2);
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$cargo = $_POST['cargo'];
		$facebook = $_POST['facebook'];
		$instagram = $_POST['instagram'];
		$categoria_id = $_POST['categoria_id'];
		$imagem = "";

		if($nome == '' || $cargo == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = "Campos vázios não são permitidos!";
		}

		if(isset($_FILES['imagem'])){
				if(Painel::imagemValida($_FILES['imagem'])){
					@unlink('../uploads/'.$imagem);
					$imagem = $_FILES['imagem'];
				}else{
					//$data['sucesso'] = false;
					//$data['mensagem'] = "Você está tentando realizar um upload com imagem inválida.";
					echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-colaboradores'; ?>;alert(' Selecione uma imagem para atualizar!');</script>";
				}
		}

		if($data['sucesso']){
			if(is_array($imagem)){
				$imagem = Painel::uploadFile($imagem);
			}

			$sql = MySql::conectar()->prepare("UPDATE `tb_site.colaboradores` SET id=?,nome=?,cargo=?,facebook=?,instagram=?,imagem=? WHERE id = $id");
			$sql->execute(array($id,$nome,$cargo,$facebook,$instagram,$imagem));

			//$data['mensagem'] = "O produto foi atualizado com sucesso!";
			echo "<script>window.location='https://meusitess.com/agfit/painel/gerenciar-colaboradores';alert('Colaborador atualizados com sucesso');</script>";
		}

	}
	die(json_encode($data));



?>