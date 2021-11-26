/**
 * 
 */

$(document).ready (function ($ready) {
	$('body').on ('keyup', ':input', function ($evt) {
		if ($evt.which === 13) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'client-auth':
					if ($(this).val () !== '') $('input#client-pass').focus ();
					break;
				case 'client-pass':
					$('button#submit-auth').trigger ('click');
					break;
				case 'input-username':
					$('button#account-next').trigger ('click');
					break;
				case 'input-password':
					$('button#account-submit').trigger ('click');
					break;
			}
		}
	});
	
	$('body').on ('click', 'button', function ($evt) {
		if ($(this).is ('button')) {
			$id = $(this).prop ('id');
			switch ($id) {
				default:
					break;
				case 'dosubmit-auth':
					$form = $(this).parents ('form');
					$pendingLayer = $(this).parents ('.card').next ();
					$pendingLayer.addClass ('item-pending');
					if (!$form.validateForm ()) {
						$(this).parents ('.card').next ().removeClass ('item-pending');	
					} else 
						$.ajax ({
							'url': $.base_url ($locale + '/assets/authenticate-client'),
							'method': 'put',
							'data': JSON.stringify ($form.serializeArray ()),
							'dataType': 'json',
							'contentType': 'json'
						}).done (function ($result) {
							setTimeout (function () {
								$pendingLayer.removeClass ('item-pending');
								if ($result.status != 200) console.log ($result.message);
								else {
									if (!$result.message[1]) window.location.href = $.base_url ($locale + '/client/setup/firsttime');
									else {
										$cardSlider = $pendingLayer.prev ().find ('#card-slider');
										$cardSlider.carousel ('next');
									}
								}
							}, 1500);
						});
					
					break;
				case 'submit-auth':
					$(this).prev ().trigger ('click');
					break;
				case 'account-next':
					$inputUsername = $('input[name="username"]').val ();
					if ($inputUsername === '') $('button:submit').click ();
					else {
						$(this).parents ('form').find ('.carousel').carousel ('next');
						$('span#login-message').text ($inputUsername);
						$('h4#login-title').fadeOut ('fast', function () {
							$('h4#login-name').fadeIn ('fast');
						});
						$('span#welcome-message').fadeOut ('fast', function () {
							$('span#login-message').fadeIn ('fast');
							$('input#input-password').focus ();
						});
					}
					break;
				case 'account-back':
					$(this).parents ('form').find ('.carousel').carousel ('prev');
					$('h4#login-name').fadeOut ('fast', function () {
						$('h4#login-title').fadeIn ('fast');
					});
					$('span#login-message').fadeOut ('fast', function () {
						$('span#login-message').empty ();
						$('span#welcome-message').fadeIn ('fast');
					})
					break;
				case 'account-submit':
					$form = $(this).parents ('form');
					$form.addClass ('was-validated');
					if (!$form.validateForm ()) {
						setTimeout (function () {
							$form.find (':input').each (function () {
								$(this).blur ()
							});
							$form.removeClass ('was-validated');
						}, 2500);
					} else {
						$itemPending = $(this).parents ('.card').next ();
						$itemPending.addClass ('item-pending');
						setTimeout (function () {
							$itemPending.removeClass ('item-pending');
							$.ajax ({
								'url': $.base_url ($locale + '/assets/do-userlogin'),
								'method': 'put',
								'data': JSON.stringify ($form.serializeArray ()),
								'dataType': 'json'
							}).done (function ($result) {
								if (!$result.good) ;
								else window.location.href = $.base_url ($locale + '/dashboard/welcome');
							}).fail (function () {
								
							});
						}, 1000);
					}
					break;
			}
		}
	});
	
	$(function () {
		$.getScript ($.base_url ('assets/web/js/locales/' + $locale + '.js'));
	});
});