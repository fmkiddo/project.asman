/**
 * 
 */

$(document).ready (function () {
	$pageDataTables = [];
	$(function () {
		var $dataTables = $('table.dataTable');
		if ($dataTables.length > 0) {
			$dataTables.each (function () {
				var $dataTable = $(this),
					$ths = $dataTable.find ('th');
				$ths.each (function () {
					$(this).addClass ('text-center');
				});
				$dataTable.addClass ('table table-striped table-hover table-pointer');
				$dataTableOptions = {
					'autoWidth': false,
					'pageLength': 25,
					'scrollX': true
				};
				
				$.each ($dataTable[0].attributes, function (i, a) {
					switch (a.name) {
						default:
							break;
						case 'data-paging':
						case 'data-searching':
							$name = a.name.replace ('data-', '');
							$dataTableOptions[$name] = a.value;
							break;
					}
				});
				$dTable = $dataTable.DataTable ($dataTableOptions);
				$pageDataTables.push ($dTable);
			});
		};
	});
	
	$.searchDataTable = function ($id) {
		$dataTable = {};
		$.each ($pageDataTables, function ($i, $dt) {
			$table = $($dt.table ().container ()).find ('table#' + $id);
			if ($table.length > 0) {
				$dataTable = $dt;
				return;
			}
		});
		return $dataTable;
	};
	
	$('a[data-toggle="tab"]').on ('shown.bs.tab', function ($evt) {
		$.fn.dataTable.tables ({'visible': true, 'api': true}).columns.adjust ();
	});
	var curl = location.href.split ('/').pop ();
	if (curl === 'index' || curl === 'welcome') curl = 'index';
	var ahref = $('a[onclick="window.location.href=\'' + curl + '\'"]');
	ahref.parent ('li').addClass ('active');
	if (ahref.hasClass ('nav-link')) ahref.parent ('li').addClass ('active');
	else {	
		ahref.addClass ('active');	
		ahref.parents ('div.collapse').addClass ('show');
	}
	
	$.fn.readPreviewImages = function ($target) {
		$input = $(this);
		$myfiles = $input.prop ('files');
		if ($myfiles) {
			$imgs = [];
			$fileCount = $myfiles.length;
			
			for ($id=0; $id<$fileCount; $id++) {
				$reader = new FileReader ();
				$($reader).on ('load', function ($event) {
					$carouselItem = $('<div/>', {
						'class': 'carousel-item'
					}).appendTo ($target);
					$('<img/>', {
						'class': 'd-block w-100',
						'src': $event.target.result
					}).appendTo ($carouselItem);
					if ($carouselItem.is ($carouselItem.parent ().children (':eq(0)'))) $carouselItem.addClass ('active');
				});
				$reader.readAsDataURL ($myfiles[$id]);
			}
		}
	};
	
	$(function () {
		$.getScript ($.base_url ('assets/web/js/locales/' + $locale + '.js'));
	});
});