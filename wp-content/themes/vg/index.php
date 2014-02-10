<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="cleartype" content="on">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />

	<!--[if lte IE 8]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 7]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/IE7.js"></script>
	<![endif]-->

	<!--[if lt IE 7]>
	<p class="chromeframe">Você está usando um browwer <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/">atualize o browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Frame do Google Chrome</a> para melhorar a experiência.</p>
	<![endif]-->

	<!--[if lt IE 8]>
	<p class="chromeframe">Você está usando um browwer <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/">atualize o browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Frame do Google Chrome</a> para melhorar a experiência.</p>
	<![endif]-->

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/default.js"></script>

  <script>
    $(function() {
      $( "#accordion" ).accordion();
    });
  </script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
	<div class="limit">
	  <h1 class="logo" title="UNISUL 50 ANOS - Você Graduado">UNISUL 50 ANOS - Você Graduado</h1>

	  <nav>
		<li><a href="#ead">O que é EAD</a></li>
		<li><a href="#vantagens">Vantagens EAD</a></li>
		<li><a href="#cursos">Cursos</a></li>
		<li><a href="#pravaler">PRAVALER</a></li>
	  </nav>

	  <br class="clear" />
	  <?php 
	  $page = get_page_by_path('50-anos-cabecalho'); 
	  echo $page->post_content;
	  ?>
	  <br class="clear" />

	  <a href="#" class="btn-secundary">Conheça os cursos</a>
	  <a href="#" class="btn">Inscreva-se</a>

	  <br class="clear" />

	  <span class="selo">Credenciado</span>
	</div>
	<!-- limit -->
  </header>

  <div class="block aunisul">
	<div class="limit">
	  <?php 
	  $page = get_page_by_path('50-anos-fundo'); 
	  echo $page->post_content;
	  ?>
	</div>
	<!-- limit -->
  </div>
  <!-- aunisul -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div id="ead" class="block oquee">
	<div class="limit">
	  <h2><strong>O QUE É</strong><br />EAD UNISUL?</h2>

	  <div class="text">

	  <?php 
	  $page = get_page_by_path('o-que-e-ead-unisul'); 
	  echo $page->post_content;
	  ?>
	  </div>
	  <!-- text -->
	</div>
	<!-- limit -->
  </div>
  <!-- oquee -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div id="vantagens" class="block vantagens">
	<div class="limit">
	  <?php 
	  $page = get_page_by_path('vantagens-de-estudar-a-distancia-com-a-unisul'); 
	  echo $page->post_content;
	  ?>
	</div>
	<!-- limit -->
  </div>
  <!-- vantagens -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div id="cursos" class="block cursos">
	<div class="limit">
	  <h2><strong>Cursos</strong> disponíveis</h2>

	  <fieldset class="search">
		<input type="text" title="Encontre o seu curso" id="search" />
		<input type="submit" value="" id="submit" />
	  </fieldset>

	  <br class="clear" />

	  <div id="accordion">
	  </div>

	</div>
	<!-- limit -->
  </div>
  <!-- cursos -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div class="block polos">
	<div class="limit">
	  <h2>Polos de apoio presencial</h2>

	  <p>Nos polos da UnisulVirtual você encontra, além da sala de aula para realização de provas presenciais, laboratório de informática com acesso à Internet, biblioteca; e terá à disposição um tutor capacitado para esclarecer dúvidas acadêmicas e sobre procedimentos administrativos.</p>

	  <h3>Encontre um Polo mais próximo de você:</h3>

	  <ul>
		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>

		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>

		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>

		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>

		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>

		<li>
		  <h4>Aracaju - SE</h4>
		  <p>
			Ibex Brasil / Colégio Lavoisier<br />
			Rua Promotor José Medeiros, 219 - Bairro Farolândia
			Conjunto Augusto Franco<br />
			49030-690<br /><br />

			Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
			Telefone: (79) 3248 1572 ou (79) 3248 1645
		  </p>
		</li>
	  </ul>
	</div>
	<!-- limit -->
  </div>
  <!-- polos -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div id="pravaler" class="block pravaler">
	<div class="limit">
	  <h2><strong>Crédito Universitário</strong> Pague metade da mensalidade durante o curso<br />e o restante somente depois de formado.</h2>

	  <br class="clear" />

	  <div class="col">
	  <?php 
	  $page = get_page_by_path('pra-valer-conteudo-direito'); 
	  echo $page->post_content;
	  ?>
	  </div>
	  <!-- col -->

	  <div class="col">
	  <?php 
	  $page = get_page_by_path('pra-valer-conteudo-esquerdo'); 
	  echo $page->post_content;
	  ?>
	  </div>
	  <!-- col -->
	</div>
	<!-- limit -->
  </div>
  <!-- pravaler -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <div class="block patrocinio">
	<div class="limit">
	  <h2>Conheça nossos <strong>PATROCINADORES:</strong></h2>

	  <ul>
		<li class="jovempan">
		  <a href="#">acessar site</a>
		  <a href="#">acessar twitter</a>
		</li>

		<li class="vocestore">
		  <a href="#">Você Store</a>
		</li>
	  </ul>
	</div>
	<!-- limit -->
  </div>
  <!-- patrocinio -->

  <!-- ||||||||||||||||||||||||||||||||| -->

  <footer>
	<div class="limit">
	  <div class="logo">
		Unisul 50 Anos - Você Graduado
	  </div>
	  <!-- logo -->

	  <ul>
		<li>
		  <p><strong>Central de Relacionamento</strong><br />
		  0800 970 7000<br />
		  vocegraduado@unisul.br</p>
		</li>

		<li>
		  <p><strong>Nossas redes sociais</strong></p>

		  <a href="#" class="facebook" title="Facebook">Facebook</a>
		  <a href="#" class="twitter" title="Twitter">Twitter</a>
		  <a href="#" class="youtube" title="YouTube">YouTube</a>
		</li>

		<li>
		  <a href="#" class="blog" title="Blog Universidade Virtual">Blog UV</a>
		</li>
	  </ul>
	</div>
	<!-- limit -->

	<?php wp_footer(); ?>
  </footer>

</body>
</html>
