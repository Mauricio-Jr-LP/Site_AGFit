<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

			<?php
				$specials = Painel::selectAll('tb_site.carrosel');
				foreach ($specials as $key => $value) {
			?>
					<?php
						if($value['id'] == 1){
					?>

							<div class="carousel-item active" style="background: url(<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>) no-repeat center;">
								<div class="carousel-container">
									<div class="carousel-content">
										<h2 class="animate__animated animate__fadeInDown"><span><?php echo $value['palavra_destaque1']; ?></span> <?php echo $value['texto']; ?> <span><?php echo $value['palavra_destaque2']; ?></span>  <?php echo $value['texto2']; ?></h2>
										<div>
											<a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Catálago</a>
											<a href="#about" class="btn-book animate__animated animate__fadeInUp scrollto">Saiba mais!</a>
										</div>
									</div><!-- carousel-contenet -->
								</div><!-- carousel-container -->
							</div><!-- carousel-item -->

					<?php
						} else {
					?>
							<div class="carousel-item" style="background: url(<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>) no-repeat center;">
								<div class="carousel-container">
									<div class="carousel-content">
										<h2 class="animate__animated animate__fadeInDown"><span><?php echo $value['palavra_destaque1']; ?></span> <?php echo $value['texto']; ?> <span><?php echo $value['palavra_destaque2']; ?></span>  <?php echo $value['texto2']; ?></h2>
										<div>
											<a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Catálago</a>
											<a href="#about" class="btn-book animate__animated animate__fadeInUp scrollto">Saiba mais!</a>
											</div>
									</div><!-- carousel-contenet -->
								</div><!-- carousel-container -->
							</div><!-- carousel-item -->
					<?php
						} //else
					?>
			<?php
				} //foreach
			?>
		
        </div><!-- carousel-iner -->

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>
        
      </div><!-- heroCarousel -->
    </div><!-- hero-container -->
</section><!-- End Hero -->


<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
    <div class="container">

		<!---->
		<div class="section-title">
			<h2>Veja nosso catálago <span>completo</span></h2>
		</div>
		<div class="row">
			<div class="col-lg-12 d-flex justify-content-center">
				<ul id="menu-flters">
					<a class="categoria"  href="<?php echo INCLUDE_PATH ?>produtos" >Clique aqui e confira!</a>	
				</ul>
			</div>
		</div>
		

	

		<div class="section-title">
          <h2>Veja alguns dos nossos <span>produtos</span></h2>
		  <p>(Clique e filtre sua busca)</p>
        </div><!-- section-title -->

		<div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="">Todos</li>

			  	<?php
					//$categorias = Painel::selectAll('tb_site.categorias');

					$mostrar = 1;
					$query = " WHERE home LIKE '%$mostrar%' ";
					$categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` $query");
					$categorias->execute();
					$categorias = $categorias->fetchAll();


					foreach ($categorias as $key => $categoria_value) {
				?>
					<li data-filter=".filter-<?php echo $categoria_value['id']; ?>"> <?php echo $categoria_value['nome']; ?> </li>
				<?php 

					} //foreach
				?>
            </ul>
          </div><!-- col-lg-12 d-flex justify-content-center -->
        </div><!-- row -->

    	<div class="row menu-container">
			<?php
				$produtos = Painel::selectAll('tb_site.produtos');
				$mostrar = 1;
					$query = " WHERE home LIKE '%$mostrar%' ";
					$categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` $query");
					$categorias->execute();
					$categorias = $categorias->fetchAll();

				foreach ($categorias as $key => $categoria_value) {
					foreach ($produtos as $key => $value ) {
						if($categoria_value['id'] == $value['categoria_id']){
							$resul = $value['valor'];;
							$result = number_format($resul,2, ',', '.');

			?>
					<div class="col-lg-6 menu-item filter-<?php echo $value['categoria_id']; ?>"> 
						<div class="menu-foto">
							<a href="https://app.fsdelivery.com.br/cardapio_pedido.html" target="about_blank" class="icone-menu">
								<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" alt="" class="img-fluid">
							</a>
						</div><!-- menu-foto -->
						<div class="menu-content">
							<a><?php echo $value['nome']; ?></a>
							<span> R$<?php echo $result; ?></span>
						</div><!-- menu-content -->
					</div><!-- menu-item -->
			<?php 
				}}} //foreach
			?>
          

        </div><!-- menu-container -->

    </div><!-- container -->
</section><!-- End Menu Section -->

