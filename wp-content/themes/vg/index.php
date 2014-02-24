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
		<p class="chromeframe">Você está usando um browser <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/">atualize o browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Frame do Google Chrome</a> para melhorar a experiência.</p>
		<![endif]-->

		<!--[if lt IE 8]>
		<p class="chromeframe">Você está usando um browser <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/">atualize o browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">ative o Frame do Google Chrome</a> para melhorar a experiência.</p>
		<![endif]-->

		<script>var base_url = '<?php echo get_bloginfo("wpurl"); ?>/'; </script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/default.js"></script>

		<?php wp_head(); ?>

		<?php @session_start(); ?>

		<?php
		// Carrega o fancybox de inscrição quando a página atual for Inscrição
		if ( is_page() && 'inscricao' == $pagename ) : 
		?>
		<script>
			$(function() {
				$.fancybox.open('.fancybox-inscricao', { href : '#inscricao' });
			});
		</script>
		<?php endif; ?>

		<?php 
		// Carrega os detalhes do curso quando a página atual for post single e não conter erros de validação
		if ( 
			is_single() && ( 
				( !isset($messagesInscricao) && !isset($messagesInteresse) ) ||
				( 
					( isset($messagesInscricao) && count($messagesInscricao) == 0 ) &&
					( isset($messagesInteresse) && count($messagesInteresse) == 0 ) 
				)
			)
		) : 
		?>
		<script>
			$(function() {
				loadCurso('<?php the_ID(); ?>');
			});
		</script>
		<?php endif; ?>

		<?php if ( isset($messagesInscricao) && count($messagesInscricao) > 0 ) :?>
		<script>
			$(function() {
				var selector   = '#inscricao';
				var $inscricao = $( selector );
				$.fancybox.open('.fancybox-inscricao', { 
					href       : selector,
					afterClose : function() {
						$( 'input, select', $inscricao ).removeClass('error');
						$( '.message', $inscricao ).remove();
					}
				});

				<?php foreach($messagesInscricao as $field) : ?>
				$( '[name=<?php echo str_replace( "_", "\\\\_", $field ); ?>]', $inscricao ).addClass('error');
				<?php endforeach; ?>
			});
		</script>
		<?php endif; ?>

		<?php if ( isset($messagesInteresse) && count($messagesInteresse) > 0 ) : ?>
		<script>
			$(function() {
				var selector   = '#interesse';
				var $interesse = $( selector );
				$.fancybox.open('.fancybox-interesse', { 
					href       : selector,
					afterClose : function() {
						$( 'input, select', $interesse ).removeClass('error');
						$( '.message', $interesse ).remove();
					}
				});

				<?php foreach($messagesInteresse as $field) : ?>
				$( '[name=<?php echo str_replace( "_", "\\\\_", $field ); ?>]', $interesse ).addClass('error');
				<?php endforeach; ?>
			});
		</script>
		<?php endif; ?>

		<?php if ( isset( $_SESSION['saved'] ) && $_SESSION['saved'] ) : unset( $_SESSION['saved'] ); ?>
		<script>
		$(function() {
			$.fancybox.open('.obrigado', { href : '#obrigado' });
		});
		</script>
		<?php endif; ?>

		<?php if ( isset( $saved ) && $saved ) : ?>
		<script>
		$(function() {
			$.fancybox.open('.obrigado', { href : '#obrigado' });
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
					<li><a class="nav" href="#ead">O que é EAD Unisul</a></li>
					<li><a class="nav" href="#vantagens">Diferenciais do nosso EAD</a></li>
					<li><a class="nav" href="#cursos">Cursos</a></li>
					<li><a class="nav" href="#polos">Polos</a></li>
					<li><a class="nav" href="#pravaler">Financie seu curso</a></li>
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
				<!-- End: 50 anos - Destaque -->
			</div>
		</header>
		<!-- End: Topo -->

		<!-- 50 Anos - Embed -->
		<div id="ead" class="block aunisul">
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
				<h3>Maior número de cursos a distância do Brasil</h3>
				<h2><strong>Nossos cursos</strong></h2>

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
						<a href="#interesse" class="interesse btn-secundary_small">Estou interessado</a>
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

				<!-- Curso - Interesse -->
				<div id="interesse" style="width: 780px; display:none">
					<div class="header">
						<h2>Tenho interesse</h2>
						<p>Preencha corretamente os dados do formulário abaixo e aguarde o contato da nossa equipe.</p>
					</div>

					<?php if ( isset($messagesInteresse) && count($messagesInteresse) > 0 ) : ?>
					<div class="message error">
						<p>ERRO - Os campos em destaque devem ser preenchidos ou são inválidos</p>
					</div>
					<?php endif; ?>

					<form name="interesse" method="post">
						<input type="hidden" name="interesse" value="1" />
						<fieldset>
							<div class="block-form">
								<h3>DADOS DE CONTATO</h3>
								<div class="col-2">
									<label for="nome">Nome completo:</label>
									<input id="nome" name="nome" type="text" />
								</div>
								<div class="col-4">
									<label for="telefone_fixo">Telefone:</label>
									<input class="telefone" id="telefone_fixo" name="telefone_fixo" type="text" placeholder="(00) 0000-0000" />
								</div>
								<div class="col-4">
									<label for="telefone_celular">Celular:</label>
									<input class="telefone" id="telefone_celular" name="telefone_celular" type="text" placeholder="(00) 0000-0000" />
								</div>
								<br class="clear">
								<div class="col-2">
									<label for="email">E-mail:</label>
									<input id="email" name="email" type="text" />
								</div>
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
							</div>
							<input type="submit" id="submit" value="ENVIAR" />
						</fieldset>
					</form>
				</div>
				<!-- End: Curso - Interesse -->

				<!-- Curso - Inscricao -->
				<div id="inscricao" style="width:780px; display:none;">
					<div class="header">
						<h2>Formulário de inscrição</h2>
						<p>Preencha corretamente os dados do formulário abaixo e aguarde o contato da nossa equipe.</p>
					</div>

					<?php if ( isset($messagesInscricao) && count($messagesInscricao) > 0 ) : ?>
					<div class="message error">
						<p>ERRO - Os campos em destaque devem ser preenchidos ou são inválidos</p>
					</div>
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
										<option value="AC">Acre</option>
										<option value="AL">Alagoas</option>
										<option value="AP">Amapá</option>
										<option value="AM">Amazonas</option>
										<option value="BA">Bahia</option>
										<option value="CE">Ceará</option>
										<option value="DF">Distrito Federal</option>
										<option value="GO">Goiás</option>
										<option value="ES" selected="selected">Espírito Santo</option>
										<option value="MA">Maranhão</option>
										<option value="MT">Mato Grosso</option>
										<option value="MS">Mato Grosso do Sul</option>
										<option value="MG">Minas Gerais</option>
										<option value="PA">Pará</option>
										<option value="PB">Paraiba</option>
										<option value="PR">Paraná</option>
										<option value="PE">Pernambuco</option>
										<option value="PI">Piauí­</option>
										<option value="RJ">Rio de Janeiro</option>
										<option value="RN">Rio Grande do Norte</option>
										<option value="RS">Rio Grande do Sul</option>
										<option value="RO">Rondônia</option>
										<option value="RR">Roraima</option>
										<option value="SP">São Paulo</option>
										<option value="SC">Santa Catarina</option>
										<option value="SE">Sergipe</option>
										<option value="TO">Tocantins</option>
									</select>
								</div>
								<div class="col-4 space">
									<label>CEP:</label>
									<input class="cep" id="cep" name="cep" type="text" placeholder="00.000-000" />
								</div>

								<div class="col-4">
									<label for="telefone_fixo">Telefone:</label>
									<input class="telefone" id="telefone_fixo" name="telefone_fixo" type="text" placeholder="(00) 0000-0000" />
								</div>
								<div class="col-4">
									<label for="telefone_celular">Celular:</label>
									<input class="telefone" id="telefone_celular" name="telefone_celular" type="text" placeholder="(00) 0000-0000" />
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
		<div id="polos" class="block polos">
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
						<h4>Araguaína - TO</h4>
						<p>
							Rua Cinco, Quadra TX 08, 269 - Bairro Senador<br />
							77804-970<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 12h e das 14 às 18h.<br />
							Telefone: (63) 3415 2954
						</p>
					</li>

					<li>
						<h4>Araranguá - SC</h4>
						<p>
							Unisul<br />
							Rodovia Jorge Lacerda. Km 35,4 - SC 449 - Bloco A<br />
							88900-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 13h e das 14 às 21h.<br />
							Telefone: (48) 3521 3075 ou (48) 3279 1242
						</p>
					</li>

					<li>
						<h4>Araçatuba - SP</h4>
						<p>
							Rua Cristiano Olsen, 2122 - Bairro Higienópolis<br />
							16010-720<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 22h. Aos sábados, das 8 às 18h.<br />
							Telefone: (18) 3305 5300
						</p>
					</li>

					<li>
						<h4>Bagé - RS</h4>
						<p>
							REDETC<br />
							Rua Bento Gonçalves, 254 D - Bairro Centro<br />
							96400-200<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 13h30min às 22h30min. Aos sábados, das 8 às 12h e das 14 às 18h.<br />
							Telefone: (53) 3241 1330
						</p>
					</li>

					<li>
						<h4>Barueri - SP</h4>
						<p>
							Avenida Corifeu de Azevedo Marques, 15 - Bairro Centro<br />
							06320-090<br /><br />

							Horário do Polo: De segunda a sábado, das 8 às 18h.<br />
							Telefone: (11) 4185 8484
						</p>
					</li>

					<li>
						<h4>Belo Horizonte - MG</h4>
						<p>
							Colégio Nossa Senhora das Dores<br />
							Avenida Francisco Sales, 77 - Bairro Floresta<br />
							30150-220<br /><br />

							Horário do Polo: Segunda, Quarta e Quinta das 9 às 21h:45min. Terça das 9 às 18h. Sexta das 9 às 22h:30min.<br />
							Telefone: 0800 234 5678 ou (31) 2536 7400
						</p>
					</li>

					<li>
						<h4>Belém - PA</h4>
						<p>
							Polo em transição.<br />
							Para saber o local de sua avaliação presencial, acesse o EVA (Espaço Virtual de Aprendizagem) com seu login e senha e confirme o endereço.
						</p>
					</li>

					<li>
						<h4>Bento Gonçalves - RS</h4>
						<p>
							Rua Assis Brasil, 35 - sala 10 - Centro<br />
							95700-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 18 às 22h.<br />
							Telefone: (51) 4118 0666
						</p>
					</li>

					<li>
						<h4>Blumenau - SC</h4>
						<p>
							Rede Canal do Saber / Colégio Sagrada Família<br />
							Rua Sete de Setembro, 915 - Bairro Centro<br />
							89010-201<br /><br />

							Horário do Polo: Segunda, quinta e sexta-feira, das 8 às 12h30min e das 13h30min às 17h. Terça e quarta-feira das 8 às 12h30min e das 13h30min às 21h30min.<br />
							Telefone: (47) 3340 3246 | 8868 2311
						</p>
					</li>

					<li>
						<h4>Boa Vista - RR</h4>
						<p>
							Polo em transição.<br />
							Para saber o local de sua avaliação presencial, acesse o EVA (Espaço Virtual de Aprendizagem) com seu login e senha e confirme o endereço.
						</p>
					</li>

					<li>
						<h4>Brasília - DF</h4>
						<p>
							SCRN 702/703, Bloco C, Entrada 46, 1º andar - Bairro Asa Norte<br />
							70720-630<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (61) 3326 1574
						</p>
					</li>

					<li>
						<h4>Braço do Norte - SC</h4>
						<p>
							Unisul<br />
							Estrada Geral São José, 10971 - Bairro Represa<br />
							Rodovia SC 482 - KM 05 - Caixa Postal: 102<br />
							88750-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 13h30min às 18h e das 19 às 22h30min.<br />
							Telefone: (48) 3621 3925
						</p>
					</li>

					<li>
						<h4>Cachoeirinha/RS</h4>
						<p>
							Eadsul Cursos e Consultoria<br />
							Avenida Frederico Augusto Ritter, 51 c. Distrito Industrial <br />
							94930-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 14 às 18h.<br />
							Telefone: (51) 4118 0801
						</p>
					</li>

					<li>
						<h4>Campina Grande - PB</h4>
						<p>
							Colégio e Curso Alternativo<br />
							Rua João da Mata, 497 - Bairro Centro<br />
							58100-630<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 14 às 17h.<br />
							Telefone: (83) 3341 3051
						</p>
					</li>

					<li>
						<h4>Campinas - SP </h4>
						<p>
							Colégio Futura<br />
							Av Guarani, 405 - Bairro Jardim Guarani (portão lateral)<br />
							13100-211<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
							Telefone: (19) 3201 1100
						</p>
					</li>

					<li>
						<h4>Campo Grande - MS</h4>
						<p>
							Colégio Paralellus<br />
							Rua 15 de Novembro, 1.211 - Centro<br />
							79002-141<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 14 às 18h.<br />
							Telefone: (67) 3043 0447
						</p>
					</li>

					<li>
						<h4>Campos dos Goytacazes - RJ</h4>
						<p>
							APOUERJ<br />
							Avenida Doutor Nilo Peçanha, 614. Núcleo Central do Shopping Estrada, salas 14 a 19 - Bairro Parque Santo Amaro<br />
							28030-035<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 17h.<br />
							Telefone: (22) 2728 2005
						</p>
					</li>

					<li>
						<h4>Canoas - RS</h4>
						<p>
							Escola Kessler<br />
							Rua Pindorama, 179 - Bairro São José<br />
							92420-380<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 19h.<br />
							Telefone: (51) 3059 6299
						</p>
					</li>

					<li>
						<h4>Cascavel - PR</h4>
						<p>
							Colégio Expressão<br />
							Rua Recife, 1013 - Centro<br />
							85810-030<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 19h.<br />
							Telefone: (45) 3038 1013
						</p>
					</li>

					<li>
						<h4>Caxias do Sul - RS</h4>
						<p>
							Rede Canal do Saber / Escola Edificare<br />
							Rua Campo dos Bugres, 219 - Bairro Pio X<br />
							95034-050<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 12h e das 13 às 18h.<br />
							Telefone: (54) 3221 0028
						</p>
					</li>

					<li>
						<h4>Chapecó - SC</h4>
						<p>
							Rede Canal do Saber / Colégio Trilíngue Inovação<br />
							Rua Mato Grosso, 420-E - Bairro Jardim Itália<br />
							89802-272<br /><br />

							Horário do Polo: Segundas, terças, quartas e quintas-feiras, das 8h30min às 12h30min e das 13 às 20h. Sextas-feiras, das 8h30min às 12h30min e das 13 às 17h.<br />
							Telefone: (49) 3312 0244
						</p>
					</li>

					<li>
						<h4>Corumbá - MS</h4>
						<p>
							Rua Frei Mariano, 809 - Bairro Centro<br />
							79300-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 11h e das 13 às 22h. Aos sábados, das 7 às 11h.<br />
							Telefone: (67) 3232 0840
						</p>
					</li>

					<li>
						<h4>Cuiabá - MT</h4>
						<p>
							Educare<br />
							Rua Rio Casca, 18, Quadra 28, Casa 18 - Bairro Grande Terceiro<br />
							78065-660<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 10 às 18h.<br />
							Telefone: (65) 3026 5661 I (65) 9975 1161 I (65) 8124 7518
						</p>
					</li>

					<li>
						<h4>Curitiba - PR</h4>
						<p>
							Rede Canal do Saber / Sociedade Educacional Machado de Assis<br />
							Rua Joaquim Nabuco, 968 - Bairro Tingui<br />
							82620-060<br /><br />

							Horário do Polo: De segunda e quarta-feira, das 8 às 12h e das 13 às 21h. Terça, Quinta e Sexta-feira, das 8 às 12h e das 13 às 17h.<br />
							Telefone: (41) 3357 2065
						</p>
					</li>

					<li>
						<h4>Dourados - MS</h4>
						<p>
							Focus Instituto Educacional<br />
							Rua Oliveira Marques, 585 - Bairro Jardim Tropical<br />
							79820-040<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 13 às 17h e das 19 às 21h.<br />
							Telefone: (67) 3426 1168
						</p>
					</li>

					<li>
						<h4>Feira de Santana - BA</h4>
						<p>
							Colégio Resgate<br />
							Rua Ary Barroso, 573 - Bairro Serraria Brasil<br />
							44003-030<br /><br />

							Horário do Polo: Segunda a sexta-feira, das 7 às 18h30min.<br />
							Telefone: (75) 3491 2110
						</p>
					</li>

					<li>
						<h4>Palhoça - SC</h4>
						<p>
							Unisul<br />
							Avenida Pedra Branca, 25 - Bloco B, sala 111, Cidade Universitária - Bairro Pedra Branca<br />
							88137-270<br /><br />

							Horário do Polo: Segunda, terça, quinta e sexta-feira das 7h45min às 21h30min. Quarta, das 7h45min às 16h e das 17 às 21h30min.<br />
							Telefone: (48) 3279 1156
						</p>
					</li>

					<li>
						<h4>Fortaleza - CE</h4>
						<p>
							Rua Ildefonso Alban, 1030 - Bairro Aldeota<br />
							60115-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (85) 3221 2820
						</p>
					</li>

					<li>
						<h4>Foz do Iguaçu - PR</h4>
						<p>
							Avenida Coronel Francisco Ludolfo Gomes, 911. Sala 01, número 933 - Sala 02 - Bairro Jardim Panorama<br />
							85856-580<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 14 às 18h.<br />
							Telefone: (45) 3526 3327
						</p>
					</li>

					<li>
						<h4>Imperatriz - MA</h4>
						<p>
							Colégio Delta - IBEX<br />
							Rua Senador Millet, s/n - Bairro Três Poderes<br />
							65903-200<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 12h e das 14 às 17h.<br />
							Telefone: (99) 3523 3341
						</p>
					</li>

					<li>
						<h4>Itu - SP</h4>
						<p>
							Avenida Santa Rita, 1463 - Bairro Centro<br />
							13300-065<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 17h30min. Sábados das 8 às 16h.<br />
							Telefone: (11) 2429 5296
						</p>
					</li>

					<li>
						<h4>Içara - SC</h4>
						<p>
							Unisul<br />
							Rua Linha Três Ribeirões, S/N, Loteamento Centenário - Bairro Liri<br />
							88820-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 14 às 21h.<br />
							Telefone: (48) 3443 3050 / 3279 1242
						</p>
					</li>

					<li>
						<h4>Joinville - SC</h4>
						<p>
							Rede Canal do Saber<br />
							Avenida Juscelino Kubitschek, 645<br />
							89201-100<br /><br />

							Horário do Polo: Segunda, quinta e sexta-feira das 8 às 12h e das 13 às 17h. Terça e quarta-feira das 8 às 12h e das 13 às 21h.<br />
							Telefone: (47) 3027 1315
						</p>
					</li>

					<li>
						<h4>João Pessoa - PB</h4>
						<p>
							Anglo Cursos Pré-Vestibular - IBEX<br />
							Avenida Julia de Freire 523 - Bairro Torre<br />
							58040-040<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (83) 3244 4049
						</p>
					</li>

					<li>
						<h4>Juiz de Fora - MG</h4>
						<p>
							Sociedade Educacional de Juiz de Fora - Colégio CECON - Polo Unisul<br />
							Rua Santo Antônio, 437 - Bairro Centro<br />
							36015-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 13 às 21h.<br />
							Telefone: (32) 3082 6631 ou 3212 6686 ou 3212 1333
						</p>
					</li>

					<li>
						<h4>Jundiaí - SP</h4>
						<p>
							Avenida Vigário João José Rodrigues, 634, 1º andar - Bairro Centro<br />
							13201-001<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 17 às 22h. Aos sábados, das 8 às 12h.
						</p>
					</li>

					<li>
						<h4>Lages - SC</h4>
						<p>
							Rede Canal do Saber / ITP<br />
							Rua Hercilio Luz, 172 - Bairro Centro<br />
							Em frente ao MAP Hotel<br />
							81501-010<br /><br />

							Horário do Polo: De segunda a quinta-feira, das 8 às 11h50min e das 13h30min às 21h30min. Sexta, das 8 às 11h50min e das 13h30min às 20h.<br />
							Telefone: (49) 3224-3581
						</p>
					</li>

					<li>
						<h4>Lauro de Freitas - BA</h4>
						<p>
							Ibex Brasil<br />
							Avenida Praia de Itapoan, quadra D 27, lote 7, 2º andar - Belvedere Center, Vilas do Atlântico<br />
							Ponto de referência: em frente ao Colégio Apoio, ao lado da Prosevig.<br />
							42700-000<br /><br />

							Horário do Polo: De segunda a quinta-feira, das 8 às 18h e sexta-feira, das 8 às 17h.<br />
							Telefone: (71) 3082 7000
						</p>
					</li>

					<li>
						<h4>Londrina - PR</h4>
						<p>
							Rua Alagoas, 2001 - Jardim Canadá<br />
							86020-430<br /><br />

							Horário do Polo: Segunda, quarta e sexta-feira das 8 às 12h e das 18h às 22h. Terça, quinta e sábado das 8 às 12h.<br />
							Telefone: (43) 3026 2634
						</p>
					</li>

					<li>
						<h4>Macapá - AP</h4>
						<p>
							Rua General Rondon, 1467, sala 04 - Bairro Central<br />
							68906-260<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (96) 3227 0992
						</p>
					</li>

					<li>
						<h4>Maceió - AL</h4>
						<p>
							Rua João Lins Calheiros, 280 - Tabuleiro do Martins<br />
							Ponto de referência: situado na Galeria Aquarius - uma rua atrás da Transpal do Tabuleiro, em frente ao Ginásio do Colégio D'Lins.<br />
							57081-287<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 12h e das 14 às 19h.<br />
							Telefone: (82) 3352 0247
						</p>
					</li>

					<li>
						<h4>Manaus - AM</h4>
						<p>
							Avenida Joaquim Nabuco, 1841 - Bairro Centro<br />
							69020-030<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 20h.<br />
							Telefone: (92) 3633-5267 / 3232-3750
						</p>
					</li>

					<li>
						<h4>Natal - RN</h4>
						<p>
							Avenida Rio Branco, 840 - Bairro Cidade Alta<br />
							59025-002<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 22h.<br />
							Telefone: (84) 3206 3459
						</p>
					</li>

					<li>
						<h4>Niterói - RJ</h4>
						<p>
							Centro Educacional Niterói, Colégio Centrinho<br />
							Rua Itaguaí, 169 - Bairro Santa Rosa<br />
							24240-130<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 19h.<br />
							Telefone: (21) 2611 0000
						</p>
					</li>

					<li>
						<h4>Palmas - TO</h4>
						<p>
							106 Norte, Alameda 14, Lote 12, Plano Diretor<br />
							77006-076<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (63) 3225 2700
						</p>
					</li>

					<li>
						<h4>Passo Fundo - RS</h4>
						<p>
							Polo Passo Fundo - Núcleo de Ensino Integrado<br />
							Rua Capitão Eleutério, 169, Centro<br />
							99010-060<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 13h30min às 18h30min. Nas quartas, das 18h30min às 22h. E aos sábados: das 8 às 12h.<br />
							Telefone: (54) 3622-0436 / 3622-0437
						</p>
					</li>

					<li>
						<h4>Petrolina - PE</h4>
						<p>
							Espaço Ethos<br />
							Avenida Monsenhor Ângelo Sampaio, 377 - Bairro Maria Auxiliadora<br />
							56330-300<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 12h e das 14 às 17h. Aos sábados, das 8 às 17h.<br />
							Telefone: (87) 3202 6767 | (87) 3983 0067
						</p>
					</li>

					<li>
						<h4>Ponta Grossa - PR</h4>
						<p>
							Av Vicente Machado, 929 - Bairro Centro<br />
							84010-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7h30min às 21h.<br />
							Telefone: (42) 3222 3111
						</p>
					</li>

					<li>
						<h4>Porto Alegre - RS</h4>
						<p>
							Escola Alcides Maya<br />
							Rua Dr. Flores, 396 – Compl. 402 - Bairro Centro<br />
							90020-121<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 23h.<br />
							Telefone: (51) 3254 8383
						</p>
					</li>

					<li>
						<h4>Porto Velho - RO</h4>
						<p>
							Grupo Trinity (nas dependências da Fisk)<br />
							Rua Abunã, 1035 - Olaria<br />
							76801-293<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 14 às 18h. Aos sábados, das 8 às 12h e das 14 às 16h.<br />
							Telefone: (069)3224-1102
						</p>
					</li>

					<li>
						<h4>Praia Grande - SP</h4>
						<p>
							Rua Antonio Reinaldo Gonçalves, 478 - Bairro Vila Mar<br />
							11707-120<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 17h. Aos sábados, das 9 às 12h.<br />
							Telefone: (13) 3477 6463
						</p>
					</li>

					<li>
						<h4>Recife - PE</h4>
						<p>
							Rua Professor Mário de Castro, 284, Anexo 02, Sala 01 (1º Andar do Anexo da Unidade 1) - Bairro Boa Viagem<br />
							51030-260<br /><br />

							Horário do Polo: De segunda a quinta-feira, das 9 às 18h. Sexta, das 9 às 18h e das 19 às 22h. Aos sábados, das 8 às 18h.<br />
							Telefone: (81) 3328 1217
						</p>
					</li>

					<li>
						<h4>Ribeirão Preto - SP</h4>
						<p>
							Cursos D. Alcande<br />
							Rua Rui Barbosa, 1441 - Bairro Vila Seixas<br />
							14015-120<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 13h30min às 22h.<br />
							Telefone: (16) 3610 9036
						</p>
					</li>

					<li>
						<h4>Rio Branco - AC</h4>
						<p>
							Contil Informática<br />
							Avenida: Ceará, 2180 e 2181 - Bairro Dom Giocondo<br />
							69900-303<br /><br />

							Horário do Polo: De segunda a sexta- feita das 14 às 20h. Sábado das 8 às 12h.<br />
							Telefone: (68) 3223 6465
						</p>
					</li>

					<li>
						<h4>Rio Grande - RS</h4>
						<p>
							Rua Marechal Deodoro, 204 - Bairro Cidade Nova<br />
							96211-480<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7h30min às 12h e das 13h30min às 22h40min.<br />
							Telefone: (53) 3231 1600
						</p>
					</li>

					<li>
						<h4>Rio de Janeiro – RJ</h4>
						<p>
							Recreio dos Bandeirantes<br />
							Avenida Lúcio Costa, 17.686, Recreio dos Bandeirantes<br />
							22795-006<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 6h30min às 17h30min.<br />
							Telefone: (21) 3591 7204
						</p>
					</li>

					<li>
						<h4>Rio de Janeiro – RJ</h4>
						<p>
							Colegio Futuro Vip<br />
							Vila da Penha, Avenida Brás de Pina, 1744, Brás de Pina<br />
							21235-600<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 6h30min às 17h30min.<br />
							Telefone: (21) 3013 8264
						</p>
					</li>

					<li>
						<h4>Salvador - BA</h4>
						<p>
							EBT<br />
							Escola Baiana de Tecnologia, Transporte e Trânsito<br />
							Rua da Poeira, 105 - Bairro Nazaré<br />
							Observação: ao lado do EEEMBA (Escola de Engenharia Eletromecânica) e em Frente ao Ministério Publico.<br />
							40040 520<br /><br />

							Horário do Polo: De segunda a quinta-feira, das 8 às 18h, sexta, das 8 às 17h e sábados das 7h30min às 16h30min.<br />
							Telefone: (71) 3016 6922
						</p>
					</li>

					<li>
						<h4>Santa Maria - RS</h4>
						<p>
							Avenida Borges de Medeiros, 639 - Bairro Centro (Acesso pela entrada de veículos do Colégio Pão dos Pobres)<br />
							97010-081<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9h às 11h30min e das 14h30min às 17h30min.<br />
							Telefone: (55) 3217 2852
						</p>
					</li>

					<li>
						<h4>Santarém - PA</h4>
						<p>
							ITEAP<br />
							Avenida Mendonça Furtado, 1120 - Bairro Santa Clara<br />
							68005-100<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 17h.<br />
							Telefone: (93) 3524 0340
						</p>
					</li>

					<li>
						<h4>Santiago - RS</h4>
						<p>
							IBEX<br />
							Rua Felix da Cunha, 2244 - Bairro Centro<br />
							97700 000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8h30min às 12h e das 14 às 18h.<br />
							Telefone: (55) 3251 5630
						</p>
					</li>

					<li>
						<h4>Santo Ângelo - RS</h4>
						<p>
							Giga Star Informática<br />
							Rua Sete de Setembro, 601, 1º piso - Bairro Centro<br />
							98801-680<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 12h e das 14 às 21h. Aos sábados, das 8 às 12h.<br />
							Telefone: (55) 3312 4406
						</p>
					</li>

					<li>
						<h4>Sapucaia do Sul - RS</h4>
						<p>
							Instituto Latino Americano de Educação<br />
							Rua Jorge Assun, 314, Térreo - Bairro Paraíso<br />
							93220-600<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 13 às 18h.<br />
							Telefone: (51) 3034 1920
						</p>
					</li>

					<li>
						<h4>Sorocaba - SP</h4>
						<p>
							ITEAP<br />
							Rua Nelson Mascarenhas, 153, Sala 02 - Vila Independência (Jardim Paulistano)<br />
							8040-355<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 13 às 19h.<br />
							Telefone: (15) 3033 4811
						</p>
					</li>

					<li>
						<h4>São Bernardo do Campo - SP</h4>
						<p>
							ABCCursos e Concursos<br />
							Alameda Dona Tereza Cristina, 130 - Bairro Nova Petrópolis<br />
							09770-330<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 19h. Sábado, das 8 às 17h.<br />
							Telefone: (11) 4122 0543
						</p>
					</li>

					<li>
						<h4>São Borja - RS</h4>
						<p>
							Colégio Sagrado Coração de Jesus - Comprov<br />
							Rua Riachuelo, 1275, Compl. 204 - Bairro Centro<br />
							97670-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 14 às 22h.<br />
							Telefone: (55) 3431 2960
						</p>
					</li>

					<li>
						<h4>São José dos Campos - SP</h4>
						<p>
							CIAT - Centro Integrado de Aprendizagem no Trânsito (Melo e França)<br />
							Rua Euclides Miragaia, 121 - Bairro Vila Adyanna<br />
							12245-820<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 22h.<br />
							Telefone: (12) 3204 5507
						</p>
					</li>

					<li>
						<h4>São Leopoldo - RS</h4>
						<p>
							IELB Instituto Educacional<br />
							Rua Manoel de Macedo, 29, sala 01 - Bairro Morro do Espelho<br />
							93030-040<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 12h e das 13h30min às 17h30min. Quinta, das 17 às 21h.<br />
							Telefone: (51) 3091 0311
						</p>
					</li>

					<li>
						<h4>São Luís - MA</h4>
						<p>
							IBEX<br />
							Avenida  Castelo Branco, 71, 3º Piso, Sala 11 – São Francisco<br />
							Observação: último prédio lado direito sentido centro, próximo à ponte do São Francisco.<br />
							65076-090<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h. Aos sábados, das 8 às 12h.<br />
							Telefone: (98) 3227 6367
						</p>
					</li>

					<li>
						<h4>São Miguel do Oeste - SC</h4>
						<p>
							Ensinare Cursos<br />
							Rua Sete de Setembro, 2307, Sala 309-G e 310-G, Edifício Andrômeda - Bairro Centro<br />
							89900-000<br /><br />

							Horário do Polo: Segunda e sexta-feira, das 18h30min às 22h30min. Sábados, das 8 às 12h.<br />
							Telefone: (49) 3621 1121
						</p>
					</li>

					<li>
						<h4>São Paulo - SP</h4>
						<p>
							Colégio Heitor Garcia<br />
							Rua Roma, 350 - Bairro Lapa<br />
							05050-090<br /><br />

							Horário do Polo: De segunda a sábado, das 7 às 19h.<br />
							Telefone: (11) 3853 4996
						</p>
					</li>

					<li>
						<h4>Teresina - PI</h4>
						<p>
							IBEX<br />
							Rua Lisandro Nogueira, 1985 - Bairro Centro<br />
							64000-200<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 8 às 18h.<br />
							Telefone: (86) 3133 1250
						</p>
					</li>

					<li>
						<h4>Três Corações - MG</h4>
						<p>
							Coopersulminas<br />
							Rua Salomão Naback, 54 - Bairro Centro<br />
							37410-000<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 22h.<br />
							Telefone: (35) 3231 3332
						</p>
					</li>

					<li>
						<h4>Tubarão - SC</h4>
						<p>
							Unisul<br />
							Av. José Acácio Moreira, 787, Bairro Dehon, Caixa Postal 370<br />
							Referência (ao lado da Biblioteca do Campus).<br />
							88704-900<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 9 às 13h e das 14 às 21h.<br />
							Telefone: (48) 3621 3334 / 3279 1242
						</p>
					</li>

					<li>
						<h4>Uberlândia - MG</h4>
						<p>
							Colégio Federal<br />
							Rua Vigário Dantas, 478 - Centro<br />
							38400-202<br /><br />

							Horário do Polo: Segunda à sexta-feira, das 7 às 20h.<br />
							Telefone: 0800 234 5678 e (34) 3210 9613
						</p>
					</li>

					<li>
						<h4>Vitória - ES</h4>
						<p>
							Avenida Vitória, 2551 - Bairro Horto<br />
							Observação: próximo à Casa de Materiais de Construção D & D<br />
							29045-160<br /><br />

							Horário do Polo: De segunda a sexta-feira, das 7 às 22h e aos sábados, das 8 às 18h.<br />
							Telefone: (27) 3324 4064
						</p>
					</li>

					<li>
						<h4>Vitória da Conquista - BA</h4>
						<p>
							IBEX - HF Reforço Escolar<br />
							Avenida Luis Eduardo Magalhães, 200 - Bairro Candeias<br />
							45050-420<br /><br />

							Horário do Polo: Segunda das 8 às 12h e das 13 às 19h. Terça e quarta-feira das 8 às 12h e das 13 às 20h. Quinta e sexta-feira das 8 às 12h e das 13 às 17h.<br />
							Telefone: (77) 3421 0523
						</p>
					</li>
				</ul>
			</div>
		</div>
		<!-- End: Polos -->

		<!-- Pra Valer -->
		<div id="pravaler" class="block pravaler">
			<div class="limit">
				<h2><strong>Financie</strong> seu curso</h2>

				<h3><strong>Crédito Universitário</strong> Pague metade da mensalidade durante o curso<br />e o restante somente depois de formado.</h3>
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
				<h2>Apoio</h2>

				<ul>
					<li class="jovempan">
						<a>Jovem Pan</a>
					</li>

					<!--<li class="vocestore">
						<a href="#">Você Store</a>
					</li>-->
				</ul>
			</div>
		</div>
		<!-- End: Patrocinio -->

		<!-- Obrigado -->
		<div id="obrigado" style="width:780px; display:none;">
			<div class="header" style="margin: 10px;">
				<h2>Obrigado</h2>
				<p>Seus dados foram enviados corretamente, aguarde o contato da nossa equipe.</p>
			</div>
		</div>
		<!-- End: Obrigado -->

		<!-- Fundo -->
		<footer>
			<div class="limit">
				<ul>
					<li>
						<p>
							<strong>Central de Relacionamento</strong><br />
							<a href="mailto:vocegraduado@unisul.br">vocegraduado@unisul.br</a>
						</p>
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
				});
			})(jQuery);
		</script>
		<?php endif; ?>

		<?php if ( isset($_POST['interesse']) ) : ?>
		<script>
			(function($) {
				$(function() {
					var $interesse = $('#interesse');
					<?php foreach($_POST as $key => $value) : ?>
					$( '[name=<?php echo $key; ?>]', $interesse ).val('<?php echo $value; ?>');
					<?php endforeach; ?>
				});
			})(jQuery);
		</script>
		<?php endif; ?>

	</body>
</html>
