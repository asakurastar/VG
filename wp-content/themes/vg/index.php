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
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/fancybox/jquery.fancybox.css" />

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
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/default.js"></script>

		<?php wp_head(); ?>

		<?php if ( isset($messages) && is_array($messages) && count($messages) > 0 ) : $codigo = $messages['id'];?>
		<script>
			$(function() {
				$.fancybox.open('.fancybox-inscricao', { 
					href : '#inscricao',
					afterShow : function() {
						$('#curso').val( '<?php echo $codigo; ?>' );
					}
				});
			});
		</script>
		<?php endif; ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- Topo -->
		<header>
			<div class="limit">
				<h1 class="logo" title="UNISUL 50 ANOS - Você Graduado">UNISUL 50 ANOS - Você Graduado</h1>

				<!-- Menu -->
				<nav>
					<li><a class="nav" href="#ead">O que é EAD</a></li>
					<li><a class="nav" href="#vantagens">Vantagens EAD</a></li>
					<li><a class="nav" href="#cursos">Cursos</a></li>
					<li><a class="nav" href="#pravaler">PRAVALER</a></li>
				</nav>
				<br class="clear" />
				<!-- End: Menu -->

				<!-- 50 anos - Destaque -->
				<?php 
				$page = get_page_by_path('50-anos-cabecalho'); 
				echo $page->post_content;
				?>
				<br class="clear" />
				<a href="#cursos" class="nav btn-secundary">Conheça os cursos</a>
				<a href="#inscricao" class="fancybox-inscricao btn">Inscreva-se</a>
				<br class="clear" />
				<span class="selo">Credenciado</span>
				<!-- End: 50 anos - Destaque -->

			</div>
		</header>
		<!-- End: Topo -->

		<!-- 50 Anos - Embed -->
		<div class="block aunisul">
			<div class="limit">
				<?php 
				$page = get_page_by_path('50-anos-fundo'); 
				echo $page->post_content;
				?>
			</div>
		</div>
		<!-- End: 50 Anos - Embed -->

		<!-- EAD -->
		<div id="ead" class="block oquee">
			<div class="limit">
				<h2><strong>O QUE É</strong><br />EAD UNISUL?</h2>
				<div class="text">
					<?php 
					$page = get_page_by_path('o-que-e-ead-unisul'); 
					echo $page->post_content;
					?>
				</div>
			</div>
		</div>
		<!-- End: EAD -->

		<!-- Vantagens -->
		<div id="vantagens" class="block vantagens">
			<div class="limit">
				<?php 
				$page = get_page_by_path('vantagens-de-estudar-a-distancia-com-a-unisul'); 
				echo $page->post_content;
				?>
			</div>
		</div>
		<!-- End: Vantagens -->

		<!-- Cursos -->
		<div id="cursos" class="block cursos">
			<div class="limit">
				<h2><strong>Cursos</strong> disponíveis</h2>

				<!-- Cursos - Busca -->
				<fieldset class="search">
					<input type="text" title="Encontre o seu curso" id="search" />
					<input type="submit" value="" id="submit" />
				</fieldset>
				<br class="clear" />
				<!-- End: Cursos - Busca -->

				<!-- Cursos - Resultado -->
				<div id="accordion"></div>
				<!-- End: Cursos - Resultado -->

				<!-- Cursos - Detalhes -->
				<div id="detalhecurso" style="width:780px; display:none;">
					<div class="header">
						<h2></h2>
						<a href="javascript:void(0);" class="btn-secundary_small">Estou interessado</a>
						<a href="javascript:void(0);" class="inscricao btn_small">Inscreva-se</a>
						<br class="clear" />
						<ul>
							<li class="modalidade"></li>
							<li class="titulacao"></li>
							<li class="area"></li>
							<li class="duracao"></li>
							<li class="investimento"></li>
						</ul>
					</div>
					<div class="introduction"></div>
					<div id="tabs">
						<ul>
							<li><a href="#tabs-1">Perfil do Profissional</a></li>
							<li><a href="#tabs-2">Objetivos e dados legais</a></li>
							<li><a href="#tabs-3">Coordenação</a></li>
						</ul>
						<br class="clear" />
						<div id="tabs-1"></div>
						<div id="tabs-2"></div>
						<div id="tabs-3"></div>
					</div>
				</div>
				<!-- End: Curso - Detalhes -->

				<!-- Curso - Inscricao -->
				<div id="inscricao" style="width:780px; display:none;">
					<div class="header">
						<h2>Formulário de inscrição</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum nunc felis. Etiam pharetra odio eu ante ultrices, nec egestas tortor luctus.</p>
					</div>

					<?php 
					if ( isset($messages) && is_array($messages) && count($messages) > 0 ) :
						if ( isset($messages['id']) ) { unset($messages['id']); }
					?>
					<!-- Erros -->
					<div class="message error">
						<?php foreach($messages as $message) : ?>
						<p>- <?php echo $message; ?></p>
						<?php endforeach; ?>
					</div>
					<!-- End: Erros -->
					<?php endif; ?>

					<form name="inscricao" method="post">
						<input type="hidden" name="inscricao" value="1" />
						<fieldset>
							<div class="block-form">
								<h3>DADOS PESSOAIS</h3>
								<div class="col-2">
									<label for="nome">Nome completo:</label>
									<input id="nome" name="nome" type="text" />
								</div>
								<div class="col-2">
									<label for="cpf">CPF:</label>
									<input class="cpf" id="cpf" name="cpf" type="text" placeholder="000.000.000-00" />
								</div>
								<br class="clear" />
								<div class="col-4">
									<label for="rg">RG:</label>
									<input id="rg" name="rg" type="text" placeholder="0.000.000" />
								</div>
								<div class="col-4 space">
									<label for="orgao">Órgão emissor:</label>
									<input id="orgao" name="orgao" type="text" />
								</div>
								<div class="col-4">
									<label for="nascimento">Data de nascimento:</label>
									<input class="data" id="nascimento" name="nascimento" type="text" placeholder="DD/MM/AAAA" />
								</div>
								<div class="col-4">
									<label>Sexo:</label>
									<select id="sexo" name="sexo">
										<option value="M" selected="selected">Masculino</option>
										<option value="F">Feminino</option>
									</select>
								</div>
							</div>

							<div class="block-form">
								<h3>DADOS DE CONTATO</h3>
								<div class="col-2">
									<label for="endereco">Endereço:</label>
									<input id="endereco" name="endereco" type="text" />
								</div>
								<div class="col-4">
									<label for="numero">Nº:</label>
									<input id="numero" name="numero" type="text" />
								</div>
								<br class="clear" />
								<div class="col-2">
									<label for="complemento">Complemento:</label>
									<input id="complemento" name="complemento" type="text" />
								</div>
								<div class="col-4">
									<label for="bairro">Bairro:</label>
									<input id="bairro" name="bairro" type="text" />
								</div>
								<div class="col-4">
									<label for="cidade">Cidade:</label>
									<input id="cidade" name="cidade" type="text" />
								</div>
								<br class="clear" />
								<div class="col-4">
									<label for="uf">UF:</label>
									<select id="uf" name="uf">
										<option value="RJ" selected="selected">RJ</option>
										<option value="SP">SP</option>
										<option value="MG">MG</option>
										<option value="ES">ES</option>
									</select>
								</div>
								<div class="col-4 space">
									<label>CEP:</label>
									<input class="cep" id="cep" name="cep" type="text" placeholder="00.000-000" />
								</div>

								<div class="col-4">
									<label for="telefone-fixo">Telefone:</label>
									<input class="telefone" id="telefone-fixo" name="telefone-fixo" type="text" placeholder="(00) 0000-0000" />
								</div>
								<div class="col-4">
									<label for="telefone-celular">Celular:</label>
									<input class="telefone" id="telefone-celular" name="telefone-celular" type="text" placeholder="(00) 0000-0000" />
								</div>
								<br class="clear" />
								<div class="col-2">
									<label>E-mail:</label>
									<input id="email" name="email" type="text" />
								</div>
							</div>

							<div class="block-form">
								<h3>DADOS DO CURSO</h3>

								<div class="col-2">
									<label>Nome do curso:</label>
									<select id="curso" name="curso">
										<?php
										$cursos = get_posts(array(
											'post_type'      => 'cursos',
											'post_status'    => 'publish',
											'posts_per_page' => -1
										));
										foreach($cursos as $curso) :
										?>
										<option value="<?php echo $curso->ID; ?>"><?php echo $curso->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<!-- col-2 -->

								<div class="col-2">
									<label>Polo / Local de provas:</label>
									<select id="polo" name="polo">
										<?php 
										$polos = get_posts(array(
											'post_type'      => 'polos',
											'post_status'    => 'publish',
											'posts_per_page' => -1
										));
										foreach($polos as $polo) :
										?>
										<option value="<?php echo $polo->ID; ?>"><?php echo $polo->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<input type="submit" id="submit" value="FINALIZAR INSCRIÇÃO" />
						</fieldset>
					</form>
				</div>
				<!-- End: Curso - Inscricao -->

			</div>
		</div>
		<!-- End: Cursos -->

		<!-- Polos -->
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
		</div>
		<!-- End: Polos -->

		<!-- Pra Valer -->
		<div id="pravaler" class="block pravaler">
			<div class="limit">
				<h2><strong>Crédito Universitário</strong> Pague metade da mensalidade durante o curso<br />e o restante somente depois de formado.</h2>
				<br class="clear" />

				<!-- Pra Valer - Esquerdo -->
				<div class="col">
					<?php 
					$page = get_page_by_path('pra-valer-conteudo-direito'); 
					echo $page->post_content;
					?>
				</div>
				<!-- End: Pra Valer - Esquerdo -->

				<!-- Pra Valer - Direito -->
				<div class="col">
					<?php 
					$page = get_page_by_path('pra-valer-conteudo-esquerdo'); 
					echo $page->post_content;
					?>
				</div>
				<!-- End: Pra Valer - Direito -->

			</div>
		</div>
		<!-- End: Pra Valer -->

		<!-- Patrocinio -->
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
		</div>
		<!-- End: Patrocinio -->

		<!-- Fundo -->
		<footer>
			<div class="limit">
				<div class="logo">
					Unisul 50 Anos - Você Graduado
				</div>
				<ul>
					<li>
						<p>
							<strong>Central de Relacionamento</strong><br />
							0800 970 7000<br />
							vocegraduado@unisul.br
						</p>
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
			<?php wp_footer(); ?>
		</footer>
		<!-- End: Fundo -->

		<?php if ( isset($_POST['inscricao']) ) : ?>
		<script>
			(function($) {
				$(function() {
					var $inscricao = $('#inscricao');
					<?php foreach($_POST as $key => $value) : ?>
					$( '[name=<?php echo $key; ?>]', $inscricao ).val('<?php echo $value; ?>');
					<?php endforeach; ?>

					setTimeout(function() {
						$('.message').fadeOut('slow', function() {
							$(this).remove();
						});
					}, 3000);
				});
			})(jQuery);
		</script>
		<?php endif; ?>

	</body>
</html>