<!-- ======= Specials Section ======= -->
<section id="specials" class="specials">
    <div class="container">

        <div class="section-title">
          <h2><span>Conheça</span> ainda <span>mais</span> os produtos</h2>
          <p>Selecione um produto e veja todas informações que precisa saber sobre ele.</p>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
				<?php
					$specials = Painel::selectAll('tb_site.config.specials');
					foreach ($specials as $key => $value) {
				?>
						<?php
							if($value['id'] == 1){
						?>
							<li class="nav-item">
								<a class="nav-link active show" data-bs-toggle="tab" href="#tab-<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a>
							</li>
						<?php
							}
							else{
						?>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#tab-<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a>
							</li>
				<?php	
						}
					}
				?>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">

				<?php
					$specials = Painel::selectAll('tb_site.config.specials');
					foreach ($specials as $key => $value) {
				?>
						<?php
							if($value['id'] == 1){
						?>
								<div class="tab-pane active show" id="tab-<?php echo $value['id']; ?>">
									<div class="row">
										<div class="col-lg-8 details order-2 order-lg-1">
											<h3><?php echo $value['nome']; ?></h3>
											<p class="fst-italic"><?php echo $value['desc1']; ?></p>
											<p><?php echo $value['desc2']; ?></p>
										</div>
										<div class="col-lg-4 text-center order-1 order-lg-2">
											<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" alt="" class="img-fluid">
										</div>
									</div>
								</div>
						<?php
							}
							else{
						?>
							<div class="tab-pane" id="tab-<?php echo $value['id']; ?>">
								<div class="row">
									<div class="col-lg-8 details order-2 order-lg-1">
										<h3><?php echo $value['nome']; ?></h3>
										<p class="fst-italic"><?php echo $value['desc1']; ?></p>
										<p><?php echo $value['desc2']; ?></p>
									</div>
									<div class="col-lg-4 text-center order-1 order-lg-2">
										<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" alt="" class="img-fluid">
									</div>
								</div>
							</div>
				<?php	
						}
					}
				?>		
            </div>
          </div>
        </div>

    </div><!-- container -->
</section><!-- End Specials Section -->

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container-fluid">

		<?php
			$infos = Painel::selectAll('tb_site.config.about');
			foreach ($infos as $key => $value) {
		?>

				<div class="row">

					<div class="col-lg-5 align-items-stretch video-box" style='background-image: url("assets/img/about/about.png");'>
						<a href="<?php echo $value['linkVideo']; ?>" target="about_blank" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
					</div>

					<div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch">

						<div class="content">
							<h3><strong>AG Fit</strong> produtos naturais</h3>
							<ul>
								<li><i class="bx bx-check-double"></i> <?php echo $value['sobre_motivo_1']; ?></li>
								<li><i class="bx bx-check-double"></i> <?php echo $value['sobre_motivo_2']; ?></li>
								<li><i class="bx bx-check-double"></i> <?php echo $value['sobre_motivo_3']; ?></li>
							</ul>
						</div><!-- content -->

					</div><!-- col-lg-7 d-flex flex-column justify-content-center align-items-stretch -->

				</div><!-- row -->
		<?php 
			} //foreach
		?>

    </div><!-- container-fluid -->
</section><!-- End About Section -->

<!-- ======= Whu Us Section ======= -->
<section id="why-us" class="why-us">
    <div class="container">

        <div class="section-title">
          <h2>Por que escolher <span>nossa loja</span>?</h2>
          <p>Conheça:</p>
        </div><!-- section-title -->

        <div class="row">

        	<div class="col-lg-4">
				<div class="box">
					<h4><span>Missão</span></h4>
					<p>Comercializar produtos naturais para proporcionar às pessoas uma vida mais saudável.</p>
				</div><!-- box -->
        	</div><!-- col-lg-4 -->

			<div class="col-lg-4 mt-4 mt-lg-0">
				<div class="box">
					<h4><span>Visão</span></h4>
					<p>Estar entre os melhores comércios varejistas de produtos naturais.</p>
				</div><!-- box -->
			</div><!-- col-lg-4 mt-4 mt-lg-0 -->

			<div class="col-lg-4 mt-4 mt-lg-0">
				<div class="box">
					<h4><span>Valores</span></h4>
					<ul>
						<li><i class="bx bx-check"></i> Ter integridade, fraternidade e lealdade com as pessoas e o meio ambiente</li>
						<li><i class="bx bx-check"></i> Atender as necessidades e as expectativas dos nossos consumidores</li>
						<li><i class="bx bx-check"></i> Ética, transparência e honestidade</li>
						<li><i class="bx bx-check"></i> Cooperação e colaboração</li>
						<li><i class="bx bx-check"></i> Incentivar o uso adequado dos recursos naturais</li>
					</ul>
				</div><!-- box -->
			</div><!-- col-lg-4 mt-4 mt-lg-0 -->

        </div><!-- row -->

    </div>
