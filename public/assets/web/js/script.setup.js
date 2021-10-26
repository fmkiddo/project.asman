/**
 * 
 */
$(document).ready (function () {
	
	$('body').on ('click', 'button', function ($evt) {
		if ($(this).is ('button')) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'to-firstform':
					$(this).parents ('.carousel').carousel ('next');
					break;
				case 'reset-firstform':
					$(this).parents ('div#first-form').find (':input').each (function () {
						$(this).val ('');
					});
					break;
				case 'to-secondform':
					$ready = true;
					$(this).parents ('div#first-form').find (':input').each (function () {
						if ($(this).prop ('required') && $(this).val () === '') $ready = false; 
						$name = $(this).prop ('name');
						$('td[id="' + $name + '"]').text ($(this).val ());
					});
					
					if ($('input[name="username"]').val ().indexOf (' ') >= 0) {
						$ready = false;
						$('input[name="username"]').val ('');
					}
					
					if (!$ready) $(this).parents ('form').find ('button:submit').click ();
					else {
						$('span#entry-username').text ($('input[name="username"]').val ());
						$(this).parents ('.carousel').carousel ('next');
					}
					break;
				case 'backto-firstform':
					$(this).parents ('.carousel').carousel ('prev');
					break;
				case 'reset-secondform':
					$(this).parents ('div#second-form').find (':input').each (function () {
						$(this).val ('');
					});
					break;
				case 'to-profileform':
					$ready = true;
					$(this).parents ('div#second-form').find (':input').each (function () {
						if ($(this).prop ('required') && $(this).val () === '') $ready = false;
					});
					$('td[id="password"]').text ('********');
					
					$passwordCompare = ($('input[name="entry-password"]').val () === $('input[name="confirm-password"]').val ());
					if (!$passwordCompare) {
						$ready = false;
						$(this).parents ('div#second-form').find (':input').each (function () {
							$(this).val ('');
						});
					}
					
					if (!$ready) $(this).parents ('form').find ('button:submit').click ();
					else $(this).parents ('.carousel').carousel ('next');
					break;
				case 'backto-secondform':
					$(this).parents ('.carousel').carousel ('prev');
					break;
				case 'reset-profileform':
					$(this).parents ('div#profile-form').find (':input').each (function () {
						$(this).val ();
					});
					break;
				case 'to-summarypage':
					$(this).parents ('.carousel').carousel ('next');
					$(this).parents ('div#profile-form').find (':input').each (function () {
						$name = $(this).prop ('name');
						$val = $(this).val ();
						if ($val.length == 0) $val = "--- empty ---";
						$('td[id="' + $name + '"]').text ($val);
					});
					break;
				case 'backto-profileform':
					$(this).parents ('.carousel').carousel ('prev');
					break;
				case 'resetand-tofirstform':
					$(this).parents ('.carousel').carousel (1);
					break;
				case 'submit-form':
					$form = $(this).parents ('form');
					$isFormValid = $form.validateForm ();
					if (!$isFormValid) ;
					else {
						$data = {
							'trigger': 'firsttime-setup',
							'transmit': $form.serializeArray ()
						};
						
						$.ajax ({
							'url': $.base_url ($locale + '/client/setup/firsttime-process'),
							'method': 'put',
							'data': JSON.stringify ($data),
							'dataType': 'json'
						}).done (function ($result) {
							setTimeout (function () {
								window.location.href = $.base_url ($locale + '/assets/user-login');
							}, 2000);
						}).fail (function () {
							
						});
					}
					break;
			}
		}
	});
	
	$(function () {
		$.getScript ($.base_url ('assets/web/js/locales/' + $locale + '.js'));
	})
});