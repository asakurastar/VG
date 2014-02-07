<?php
/**
 * Template Name: Formulário de Inscrição
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( count($messages) > 0 ) : ?>
				<div>
					<div>Erro</div><br />
					<?php foreach($messages as $message) : ?>
					<span><?php echo $message; ?></span><br />
					<?php endforeach; ?>
				</div>
				<?php endif;?>

				<form method="post">
					<input type="hidden" name="inscricao" value="1" />
					Nome completo: <input type="text" name="post_title"><br />
					CPF: <input type="text" name="cpf"><br />
					RG: <input type="text" name="rg"><br />
					Órgão Emissor: <input type="text" name="orgao_emissor"><br />
					Data de Nascimento: <input type="text" name="data_de_nascimento"><br />
					Sexo:<br />
					<select name="sexo">
						<option value="M" selected="selected">Masculino</option>
						<option value="F">Feminino</option>
					</select><br />
					Endereço: <input type="text" name="endereco"><br />
					Telefone (Fixo): <input type="text" name="telefone_fixo"><br />
					Telefone (Celular): <input type="text" name="telefone_celular"><br />
					E-mail: <input type="text" name="email"><br />
					<input type="submit" value="Inscrever" />
				</form>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php
get_sidebar();
get_footer();