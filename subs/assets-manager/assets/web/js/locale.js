/**
 * 
 */
$.replaceText = function ($key, $text) {
	$elements = $('[data-smarty="' + $key + '"]');
	$elements.each (function () {
		$element = $(this);
		if ($element.is ('button')) $element.attr ('title', $text);
		else if ($element.is ('input') || $element.is ('textarea')) $element.prop ('placeholder', $text);
		else if ($element.is ('th')) {
			$table = $(this).parents ('table');
			$divParent = $table.parent ();
			if ($divParent.hasClass ('dataTables_scrollBody')) ; // skip it!
			else if ($divParent.hasClass ('dataTables_scrollHeadInner')) $element.text ($text);
			else $element.text ($text);
		} else $element.text ($text);
	});
};

$(function () {
	$pathname	= $(location).attr ('pathname');
	$pathnames	= $pathname.split ('/');
	$document	= $pathnames[4];
	
	$('body').find ('.navbar-brand').text ($doclocale['title']);
	
	if ($document === 'setup') {
		$setupTexts = $doclocale['setup'];
		$.each ($setupTexts, function ($key, $text) {
			$.replaceText ($key, $text);
		});
	} else if ($document === 'user-login') {
		$loginTexts = $doclocale['user-login'];
		$.each ($loginTexts, function ($key, $text) {
			$.replaceText ($key, $text);
		});
	} else {
		$pagetexts	= $doclocale['pages'];
		$contents	= $doclocale['contents'][$document];
		$.each ($pagetexts, function ($key, $text) {
			$headelements = $('[data-headsmarty="' + $key + '"]');
			$headelements.each (function () {
				$(this).text ($text);
			});
		});
		
		$.each ($contents, function ($key, $text) {
			$.replaceText ($key, $text);
		});
	}
});