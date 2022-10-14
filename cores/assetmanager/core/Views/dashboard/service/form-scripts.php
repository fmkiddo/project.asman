
	<script type="text/javascript">
	$(document).ready (function () {
		$('button').click (function ($event) {
			$type	= $(this).prop ('type');
			switch ($type) {
				default:
					break;
				case 'reset':
					break;
				case 'submit':
					break;
			}
		});
		$('select').change (function ($event) {
			$selectId = $(this).prop ('id');
			switch ($selectId) {
				default:
					break;
				case 'location':
					$sublocationSelectPicker = $('select#sublocation');
					$dataLocId = $(this).find ('option:selected').attr ('data-locid');
					$data = {
						'trigger': 'target-sublocations',
						'transmit': {
							'tolocation-idx': $dataLocId
						}
					};
					$.ajax ({
						'url': $.base_url ($locale + '/api/get'),
						'method': 'put',
						'data': JSON.stringify ($data),
						'dataType': 'json',
						'contentType': 'json'
					}).done (function ($result) {
						if (!$result.good) ;
						else {
							$sublocationSelectPicker.find ('option').not (':first').remove ();
							$sublocationSelectPicker.find ('option:first').attr ('selected', true);
							$.each ($result['data-sublocations'], function ($k, $v) {
								$('<option/>', {
									'val': $k,
									'text': $v
								}).appendTo ($sublocationSelectPicker);
							});
							$sublocationSelectPicker.selectpicker ('refresh');
							
							$selectPickerAssets	= $('select#asset-lists');
							$selectPickerAssets.find ('option').remove ();
							$selectPickerAssets.selectpicker ('refresh');
						}
					}).fail (function () {
					});
					break;
				case 'sublocation':
					$selectPickerAssets	= $('select#asset-lists');
					$dataLoc		= $('select#location').find ('option:selected').attr ('data-locid');
					$dataSubloc		= $(this).val ();
					$data = {
						'trigger': 'targeted-assetlists',
						'transmit': {
							'location': $dataLocId,
							'sublocation': $dataSubloc
						}
					};
					$.ajax ({
						'url': $.base_url ($locale + '/api/get'),
						'method': 'put',
						'data': JSON.stringify ($data),
						'dataType': 'json',
						'contentType': 'json'
					}).done (function ($result) {
						if (!$result.good) ;
						else {
							$selectPickerAssets	= $('select#asset-lists');
							$selectPickerAssets.find ('option').not (':first').remove ();
							$selectPickerAssets.selectpicker ('refresh');
							
							$.each ($result['data-assets'], function ($k, $v) {
								$('<option/>', {
									'val': $v.idx,
									'text': $v.name
								}).appendTo ($selectPickerAssets);
							});
							$selectPickerAssets.selectpicker ('refresh');
						}
					}).fail (function () {
					});
					break;
			}
		});
	});
	</script>
