<?php
namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;

class FrontendRequestController extends BaseController {
	
	protected function additionalInitialization() {
		$this->helpers = ['cookie', 'url_helper'];
	}
	
	private function fileTransferAPI ($files, $targetURL) {
		$dataCookie	= get_cookie(CLIENT_CONFIG_NAME);
		$returnData = [
			'good'					=> TRUE,
			'uploaded-filenames'	=> [
				
			]
		];
		foreach ($files as $file) {
			$curlFile = new \CURLFile($file->getRealPath(), $file->getType(), $file->getFilename());
			$curlOptions = [
				'auth'	=> [
					$dataCookie,
					'',
					'basic'
				],
				'headers'	=> [
					'Accept'		=> 'application/json',
					'Content-Type'	=> 'multipart/form-data'
				],
				'multipart'	=> [
					'data-trigger'	=> 'newassetreq-imageupload',
					'data-file'		=> $curlFile
				]
			];
			$curl = \Config\Services::curlrequest();
			$serverResponse = $curl->post(server_url($targetURL), $curlOptions);
			$responsesData = json_decode($serverResponse->getBody (), TRUE);
			if ($responsesData['status'] == 200) {
				$responseMessages = unserialize(base64_decode($responsesData['message']));
				array_push($returnData['uploaded-filenames'], $responseMessages['data-filename']);
			} else $returnData['good'] = FALSE;
		}
		return $returnData;
	}
	
	public function postRequest () {
		if ($this->request->getMethod(TRUE) !== 'POST') return $this->response->redirect(base_url($this->locale . '/dashboard'));
		else {
			$result;
			$post = $this->request->getPost();
			$trigger = $post['trigger'];
			switch ($trigger) {
				default:
					$result = [
					];
					break;
				case 'requisition-newasset':
					$files = $this->request->getFileMultiple('newphotos');
					$result = $this->fileTransferAPI($files, 'client/api/data-processing');
					if (!$result['good']) ;
					else {
						$post = $this->request->getPost();
						$dataOptions = [
							'data-trigger'	=> 'newassetreq-requisition',
							'data-transmit'	=> [
								'data-formnewasset'	=> [
									'requisition-location'	=> $post['requisition-location'],
									'new-name'				=> $post['new-name'],
									'new-description'		=> $post['new-description'],
									'new-valueestimation'	=> $post['new-valueestimation'],
									'new-requestqty'		=> $post['new-requestqty'],
									'new-imagenames'		=> implode(', ', $result['uploaded-filenames'])
								],
								'data-loggedousr'	=> $this->getLoggedUserID()
							]
						];
						$result = $this->dataRequest($dataOptions);
					}
					break;
			}
		}
	}
	
	public function ajaxRequest () {
		if ($this->request->getMethod(TRUE) !== 'PUT') {
			$result = [
				'status'	=> 400,
				'message'	=> 'Bad Request!'
			];
		} else {
			$data_ousridx = $this->getLoggedUserID();
			$json = $this->request->getJSON(TRUE);
			$dataOptions = [
				'data-trigger'	=> $json['trigger'],
				'data-transmit'	=> ''
			];
			
			$render = true;
			
			switch ($json['trigger']) {
				default:
					$render = false;
					$result = [
						'status'	=> 400,
						'message'	=> 'Bad Request!'
					];
					break;
				case 'request-newattribute':
					$dataOptions['data-transmit'] = [
						'attrib-count' => $json['newattribute']['attrcount']
					];
					break;
				case 'asset-category':
					$dataOptions['data-transmit'] = [
						'category'	=> $json['category']
					];
					break;
				case 'asset-location':
					$dataOptions['data-transmit'] = [
						'location'	=> $json['location']
					];
					break;
				case 'asset-list':
					$dataOptions = [
						'data-trigger'	=> 'get-assetlist',
						'data-transmit'	=> [
							'output-type'	=> $json['type'],
							'from-location'	=> $json['from']
						]
					];
					
					if (array_key_exists('barcode', $json)) $dataOptions['data-transmit']['barcode-search'] = $json['barcode'];
					break;
				case 'asset-requestin':
					$dataOptions = [
						'data-trigger'	=> 'moveout-request',
						'data-transmit'	=> [
							'data-formrequest'	=> $json['form-data'],
							'data-loggedousr'	=> $data_ousridx
						]
					];
					break;
				case 'assetreq-newasset':
					break;
				case 'assetreq-existing':
					$dataOptions = [
						'data-trigger'	=> 'existing-requisition',
						'data-transmit'	=> [
							'data-formrequest'	=> $json['form-data'],
							'data-loggedousr'	=> $data_ousridx
						]
					];
					break;
				case 'moveout-sent':
					$dataOptions = [
						'data-trigger'	=> 'moveout-document',
						'data-transmit'	=> [
							'data-formmoveout'	=> $json['form-data'],
							'data-loggedousr'	=> $data_ousridx
						]
					];
					break;
				case 'clicked-docnum':
					$dataTransmit = $json['transmit'];
					$actionSource = $dataTransmit['source'];
					switch ($actionSource) {
						default:
							break;
						case 'doc-assetout':
							$dataOptions = [
								'data-trigger'	=> 'moveout-documentdetailed',
								'data-transmit'	=> [
									'data-docnum'		=> $dataTransmit['clicked-docnum'],
									'data-loggedousr'	=> $data_ousridx
								]
							];
							break;
						case 'doc-assetin':
							$dataOptions = [
								'data-trigger'	=> 'movein-documentdetailed',
								'data-transmit'	=> [
									'data-docnum'		=> $dataTransmit['clicked-docnum'],
									'data-loggedousr'	=> $data_ousridx
								]
							];
							break;
					}
					break;
				case 'movein-action':
					$dataTransmit = $json['transmit'];
					$dataTransmit['data-loggedousr'] = $data_ousridx;
					$dataOptions = [
						'data-trigger'	=> 'movein-doaction',
						'data-transmit'	=> $dataTransmit
					];
					break;
				case 'moveout-action':
					$dataTransmit = $json['transmit'];
					$dataTransmit['data-loggedousr'] = $data_ousridx;
					$dataOptions = [
						'data-trigger'	=> 'moveout-doaction',
						'data-transmit'	=> $dataTransmit
					];
					break;
				case 'distribute-assets':
					$dataTransmit = $json['transmit'];
					$dataTransmit['data-loggedousr'] = $data_ousridx;
					$dataOptions = [
						'data-trigger'	=> 'moveindo-assetdistribution',
						'data-transmit'	=> $dataTransmit
					];
					break;
				case 'target-sublocations':
					$dataTransmit	= $json['transmit'];
					$data = [
						'target-location'	=> $dataTransmit['tolocation-idx']
					];
					$dataOptions = [
						'data-trigger'	=> 'get-sublocationoflocation',
						'data-transmit'	=> $data
					];
					break;
			}
			
			if ($render) 
				$result = $this->dataRequest($dataOptions);
		}
		$this->response->setContentType('application/json');
		$this->response->setJSON($result);
		
		$this->response->send();
	}
}