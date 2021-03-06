<?php

// Remove o item de menu Posts
function remove_admin_menus() {
	remove_menu_page('edit.php');
}
add_action( 'admin_menu', 'remove_admin_menus' );

// Registra widget de dashboard para exibição de estatísticas Você Graduado
function register_stats_dashboard() {
	wp_add_dashboard_widget(
		'vg_dashboard_widget',
		'Estatísticas',
		'stats_dashboard_widget'
	);
}
function stats_dashboard_widget() {

	// Cursos
	$totalCursos = count( get_posts( array( 'post_type' => 'cursos', 'post_status' => 'publish', 'posts_per_page' => -1 ) ) );
	$cursoText   = ( $totalCursos > 1 )  ? 'Cursos' : 'Curso';

	// Polos
	$totalPolos = count( get_posts( array( 'post_type' => 'polos', 'post_status' => 'publish', 'posts_per_page' => -1 ) ) );
	$poloText   = ( $totalPolos > 1 )  ? 'Polos' : 'Polo';	

	// Inscrições
	$totalInscricoes = count( get_posts( array( 'post_type' => 'inscricoes', 'post_status' => 'publish', 'posts_per_page' => -1 ) ) );
	$inscricaoText   = ( $totalInscricoes > 1 )  ? 'Inscrições' : 'Inscrição';	

	// Interesses
	$totalInteresses = count( get_posts( array( 'post_type' => 'interesses', 'post_status' => 'publish', 'posts_per_page' => -1 ) ) );
	$interesseText   = ( $totalInteresses > 1 )  ? 'Interesses' : 'Interesse';
?>
	<div class="main">
		<ul>
			<li class="count">
				<a href="edit.php?post_type=cursos"><?php echo $totalCursos; ?> <?php echo $cursoText; ?></a>
			</li>			
			<li class="count">
				<a href="edit.php?post_type=polos"><?php echo $totalPolos; ?> <?php echo $poloText; ?></a>
			</li>			
			<li class="count">
				<a href="edit.php?post_type=inscricoes"><?php echo $totalInscricoes; ?> <?php echo $inscricaoText; ?></a>
			</li>			
			<li class="count">
				<a href="edit.php?post_type=interesses"><?php echo $totalInteresses; ?> <?php echo $interesseText; ?></a>
			</li>
		</ul>
		<div style="clear: both;"></div>
	</div>
<?php
}
function wp_enqueue_stats() {
?>
	<style type="text/css">
		#vg_dashboard_widget li {
			width: 50%;
			float: left;
			margin-bottom: 10px;
		}
		#vg_dashboard_widget li a:before { 
			content: '\f159';
			font: 400 20px/1 dashicons;
			speak: none;
			color: #888;
			display: block;
			float: left;
			margin: 0 5px 0 0;
			padding: 0;
			text-indent: 0;
			text-align: center;
			position: relative;
			-webkit-font-smoothing: antialiased;
			text-decoration: none !important;
		}
		#vg_dashboard_widget .count a:before { content: '\f109'; }
	</style>
<?php
}
add_action( 'admin_head' ,        'wp_enqueue_stats'         );
add_action( 'wp_dashboard_setup', 'register_stats_dashboard' );

// Registra post type para cursos
function register_post_type_cursos() {
	$labels = array(
		'name'                => 'Cursos',
		'singular_name'       => 'Curso',
		'menu_name'           => 'Cursos',
		'parent_item_colon'   => '',
		'all_items'           => 'Todos os cursos',
		'view_item'           => 'Visualizar curso',
		'add_new_item'        => 'Adicionar novo curso',
		'add_new'             => 'Adicionar novo',
		'edit_item'           => 'Editar curso',
		'update_item'         => 'Atualizar curso',
		'search_items'        => 'Pesquisar cursos',
		'not_found'           => 'Nenhum curso foi encontrado',
		'not_found_in_trash'  => 'Nenhum curso foi encontrado na lixeira'
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
	);
	register_post_type( 'cursos', $args );
}
add_action( 'init', 'register_post_type_cursos', 0 );

