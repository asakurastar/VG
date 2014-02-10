$(function() {
	var $search    = $('#search');
	var $submit    = $('#submit');
	var $accordion = $('#accordion');

	// Search
	$search
	.data( 'title', $search.attr('title') )
	.on('focus', function() {
		if ( $(this).val() == $(this).data('title') ) {
			$(this).val('');
		}
	})
	.on('blur', function() {
		if ( '' == $(this).val() ) {
			$(this).val( $(this).data('title') );
		}
	});

	$submit.on('click', function(e) {
		e.preventDefault();
		search( $search.val() );
	})

	function search( value ) {
		$.get('wp-admin/admin-ajax.php', { action : 'cursos', search : value }, function(data) {
			if ( data ) {
				var $html = '';

				$('.block.cursos .limit').find('#accordion').remove();

				$accordion.find('*').remove();
				$.each( data, function( k, v ) {
					$html += '<h3>' + k + '</h3><div>';
					if ( typeof(v) == "object" ) {
						$html += '<ul>';
						$.each(v, function( kk, vv ) {
							$html += '<li><a href="#">' + vv.title + ' <span>[' + vv.titulacao + ']</span></a></li>';
						});
						$html += '</ul>';
					}
					$html += '</div>';
				});

				$('.block.cursos .limit').append( $('<div id="accordion" />').append( $html ) );
				$('#accordion').accordion();
			}
		},'json');
	}
	search('all');

	// Navigation
	$('nav a').on('click', function(e) {
		e.preventDefault();
		var $target = $( $(this).attr('href') );
		var top = $target.offset().top;
		$('html, body').animate({
			'scrollTop' : top
		}, 'slow');
	})
});