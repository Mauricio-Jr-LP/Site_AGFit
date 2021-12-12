<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();

	$aboutDados = MySql::conectar()->prepare("SELECT * FROM `tb_site.config.about`");
	$aboutDados->execute();
	$aboutDados = $aboutDados->fetch();

?>

<!DOCTYPE html>
<html>

	<head>
		<title><?php echo $infoSite['titulo']; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Mauricio Ezequieç dos Santos Júnior" />
		<meta name="keywords" content="lojas n de produtos naturais, produtos naturais, ag fit, agfit, naturais, produtos naturais feira de santana">
		<meta name="description" content="Este é um site desenvolvido para apresntação da loja AG FIT.">
		
		<link rel="icon" href="<?php echo INCLUDE_PATH; ?>fav.ico" type="image/x-icon" />
		
		<meta charset="utf-8" />

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
		


		<!-- Template Main CSS File -->
		<link href="assets/css/style.css?v=1.1" rel="stylesheet">
		<link href="<?php echo INCLUDE_PATH; ?>estilo/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/font-awesome.min.css">

	</head>

	<body>
		<base base="<?php echo INCLUDE_PATH; ?>" />

			<?php
				$url = isset($_GET['url']) ? $_GET['url'] : 'home';
				switch ($url) {
					case 'depoimentos':
						echo '<target target="depoimentos" />';
						break;

					case 'servicos':
						echo '<target target="servicos" />';
						break;
				}
			?>

			<!--<div class="sucesso"><i class="fa fa-check"></i> 
				Formulário enviado com sucesso!
			</div>-->

			<div class="overlay-loading">
				<img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
			</div><!--overlay-loading

			<!-- ======= Top Bar ======= -->
			<section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
				<div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
				<i class="bi bi-phone d-flex align-items-center"><span>(75) 98243-5478</span></i>
				<i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Segunda-Sabádo: 08:00 - 18:00</span></i>
				</div>
			</section>

			<!-- ======= Header ======= -->
			<header id="header" class="fixed-top d-flex align-items-center header-transparent">
				<div class="container-fluid container-xl d-flex align-items-center justify-content-between">

				<div class="logo me-auto">
					<!-- <h1><a href="index.html">Delicious</a></h1> -->
					<!-- Uncomment below if you prefer to use an image logo-->
					<a href="index.html"><img src="assets/img/logo/LogoNome.png" alt="" class="img-fluid"></a>
				</div>

				<nav id="navbar" class="navbar order-last order-lg-0">
					<ul>
					<li><a class="nav-link scrollto active" href="#hero">Início</a></li>
					<li><a class="nav-link scrollto" href="#menu">Catálago</a></li>
					<li><a class="nav-link scrollto" href="#specials">Especiais</a></li>
					<li><a class="nav-link scrollto" href="#about">Sobre</a></li>
					<!--<li><a class="nav-link scrollto" href="#events">Events</a></li>-->
					<li><a class="nav-link scrollto" href="#gallery">Galeria</a></li>
					<li><a class="nav-link scrollto" href="#chefs">Equipe</a></li>
					<li><a class="nav-link scrollto" href="#contact">Contatos</a></li>
					<li><a class="nav-link scrollto" href="/agfit/produtos">Catálago Completo</a></li>
					</ul>
					<i class="bi bi-list mobile-nav-toggle"></i>
				</nav><!-- .navbar -->

				<a href="https://api.whatsapp.com/send?phone=5575982435478&text=Ol%C3%A1%2C%20tenho%20interesse%20em%20produtos%20naturais%20%3A)%20" target="about_blank" class="book-a-table-btn scrollto">Entrar em contato</a>

				</div>
			</header><!-- End Header -->

			<div class="container-principal">
				<?php

					if(file_exists('pages/'.$url.'.php')){
						include('pages/'.$url.'.php');
					}else{
						//Podemos fazer o que quiser, pois a página não existe.
						if($url != 'depoimentos' && $url != 'servicos'){
							$urlPar = explode('/',$url)[0];
							if($urlPar != 'produtos'){
							$pagina404 = true;
							include('pages/404.php');
							}else{
								include('pages/produtos.php');
							}
						}else{
							include('pages/home.php');
						}
					}

				?>

			</div><!--container-principal-->

			<!-- ======= Footer ======= -->
			<footer id="footer">
				<div class="container">
				<a href="index.html"><img src="assets/img/logo/LogoNome.png" alt="" class="img-fluid" style="max-width: 300px;" ></a>
				<h3></h3>
				<p>Grandes mudanças começam com pequenas escolhas.</p>
				<div class="social-links">
					<!--<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>-->
					<!--<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>-->
					<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
					<!--<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>-->
					<!--<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>-->
				</div>
				<div class="copyright">
					<!--&copy;--> Desenvolvido por <strong><span><a href="https://meusitess.com">MeuSitess</a></span></strong>. <!--All Rights Reserved-->
				</div>
				
				</div>
			</footer><!-- End Footer -->

			<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
			<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
			<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
			<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>

			<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

			<?php
				if(is_array($url) && strstr($url[0],'produtos') !== false){
			?>
				<script>
					$(function(){
						$('select').change(function(){
							location.href=include_path+"produtos/"+$(this).val();
						})
					})
				</script>
			<?php
				}
			?>

			<?php
				if($url == 'contato'){
			?>
			<?php 
				} 
			?>
			<!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>-->
			<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
			
			<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

			<!-- Vendor JS Files -->
			<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
			<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
			<script src="assets/vendor/php-email-form/validate.js"></script>
			<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

			<!-- Template Main JS File -->
			<script src="assets/js/main.js"></script>
	</body>
</html>