// Registra post type para polos
function register_post_type_polos() {
	$labels = array(
		'name'                => 'Polos',
		'singular_name'       => 'Polo',
		'menu_name'           => 'Polos',
		'parent_item_colon'   => '',
		'all_items'           => 'Todos os polos',
		'view_item'           => 'Visualizar polo',
		'add_new_item'        => 'Adicionar novo polo',
		'add_new'             => 'Adicionar novo',
		'edit_item'           => 'Editar polo',
		'update_item'         => 'Atualizar polo',
		'search_items'        => 'Pesquisar polos',
		'not_found'           => 'Nenhum polo foi encontrado',
		'not_found_in_trash'  => 'Nenhum polo foi encontrado na lixeira'
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
	);
	register_post_type( 'polos', $args );
}
add_action( 'init', 'register_post_type_polos', 0 );

// Adiciona filtro de consulta por post_title LIKE
function post_filter_where( $where, &$wp_query ) {
	global $wpdb;
	
	if ( $search_term = $wp_query->get('post_title_like') ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	}

	return $where;
}
add_filter( 'posts_where', 'post_filter_where', 10, 2 );

// Ajax para buscar cursos pesquisados
function ajax_cursos() {
	global $wpdb;

	header("Content-type: application/x-javascript");

	if ( isset($_GET['search']) && !empty($_GET['search']) ) {
		$search = trim( $_GET['search'] );
		$data   = array();

		$results = $wpdb->get_results("
			SELECT DISTINCT (meta_value)
			FROM wp_postmeta
			WHERE 1=1
				AND meta_key = 'nivel_portal'
				AND meta_value != 'Pós-Graduação e MBA'
		");
		if ( is_array($results) && count($results) > 0 ) {
			foreach($results as $result) {
				$category     = $result;
				$categories[] = $result->meta_value;
			}
		}

		foreach( $categories as $category ) {
			$data[ $category ] = array();

			$args = array(
				'post_type'       => 'cursos',
				'posts_per_page'  => -1,
				'post_status'     => 'publish',
				'orderby'         => 'title', 
				'order'           => 'ASC',
				'meta_query'      => array(
					array(
						'key'   => 'nivel_portal',
						'value' => $category
					)
				)
			);

			if ( 'all' != $search ) {
				$args['post_title_like'] = $search;
			}

			add_filter( 'posts_where', 'post_filter_where', 10, 2 );
			$query = new WP_Query($args);
			remove_filter( 'posts_where', 'post_filter_where', 10, 2 );

			if ( isset($query->posts) && count($query->posts) > 0 ) {
				foreach( $query->posts as $post ) {
					array_push( $data[ $category ], array(
						'id'        => $post->ID,
						'name'      => $post->post_name,
						'title'     => $post->post_title,
						'titulacao' => get_field( 'nivel', $post->ID ),
						'slug'      => sanitize_title( get_field( 'nivel_portal', $post->ID ) )
					) );
				}
			}
		}

		die( json_encode( $data ) );
	}

	die('0');
}
add_action( 'wp_ajax_nopriv_cursos', 'ajax_cursos' );
add_action( 'wp_ajax_cursos',        'ajax_cursos' );

// Ajax para carregar todas as informações de um determinado curso
function ajax_load_curso() {
	header("Content-type: application/x-javascript");

	if ( isset($_GET['id']) && !empty($_GET['id']) ) {
		$post = get_post( $_GET['id'] );

		if ( $post ) {
			$post->post_content = apply_filters( 'the_content', $post->post_content );

			if ( $fields = get_fields( $post->ID ) ) {
				if ( is_array($fields) && count($fields) > 0 ) {
					foreach( $fields as $key => $value ) {
						$post->{$key} = $value;
					}
				}
			}
		}

		die( json_encode( $post ) );
	}

	die('0');
}
add_action( 'wp_ajax_nopriv_curso', 'ajax_load_curso' );
add_action( 'wp_ajax_curso',        'ajax_load_curso' );

// Adiciona novas colunas no post type cursos
function add_new_columns_cursos( $columns ) {
	$columns['nivel']        = 'Nível';
	$columns['nivel_portal'] = 'Nível Portal';

	if ( isset($columns['wpseo-title'])    ) { unset($columns['wpseo-title']); }
	if ( isset($columns['wpseo-metadesc']) ) { unset($columns['wpseo-metadesc']); }
	if ( isset($columns['wpseo-focuskw'])  ) { unset($columns['wpseo-focuskw']); }

	return $columns;
}
function manage_columns_cursos( $column_name, $id ) {
	switch ( $column_name ) {
		case 'nivel' : {
			echo get_field( 'nivel', $id );
			break;
		}		
		case 'nivel_portal' : {
			echo get_field( 'nivel_portal', $id );
			break;
		}
		default: break;
	}
}
add_filter( 'manage_edit-cursos_columns',        'add_new_columns_cursos'      );
add_action( 'manage_cursos_posts_custom_column', 'manage_columns_cursos', 10, 2);

/*
 *************************************************************************************************
 * Controle de inscrições / Interesses
 ************************************************************************************************
 */
// Registra post type para inscrições
function register_post_type_inscricoes() {
	$labels = array(
		'name'                => 'Inscrições',
		'singular_name'       => 'Inscrição',
		'menu_name'           => 'Inscrições',
		'all_items'           => 'Todos as inscrições',
		'view_item'           => 'Visualizar inscrições',
		'add_new_item'        => 'Adicionar nova inscrição',
		'add_new'             => 'Adicionar nova',
		'edit_item'           => 'Editar inscrição',
		'update_item'         => 'Atualizar inscrição',
		'search_items'        => 'Pesquisar inscrições',
		'not_found'           => 'Nenhum inscrição foi encontrado',
		'not_found_in_trash'  => 'Nenhum inscrição foi encontrado na lixeira'
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
	);
	register_post_type( 'inscricoes', $args );
}
add_action( 'init', 'register_post_type_inscricoes', 0 );

// Registra post type para interesses
function register_post_type_interesses() {
	$labels = array(
		'name'                => 'Interesses',
		'singular_name'       => 'Interesse',
		'menu_name'           => 'Interesses',
		'parent_item_colon'   => '',
		'all_items'           => 'Todos os interesses',
		'view_item'           => 'Visualizar interesse',
		'add_new_item'        => 'Adicionar novo interesse',
		'add_new'             => 'Adicionar novo',
		'edit_item'           => 'Editar interesse',
		'update_item'         => 'Atualizar interesse',
		'search_items'        => 'Pesquisar interesses',
		'not_found'           => 'Nenhum interesse foi encontrado',
		'not_found_in_trash'  => 'Nenhum interesse foi encontrado na lixeira'
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
	);
	register_post_type( 'interesses', $args );
}
add_action( 'init', 'register_post_type_interesses', 0 );

// Remove visualmente a capacidade de criar ou editar inscrições/interesses pelo backend
function remove_new_inscricao_interesse_menu() {
	remove_submenu_page('edit.php?post_type=inscricoes', 'post-new.php?post_type=inscricoes');
	remove_submenu_page('edit.php?post_type=interesses', 'post-new.php?post_type=interesses');
}
function remove_new_inscricao_interesse_button() {
	$screen = get_current_screen();
	if ( isset($screen->post_type) && in_array( $screen->post_type, array('inscricoes', 'interesses') ) ) {
?>
	<style>
		.add-new-h2, 
		#edit-slug-box, 
		#side-sortables, 
		#screen-meta-links { display: none !important; }
	</style>
	<script>
	jQuery(document).ready(function() {
		jQuery('#post-body').removeClass('columns-2');
		jQuery('input[name=post\\_title], .postbox-container input, postbox-container textarea, .postbox-container select').attr({'readonly' : true, 'disabled' : true });
	});
	</script>
<?php
	}
}
function remove_quick_edit_inscricao_interesse( $actions ) {
	$screen = get_current_screen();
	if ( isset($screen->post_type) && in_array( $screen->post_type, array('inscricoes', 'interesses') ) ) {
		unset( $actions['inline hide-if-no-js'] );
		unset( $actions['view'] );
	}

	return $actions;
}

add_filter( 'post_row_actions', 'remove_quick_edit_inscricao_interesse', 10, 2 );
add_action( 'admin_menu',       'remove_new_inscricao_interesse_menu'          );
add_action( 'admin_head',       'remove_new_inscricao_interesse_button'        );

// Adiciona/modifica colunas na listagem de inscrição
function add_new_columns_inscricao( $columns ) {
	$columns['title'] = 'Nome';
	$columns['curso'] = 'Curso';
	$columns['polo']  = 'Polo';
	$columns['date']  = 'Data de inscrição';

	return $columns;
}
function manage_columns_inscricao( $column_name, $id ) {
	switch ( $column_name ) {
		case 'curso' : {
			echo get_post( get_field( 'curso', $id ) )->post_title;
			break;
		}		
		case 'polo' : {
			echo get_post( get_field( 'polo', $id ) )->post_title;
			break;
		}
		default: break;
	}
} 
add_filter('manage_edit-inscricoes_columns',        'add_new_columns_inscricao'      );
add_action('manage_inscricoes_posts_custom_column', 'manage_columns_inscricao', 10, 2);

// Adiciona/modifica colunas na listagem de interesse
function add_new_columns_interesse( $columns ) {
	$columns['title'] = 'Nome';
	$columns['curso'] = 'Curso';
	$columns['date']  = 'Data de interesse';

	return $columns;
}
function manage_columns_interesse( $column_name, $id ) {
	switch ( $column_name ) {
		case 'curso' : {
			echo get_post( get_field( 'curso', $id ) )->post_title;
			break;
		}
		default: break;
	}
}
add_filter('manage_edit-interesses_columns',        'add_new_columns_interesse'      );
add_action('manage_interesses_posts_custom_column', 'manage_columns_interesse', 10, 2);

// Captura e salva os dados do formulário de inscrição
function save_inscricao() {
	global $messagesInscricao;
	global $saved;

	@session_start();

	// Campos obrigatórios ( Campo => nome ou array( nome, máscara de validação, mensagem de erro ) )
	$fields = array(
		'nome',
		'rg',
		'orgao',
		'cpf'        => array(
			'mask'   => '/^((\d){3}\.){2}(\d){3}\-(\d){2}$/'
		),
		'nascimento' => array(
			'mask'   => '/^((\d){2}\/){2}(\d){4}$/'
		),
		'cep'        => array(
			'mask'   => '/^(\d){2}\.(\d){3}\-(\d){3}$/',
		),
		'endereco',
		'numero',
 		'complemento',
		'bairro',
		'cidade',
		'telefone_fixo',
		'telefone_celular',
		'email'      => array(
			'mask'   => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'
		)
	);

	if ( isset($_POST['inscricao']) ) {
		$messagesInscricao = array();

		foreach( $fields as $k => $v ) {

			// Normaliza chave/valor do campo
			$k = ( !is_array($v) ) ? $v : $k; 

			// Validações
			if ( !isset($_POST[ $k ]) || empty($_POST[ $k ]) ) {
				array_push( $messagesInscricao, $k );
			}
			elseif ( is_array($v) && isset( $v['mask'] ) && !preg_match( $v['mask'], $_POST[ $k ] ) ) {

				// Evita adicionar novamente o mesmo campo (caso já exista)
				if ( !in_array( $k, $messagesInscricao ) ) {
					array_push( $messagesInscricao, $k );
				}
			}

			elseif ( 'cpf' == $k && !isCPF( $_POST[ $k ] ) ) {
				array_push( $messagesInscricao, $k );
			}
		}

		if ( count($messagesInscricao) == 0 ) {
			if ( $id = wp_insert_post(array(
				'post_type'   => 'inscricoes',
				'post_title'  => $_POST['nome'],
				'post_status' => 'publish'
			)) ) {
				unset($_POST['post_title']);
				unset($_POST['inscricao']);

				foreach( $_POST as $k => $v ) {
					update_post_meta( $id, $k, $v );
				}
				$saved = true;
				$_SESSION['saved'] = $saved;
				header("Location: " . get_bloginfo('wpurl') . "/inscricao/concluida");
				die();
			}
		}
	}
}
add_action( 'init', 'save_inscricao' );

// Captura e salva os dados do formulário de interesse
function save_interesse() {
	global $messagesInteresse;
	global $saved;

	// Campos obrigatórios ( Campo => nome ou array( nome, máscara de validação, mensagem de erro ) )
	$fields = array(
		'nome',
		'telefone_fixo',
		'telefone_celular',
		'email'      => array(
			'mask'   => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'
		)
	);

	if ( isset($_POST['interesse']) ) {
		$messagesInteresse = array();

		foreach( $fields as $k => $v ) {

			// Normaliza chave/valor do campo
			$k = ( !is_array($v) ) ? $v : $k; 

			// Validações
			if ( !isset($_POST[ $k ]) || empty($_POST[ $k ]) ) {
				array_push( $messagesInteresse, $k );
			}
			elseif ( is_array($v) && isset( $v['mask'] ) && !preg_match( $v['mask'], $_POST[ $k ] ) ) {

				// Evita adicionar novamente o mesmo campo (caso já exista)
				if ( !in_array( $k, $messagesInteresse ) ) {
					array_push( $messagesInteresse, $k );
				}
			}
		}

		if ( 0 == count($messagesInteresse) ) {
			if ( $id = wp_insert_post(array(
				'post_type'   => 'interesses',
				'post_title'  => $_POST['nome'],
				'post_status' => 'publish'
			)) ) {
				unset($_POST['post_title']);
				unset($_POST['interesse']);

				foreach( $_POST as $k => $v ) {
					update_post_meta( $id, $k, $v );
				}
				$saved = true;
			}
		}
	}
}
add_action( 'init', 'save_interesse' );

// Exporta todas as inscrições publicadas para CSV e realiza seu download
function export_inscricoes_csv() {

	// Proteção para backend
	if ( is_admin() && isset($_GET['csv']) ) {

		$csv    = '';
		$fields = array(
			'cpf', 
			'rg', 
			'orgao', 
			'nascimento', 
			'sexo', 
			'endereco', 
			'numero', 
			'complemento', 
			'bairro', 
			'cidade', 
			'uf', 
			'cep', 
			'telefone-fixo', 
			'telefone-celular', 
			'email'
		);

		$posts = get_posts(array(
			'post_type'      => 'inscricoes',
			'post_status'    => 'publish',
			'posts_per_page' => -1
		));

		if ( count($posts) > 0 ) {

			// Cabeçalho do CSV
			$csv .= '"CODIGO","NOME","CPF","RG","ORGAO EMISSOR","DATA DE NASCIMENTO","SEXO","ENDERECO","NUMERO","COMPLEMENTO","BAIRRO","CIDADE","UF","CEP","TELEFONE FIXO","TELEFONE CELULAR","EMAIL","CURSO CODIGO","CURSO","POLO CODIGO","POLO"';
			$csv .= "\n";

			// Gera os dados na estrutura de CSV
			foreach( $posts as $post ) {
				$id   = $post->ID;
				$csv .= $id . ',"' . utf8_decode( $post->post_title ) . '"';

				foreach( $fields as $field ) {
					$value = get_field( $field, $id );
					$csv .= ',"'. utf8_decode( $value ) .'"';
				}

				if ( $cursoID = get_field( 'curso', $id ) ) {
					$curso = get_post( $cursoID );
					$csv .= ',"' . get_field( 'codigo', $curso->ID ) . '"';
					$csv .= ',"' . utf8_decode( $curso->post_title ) . '"';
				} else {
					$csv .= ',"",""';
				}

				if ( $poloID = get_field( 'polo', $id ) ) {
					$polo = get_post( $poloID );
					$csv .= ',"' . get_field( 'codigo', $polo->ID ) . '"';
					$csv .= ',"' . utf8_decode( $polo->post_title ) . '"';
				} else {
					$csv .= ',"",""';
				}

				$csv .= "\n";
			}

			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="export-' . uniqid() . '.csv"');
			header('Content-Transfer-Encoding: binary');
			header('Connection: Keep-Alive');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . strlen($csv));
			print $csv;
		}
	}
}
function export_bulk_admin_footer() {
	global $post_type;

	if ( ( !isset($_GET['post_status']) || 'trash' != $_GET['post_status'] ) && isset($post_type) && 'inscricoes' == $post_type ) {
	?>
		<script type="text/javascript">
			(function($) {
				$(function() {
					var $actions = $('.bulkactions');
					var $csv     = $('<input type="button" />');

					$csv
						.attr({ 'class' : 'button action', 'value' : 'Exportar para CSV' })
						.css('vertical-align', 'bottom')
						.on('click', function() {
							$('#posts-filter')
								.append( $('<input type="hidden" name="csv" value="1" />') )
								.trigger('submit');
						});

					$actions.append($csv);
				});
			})(jQuery);
		</script>
	<?php
	}
}
add_action( 'init',                  'export_inscricoes_csv'    );
add_action( 'admin_footer-edit.php', 'export_bulk_admin_footer' );

// Adiciona rewrite rule para aceitar urls amigáveis de cursos
function add_curso_rules() {
	add_rewrite_rule(  
		'([^/]+)/([^/]+)/?',  
		'index.php?post_type=cursos&name=$matches[2]',  
		'top'
	); 
}
add_action( 'init', 'add_curso_rules' );

/**
 * Função helper para validar CPF
 * @param string $cpf O CPF a ser validado (com ou sem pontuação)
 * @return boolean O resultado da validação
 */
function isCPF( $cpf ) {	
	$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
		return false;
	}
	else {
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}

			$d = ((10 * $d) % 11) % 10;

			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}