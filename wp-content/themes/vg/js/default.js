$(function() {
	var $search = $('#search');
	var $submit = $('#submit');

	// Search
	$search
		.data( 'title', $search.attr('title') )
		.val( $search.data('title') )
		.on('focus', function() {
			if ( $(this).val() == $(this).data('title') ) {
				$(this).val('');
			}
		})
		.on('blur', function() {
			if ( '' == $(this).val() ) {
				$(this).val( $(this).data('title') );
			}
		})
		.on('keyup', function(e) {
			if ( 13 == e.which && '' != $(this).val() && $(this).val() != $(this).data('title') ) {
				search( $(this).val() );
			}
		});

	$submit.on('click', function(e) {
		e.preventDefault();
		search( $search.val() );
	})
	search('all');

	// Navigation
	$('a.nav').on('click', function(e) {
		e.preventDefault();

		var $target = $( $(this).attr('href') );
		var top     = $target.offset().top;
		$('html, body').animate({ 'scrollTop' : top }, 'slow');
	});

	// Fancybox Inscricao
	$('.fancybox-inscricao').fancybox();

	// Mask
	$('.cep').mask('99.999-999');
	$('.data').mask('99/99/9999');
	$('.cpf').mask('999.999.999-99');
	$(".telefone").mask("(99) 9999-9999?9", { placeholder : "_" }).focus(function() {
		$(this).keyup(function() {
			numeros = $(this).val().replace(/\D/g, '');
			if ( numeros.length == 11 ) { $(this).mask("(99) 99999-9999", { placeholder : "_" }); }
			if ( numeros.length == 10 ) { $(this).mask("(99) 9999-9999?9", { placeholder : "_" }); }
		});
	});

});

function search( value ) {
	var selector   = '#accordion';
	var $accordion = $( selector );
	$.get( base_url + 'wp-admin/admin-ajax.php', { action : 'cursos', search : value }, function(data) {
		if ( data ) {
			var $html = '';

			$('.block.cursos .limit').find( selector ).remove();

			$accordion.find('*').remove();
			$.each( data, function( k, v ) {
				$html += '<h3>' + k + '</h3><div>';
				if ( typeof(v) == "object" ) {
					$html += '<ul>';
					$.each(v, function( kk, vv ) {
						//$html += '<li><a href="javascript:void(0);" onclick="loadCurso(' + vv.id + ');">' + vv.title + ' <span>[' + vv.titulacao + ']</span></a></li>';
						$html += '<li><a href="' + base_url + vv.slug + '/' + vv.name + '" onclick="loadCurso(' + vv.id + ');">' + vv.title + ' <span>[' + vv.titulacao + ']</span></a></li>';
					});
					$html += '</ul><div style="clear: both;"></div>';
				}
				$html += '</div>';
			});

			$('.block.cursos .limit').append( $('<div id="accordion" />').append( $html ) );
			$('#accordion').accordion({
				heightStyle : "content"
			});
		}
	},'json' );
}

function loadCurso( id ) {
	$.get( base_url + 'wp-admin/admin-ajax.php', { action : 'curso', id : id }, function(data) {
		var selector      = '#detalhecurso';
		var curso         = 0;
		var $detalhes     = $( selector );
		var $titulo       = $( 'h2',            $detalhes ).text('');
		var $modalidade   = $( '.modalidade',   $detalhes ).html('');
		var $titulacao    = $( '.titulacao',    $detalhes ).html('');
		var $area         = $( '.area',         $detalhes ).html('');
		var $duracao      = $( '.duracao',      $detalhes ).html('');
		var $investimento = $( '.investimento', $detalhes ).html('');
		var $introducao   = $( '.introduction', $detalhes ).html('');
		var $perfil       = $( '#tabs-1',       $detalhes ).html('');
		var $objetivos    = $( '#tabs-2',       $detalhes ).html('');
		var $coordenacao  = $( '#tabs-3',       $detalhes ).html('');
		var $inscricao;
		var $interesse;
		
		if ( data ) { 
			$titulo.text( data.post_title );
			$modalidade.html( '<strong>Modalidade</strong>' + data.modalidade );
			$titulacao.html( '<strong>Titulação</strong>' + data.nivel );
			$area.html( '<strong>Área</strong>' + data.area_de_formacao );
			$duracao.html( '<strong>Duração</strong>' + data.duracao );
			$investimento.html( '<strong>Investimento</strong>' + data.investimento );
			$introducao.html( data.post_content );
			$perfil.html( data.perfil_do_profissional || 'Não disponível' );
			$objetivos.html( data.objetivos_e_dados_legais || 'Não disponível' );
			$coordenacao.html( data.coordenacao || 'Não disponível' );
			$detalhes.html( $detalhes.html().replace(/undefined/g, 'Informação não disponível') );
			$inscricao = $( 'a.inscricao', $detalhes );
			$interesse = $( 'a.interesse', $detalhes );

			// Tabs
			$.fancybox.open('.fancybox', { 
				href : selector,
				afterShow : function() {
					$('#tabs').tabs({ active : 0 });
				}
			});

			// Inscricao
			$inscricao.on('click', function(e) {
				e.preventDefault();
				
				curso = data.ID;
				$.fancybox.close('.fancybox');
				$.fancybox.close('.fancybox-interesse');
				$.fancybox.open('.fancybox-inscricao', { 
					href : '#inscricao',
					afterShow : function() {
						$( '[name=curso]', '#inscricao' ).val( curso );
					}
				});
			});

			// Interesse
			$interesse.on('click', function(e) {
				e.preventDefault();
				
				curso = data.ID;
				$.fancybox.close('.fancybox');
				$.fancybox.close('.fancybox-inscricao');
				$.fancybox.open('.fancybox-interesse', { 
					href : '#interesse',
					afterShow : function() {
						$( '[name=curso]', '#interesse' ).val( curso );
					}
				});
			});

		}

	}, 'json' );
}
