+function ($) {

	$(document).ready(function() {
		$( "#register_user_addmore" ).click(function() {
			event.preventDefault();
			$( ".student-information .box-science" ).clone().appendTo( ".student-information" );

		});
	});

}(jQuery);