$(function() {
	CKEDITOR.replace('contents', {
		extraPlugins: 'autogrow',
		allowedContent: true
	});
	$('#wDate').datetimepicker();

	$('#write').submit( function ( ev ) {
		if (! $('#title').val().length > 0) {
			alert('no contents');
			$('#title').focus();
			return false;
		}
	});

	$('#images').click( function( ev ) {
		if( ev.target.tagName != 'IMG' ) {
			return false;
		}
		var el = $(ev.target);
		// var src = ev.target.src;
		var src = el.next('a').attr('data-resource');
		$('#image').val( src );
		$('#imagePreview').html( "<img src='"+el.attr('src')+"' width='195px' height='140px' />" );
	});
});
