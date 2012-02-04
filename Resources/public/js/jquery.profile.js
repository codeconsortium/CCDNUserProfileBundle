<!--
/*
 * Plugin jQuery.Profile
 * Requires JQuery, make sure to have JQuery included in your JS to use this.
 * JQuery needs to be loaded before this script in order for it to work.
 */
$(document).ready(function() {
	$().profile();
	
	$("input[name='Profile[avatar]']").prop("disabled", true);
});
	
(function($) {
	$.fn.profile = function() {
		
		$("input[name='Profile[avatar_is_remote]']").click(function(event) {

			this.check_remote = $("input[name='Profile[avatar_is_remote]']");
	
			if (this.check_remote.is(':checked')) {
				$("input[name='Profile[avatar]']").prop("disabled", false);
				this.check_remote.attr('checked', true);
			} else {
				$("input[name='Profile[avatar]']").prop("disabled", true);
				this.check_remote.attr('checked', false);
			}

			return true;
		});
	}

})(jQuery);

// -->