</section><!-- End Whu Us Section -->

<!-- ======= Gallery Section ======= -->
<section id="gallery" class="gallery">
    <div class="container-fluid">

		<div class="section-title">
			<h2>Veja algumas <span>fotos</span> da loja</h2>
			<p>Sinta-se dentro da loja vendo algumas fotos dela.</p>
		</div>


        <div class="row no-gutters">

			<?php
				$foto = Painel::selectAll('tb_site.galeria');
				foreach ($foto as $key => $value) {
			?>

					<div class="col-lg-3 col-md-4">
						<div class="gallery-item">
							<a href="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" class="gallery-lightbox">
							<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" alt="" class="img-fluid">
							</a>
						</div>
					</div>

			<?php
				}
			?>
        </div>

    </div>
</section><!-- End Gallery Section -->

<!-- ======= Chefs Section ======= -->
<section id="chefs" class="chefs">
    <div class="container">

        <div class="section-title">
          <h2>Conheça nossa<span> equipe</span></h2>
          <p>Conheça quem está por trás da AG Fit.</p>
        </div>

        <div style="justify-content: center;" class="row">

			<?php
				$team = Painel::selectAll('tb_site.colaboradores');
				foreach ($team as $key => $value) {
			?>

				<div class="col-lg-4 col-md-6">
					<div class="member">
					<div class="pic"><img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" class="img-fluid" alt=""></div>
					<div class="member-info">
						<h4><?php echo $value['nome']; ?></h4>
						<span><?php echo $value['cargo']; ?></span>
						<div class="social">
							<?php
								if($value['facebook'] != ""){
							?>
									<a href="<?php echo $value['facebook']; ?>"><i class="bi bi-facebook"></i></a>
							<?php
								}
							?>

							<?php
								if($value['instagram'] != ""){
							?>
									<a href="<?php echo $value['instagram']; ?>"><i class="bi bi-instagram"></i></a>
							<?php
								}
							?>
						</div>
					</div>
					</div>
				</div>

			<?php
				}
			?>

        </div>

    </div>
</section><!-- End Chefs Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
    <div class="container position-relative">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        	<div class="swiper-wrapper">

				<?php
					$feed = Painel::selectAll('tb_site.feedbacks');
					foreach ($feed as $key => $value) {
				?>
		
						<div class="swiper-slide">
							<div class="testimonial-item">
								<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'];  ?>" class="testimonial-img" alt="">
								<h3><?php echo $value['nome']; ?></h3>
								<h4><?php echo $value['cargo']; ?></h4>
								<div class="stars">
									<?php
										for($i = 1; $i <= $value['estrelas']; $i++){
									?>
											<i class="bi bi-star-fill"></i>
									<?php
										}
									?>
								</div>
								<p>
								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
								<?php echo $value['feedback']; ?>
								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
								</p>
							</div>
						</div><!-- End testimonial item -->
				<?php
					}
				?>

          	</div>

        	<div class="swiper-pagination"></div>

    	</div>

	</div>
</section><!-- End Testimonials Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Nossos <span>contatos</span></h2>
          <p>Veja onde se localiza a loja e outras informações para contato.</p>
        </div>
      </div>

      <div class="map">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.9308951234802!2d-38.961066484646544!3d-12.252955749107805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x714378b2fb808cb%3A0xad6744023e60f6bf!2sAG%20Fit%20-%20Produtos%20Naturais!5e0!3m2!1spt-BR!2sbr!4v1636591328952!5m2!1spt-BR!2sbr" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container mt-5">

        <div class="info-wrap">
          <div class="row">
            <div class="col-lg-3 col-md-6 info">
              <i class="bi bi-geo-alt"></i>
              <h4>Localização:</h4>
              <p>Rua Comandante Almiro, <br>6 - Loja 4 - Kalilandia, Feira de Santana - BA, 44001-312</p>
            </div>

            <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
              <i class="bi bi-clock"></i>
              <h4>Aberto de:</h4>
              <p>Segunda-Sábado:<br>08:00 - 18:00</p>
            </div>

            <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>agfit.naturais@gmail.com</p>
            </div>

            <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
              <i class="bi bi-phone"></i>
              <h4>Telefone e WhatsApp:</h4>
              <p>(75) 98243-5478</p>
            </div>
          </div>
        </div>

        <div class="text-center">
          <a href="https://api.whatsapp.com/send?phone=5575982435478&text=Ol%C3%A1%2C%20tenho%20interesse%20em%20produtos%20naturais%20%3A)%20" target="about_blank" class="book-a-table-btn scrollto">Entrar em contato</a>
        </div>

        <!--
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          
        </form>
        -->
      </div>
    </section><!-- End Contact Section -->