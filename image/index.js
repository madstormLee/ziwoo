$( function() {
	$('a.popup').click( function( ev ) {
		ev.preventDefault();
		var el = $(ev.target);
		$('#popupBody').load( el.attr('href') );
		$('#popupWindow').show();
	});
	$('a.hideId').click( function( ev ) {
		ev.preventDefault();
		$( $(this).attr('href') ).hide();
	});
});
