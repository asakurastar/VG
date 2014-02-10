<?php

// Remove o item de menu Posts
function remove_admin_menus() {
	remove_menu_page('edit.php');
}
add_action( 'admin_menu', 'remove_admin_menus' );

// Adiciona suporte para resumo de texto em páginas
function add_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_page_excerpts' );

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
			WHERE meta_key = 'nivel_portal'
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
						'titulacao' => get_field( 'nivel', $post->ID )
					) );
				}
			}
		}

		die( json_encode( $data ) );
	}

	die('0');
}
add_action( 'wp_ajax_cursos', 'ajax_cursos' );

// Ajax para carregar todas as informações de um determinado curso
function ajax_load_curso() {
	header("Content-type: application/x-javascript");

	if ( isset($_GET['id']) && !empty($_GET['id']) ) {
		$post               = get_post( $_GET['id'] );
		$post->post_content = apply_filters( 'the_content', $post->post_content );

		if ( $post ) {
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
add_action( 'wp_ajax_curso', 'ajax_load_curso' );

/*
 *************************************************************************************************
 * Controle de inscrições
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

// Remove visualmente a capacidade de criar ou editar inscrições pelo backend
function remove_new_inscricao_menu() {
	remove_submenu_page('edit.php?post_type=inscricoes', 'post-new.php?post_type=inscricoes');
}
function remove_new_inscricao_button() {
	$screen = get_current_screen();
	if ( isset($screen->post_type) && 'inscricoes' == $screen->post_type ) {
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
function remove_quick_edit_inscricao( $actions ) {
	$screen = get_current_screen();
	if ( isset($screen->post_type) && 'inscricoes' == $screen->post_type ) {
		unset( $actions['inline hide-if-no-js'] );
		unset( $actions['view'] );
	}

	return $actions;
}

add_filter( 'post_row_actions', 'remove_quick_edit_inscricao', 10, 2 );
add_action( 'admin_menu',       'remove_new_inscricao_menu'          );
add_action( 'admin_head',       'remove_new_inscricao_button'        );

// Captura e salva os dados do formulário de inscrição
function save_inscricao() {

	// Expõe $messages para ser usado em qualquer lugar
	global $messages;

	// Campos obrigatórios ( Campo => nome ou array( nome, máscara de validação, mensagem de erro ) )
	$fields = array(
		'nome'               => 'Nome completo',
		'rg'                 => 'RG',
		'uf'                 => 'UF',
		'orgao'              => 'Órgão emissor',
		'cpf'                => array(
			'name'  => 'CPF',
			'mask'  => '/^((\d){3}\.){2}(\d){3}\-(\d){2}$/',
			'error' => 'O campo %name% deve conter pontuação'
		),
		'nascimento'         => array(
			'name'   => 'Data de nascimento',
			'mask'   => '/^((\d){2}\/){2}(\d){4}$/',
			'error'  => 'O campo %name% deve estar no formato DD/MM/AAAA'
		),
		'sexo'               => 'Sexo',
		'cep'                => array(
			'name'  => 'CEP',
			'mask'  => '/^(\d){2}\.(\d){3}\-(\d){3}$/',
			'error' => 'O campo %name% deve estar no formato 00.000-000'
		),
		'endereco'           => 'Endereço',
		'numero'             => 'Nº',
 		'complemento'        => 'Complemento',
		'bairro'             => 'Bairro',
		'cidade'             => 'Cidade',
		'telefone-fixo'      => 'Telefone (Fixo)',
		'telefone-celular'   => 'Telefone (Celular)',
		'email'              => array(
			'name'  => 'E-Mail',
			'mask'  => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',
			'error' => 'O campo %name% não parece ser um endereço válido'
		)
	);

	// Mensagens de erro, sucesso, etc
	$messages = array();

	if ( isset($_POST['inscricao']) ) {
		array_map('sanitize_text_field', $_POST);

		foreach( $fields as $k => $v ) {
			$name  = is_array($v) ? $v['name'] : $v;
			$error = "O campo {$name} deve ser preenchido e válido";

			if ( !isset($_POST[ $k ]) || empty($_POST[ $k ]) ) {
				array_push( $messages,  $error );
			}

			elseif ( isset( $v['mask'] ) && !empty( $v['mask'] ) ) {
				if ( !preg_match( $v['mask'], $_POST[ $k ] ) ) {
					$error = isset( $v['error'] ) ? str_replace('%name%', $name, $v['error']) : $error;
					array_push( $messages,  $error );
				}
			}
		}

		if ( count($messages) > 0 && isset($_POST['curso']) ) {
			$messages['id'] = $_POST['curso'];
		}

		if ( 0 == count($messages) ) {
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

				unset($_POST);
				?>
				<script>
					alert('Sua inscrição foi realizada com sucesso');
				</script>
				<?php
			}
		}
	}
}
add_action( 'init', 'save_inscricao' );

// Exporta todas as inscrições publicadas para CSV e realiza seu download
function export_inscricoes_toCSV() {

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
			foreach( $posts as $post ) {
				$id   = $post->ID;
				$csv .= $id . ',"' . $post->post_title . '"';

				foreach( $fields as $field ) {
					$value = get_field( $field, $id );
					$csv .= ',"'. $value .'"';
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
add_action( 'init', 'export_inscricoes_toCSV' );

function export_bulk_admin_footer() {
	global $post_type;
	
	if ( isset($post_type) && 'inscricoes' == $post_type ) {
	?>
		<script type="text/javascript">
			(function($) {
				$(function() {
					var $actions = $('.bulkactions');
					var $csv     = $('<input type="button" />');

					$csv.attr({ 'class' : 'button action', 'value' : 'Exportar para CSV' });
					$csv.css('vertical-align', 'bottom');
					$csv.on('click', function() {
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
add_action( 'admin_footer-edit.php', 'export_bulk_admin_footer' );
