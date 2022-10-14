<?php
namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;

class FrontendRequestController extends BaseController {
	
	private function fileTransferAPI ($files, $targetURL) {
		$dataCookie	= get_cookie($this->prefix . CLIENT_CONFIG_NAME);
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
					'Accept'	=> 'application/json',
					'Content-Type'	=> 'multipart/form-data'
				],
				'multipart'	=> [
					'data-trigger'	=> 'newassetreq-imageupload',
					'data-file'	=> $curlFile
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
	
	protected function additionalInitialization() {
		$this->helpers = ['cookie', 'url_helper'];
	}
	
	public function postRequest () {
		if ($this->request->getMethod(TRUE) !== 'POST') return $this->response->redirect(base_url($this->locale . '/dashboard'));
		else {
			// $auths	= get_cookie ($this->prefix . CLIENT_CONFIG_NAME);
			$result;
			$post = $this->request->getPost();
			$trigger = $post['trigger'];
			$urlReferer = $this->request->getHeader ('Referer')->getValue ();
			switch ($trigger) {
				default:
					if (strpos ($trigger, 'upload-md-') !== FALSE) {
						$file = $this->request->getFile('uploaded-file');
						$filename = $file->getTempName();
						$csv_data = array_map ('str_getcsv', file ($filename));
						$header = array ();
						$data = array ();
						$index = 0;
						foreach ($csv_data as $csvData):
							if ($index == 0) $header = $csvData;
							else array_push($data, $csvData);
							$index++;
						endforeach;
						
						$dataOptions = [
							'data-trigger'	=> 'data' . $trigger,
							'data-transmit'	=> [
								'data-header'		=> $header,
								'data-body'		=> $data,
								'data-loggedousr'	=> $this->getLoggedUserID()
							]
						];
						
						$result = $this->dataRequest($dataOptions);
						$failedNum = $result['data-importfailed'];
						return $this->response->redirect ($urlReferer);
					}
					break;
				case 'sublocation-update':
					$post = $this->request->getPost ();
					$dataOptions = [
						'data-trigger'	=> 'sublocation-addupdate',
						'data-transmit'	=> [
							'data-locationcode'		=> $post['location-code'],
							'data-sublocationcode'		=> $post['code'],
							'data-description'		=> $post['dscript']
						]
					];
					$result = $this->dataRequest ($dataOptions);
					return $this->response->redirect (base_url ($this->locale . '/dashboard/location-detail?location-code=' . $post['location-code']));
					break;
				case 'destroy-request':
					$post = $this->request->getPost ();
					$dataOptions = [
						'data-trigger'	=> 'assetsdestroy-request',
						'data-transmit'	=> []
					];
					$transmit = [];
					$assets	= [];
					foreach ($post as $key => $data) {
						switch ($key) {
							default:
								if (strpos ($key, 'asset-id') !== FALSE) {
									$lineId = str_replace('asset-id-', '', $key);
									$assets[$lineId] = [
										'asset-idx'	=> $data
									];
								}
								
								if (strpos ($key, 'subloc-id') !== FALSE) {
									$lineId = str_replace('subloc-id-', '', $key);
									$assets[$lineId]['subloc-idx'] = $data;	
								}
								
								if (strpos ($key, 'remarks-destroy-id') !== FALSE) {
									$lineId = str_replace('remarks-destroy-id-', '', $key);
									$assets[$lineId]['remarks'] = $data;
								}
								
								if (strpos ($key, 'removal-qty') !== FALSE) {
									$lineId = str_replace('removal-qty-', '', $key);
									$assets[$lineId]['request-qty'] = $data;
								}
								break;
							case 'target-location':
								$transmit['location-idx']	= $data;
								break;
						}
					}
					$transmit['data-assets'] = $assets;
					$transmit['data-loggedousr'] = $this->getLoggedUserID();
					$dataOptions['data-transmit'] = $transmit;
					
					$this->dataRequest($dataOptions);
					
					return $this->response->redirect($urlReferer, 'GET');
				case 'requisition-newasset':
					$isValid = TRUE;
					$files = $this->request->getFileMultiple('newphotos');
					foreach ($files as $file) 
						if (!$file->isValid ()) {
							$isValid = FALSE;
							break;
						}
					
					if ($isValid) 
						$result = $this->fileTransferAPI($files, 'client/api/data-processing');
					else 
						$result = [
							'good'			=> TRUE,
							'uploaded-filenames'	=> [
							]
						];
						
					if (!$result['good']) $result = [];
					else {
						$post = $this->request->getPost();
						$dataOptions = [
							'data-trigger'	=> 'newassetreq-requisition',
							'data-transmit'	=> [
								'data-formnewasset'	=> [
									'requisition-location'	=> $post['requisition-location'],
									'name'			=> $post['new-name'],
									'description'		=> $post['new-description'],
									'valueestimation'	=> $post['new-valueestimation'],
									'requestqty'		=> $post['new-requestqty'],
									'remarks'		=> $post['new-remarks'],
									'imagenames'		=> implode(', ', $result['uploaded-filenames'])
								],
								'data-loggedousr'	=> $this->getLoggedUserID()
							]
						];
						$result = $this->dataRequest($dataOptions);
					}
					return $this->response->redirect($urlReferer, 'GET');
				case 'requisition-additionalasset':
					$post = $this->request->getPost ();
					
					$dataAdditions	= [];
					foreach ($post as $key => $value) {
						if (strpos ($key, 'sample-code') !== FALSE) {
							$lineId	= str_replace ('sample-code-', '', $key);
							$dataAdditions[$lineId]['code'] = $value;
						}
						
						if (strpos ($key, 'input-reqextqty') !== FALSE) {
							$lineId = str_replace ('input-reqextqty-', '', $key);
							$dataAdditions[$lineId]['qty'] = $value;
						}
						
						if (strpos ($key, 'input-reqextremarks') !== FALSE) {
							$lineId = str_replace ('input-reqextremarks-', '', $key);
							$dataAdditions[$lineId]['remarks'] = $value;
						}
					}
					
					$dataOptions = [
						'data-trigger'	=> 'existing-requisition',
						'data-transmit'	=> [
							'data-formrequest'	=> [
								'data-locationidx'	=> $post['requisition-location'],
								'data-additions'	=> $dataAdditions
							],
							'data-loggedousr'	=> $this->getLoggedUserID()
						]
					];
					$this->dataRequest ($dataOptions);
					return $this->response->redirect ($urlReferer, 'GET');
					break;
				case 'form-profile':
					$fileUpload = $this->request->getFile('profile-photo');
					$photoFilename = '';
					if ($fileUpload->getSize () > 0) {
						
					}
					
					$post = $this->request->getPost();
					$post['imageName']	= $photoFilename;
					$dataOptions = [
						'data-trigger'	=> 'profile-update',
						'data-transmit'	=> [
							'data-loggedousr'	=> $this->getLoggedUserID(),
							'data-form'		=> $post
						]
					];
					
					$this->dataRequest($dataOptions);
					return $this->response->redirect ($urlReferer, 'GET');
				case 'images-upload':
					$images = $this->request->getFileMultiple ('images');
					$fileTransmit	= array ();
					$index	= 0;
					foreach ($images as $image) {
						$fileContents	= base64_encode (file_get_contents ($image));
						$fileTransmit[$index]	= [
							'name'		=> $image->getRandomName (),
							'mime'		=> $image->getType (),
							'size'		=> $image->getSize (),
							'content'	=> $fileContents
						];
						$index++;
					}
					
					$dataOptions	= [
						'data-trigger'	=> 'images-bulkupload',
						'data-transmit'	=> [
							'data-loggedousr'	=> $this->getLoggedUserID (),
							'data-images'		=> $fileTransmit
						]
					];
					$responseData	= $this->dataRequest ($dataOptions);
					return $this->response->redirect ($urlReferer, 'GET');
				case 'destroy-action':
					$post	= $this->request->getPost ();
					$dataOptions	= [
						'data-trigger'	=> 'destroy-doaction',
						'data-transmit'	=> [
							'data-loggedousr'	=> $this->getLoggedUserID (),
							'data-docnum'		=> $post['docnum'],
							'data-doaction'		=> $post['action']
						]
					];
					
					$responseData	= $this->dataRequest ($dataOptions);
					return $this->response->redirect ($urlReferer, 'GET');
				case 'removal-action':
					$post	= $this->request->getPost ();
					
					$detailUpdate = [];
					foreach ($post as $name => $value) {
						if (strpos ($name, 'detail-line') !== FALSE) {
							$lineid = str_replace ('detail-line-', '', $name);
							$detailUpdate[$lineid]['data-lineid'] = $value;
						}
						
						if (strpos ($name, 'remove-method') !== FALSE) {
							$lineid = str_replace ('remove-method-', '', $name);
							$detailUpdate[$lineid]['data-method'] = $value;
						}
						
						if (strpos ($name, 'remove-qty') !== FALSE) {
							$lineid = str_replace ('remove-qty-', '', $name);
							$detailUpdate[$lineid]['data-qty'] = $value;
						}
					}
					
					$dataOptions	= [
						'data-trigger'	=> 'removal-doaction',
						'data-transmit'	=> [
							'data-docidx'		=> $post['doc-id'],
							'data-loggedousr'	=> $this->getLoggedUserID (),
							'data-detailupdate'	=> $detailUpdate
						]
					];
					
					$responseData	= $this->dataRequest ($dataOptions);
					return $this->response->redirect ($urlReferer, 'GET');
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
						'attrib-count'	=> $json['newattribute']['attrcount']
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
					$ipaddr = $this->request->getIPAddress ();
					$dataOptions = [
						'data-trigger'	=> 'moveout-request',
						'data-transmit'	=> [
							'data-ipaddress'	=> $ipaddr,
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
						case 'doc-assetproc':
							$dataOptions = [
								'data-trigger'	=> 'procure-documentdetailed',
								'data-transmit'	=> [
									'data-docnum'		=> $dataTransmit['clicked-docnum'],
									'data-loggedousr'	=> $data_ousridx
								]
							];
							break;
						case 'doc-assetremoval':
							$dataOptions = [
								'data-trigger'	=> 'removal-documentdetailed',
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
					$params	= $json['transmit'];
					
					$dataTransmit = [
						'data-mvidocnum'	=> '',
						'data-mviparams'	=> [
						],
						'data-loggedousr'	=> $data_ousridx
					];
					
					$mviParams = array ();
					
					foreach ($params as $param) {
						$name = $param['name'];
						switch ($name) {
							default:
								if (strpos ($name, 'item-id') !== FALSE) {
									$line = str_replace ('item-id-', '', $name);
									$mviParams[$line]['oita_idx'] = $param['value'];
								}
								
								if (strpos ($name, 'to-sublocation') !== FALSE) {
									$line = str_replace ('to-sublocation-', '', $name);
									$mviParams[$line]['osbl_idx'] = $param['value'];
								}
								
								if (strpos ($name, 'move-qty') !== FALSE) {
									$line = str_replace ('move-qty-', '', $name);
									$mviParams[$line]['qty'] = $param['value'];
								}
								break;
							case 'movein-docnum':
								$dataTransmit['data-mvidocnum'] = $param['value'];
								break;
						}
					}
					
					$dataTransmit['data-mviparams'] = $mviParams;
					
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
				case 'targeted-assetlists':
					$dataTransmit	= $json['transmit'];
					$dataOptions = [
						'data-trigger'	=> 'get-sublocationassetlists',
						'data-transmit'	=> [
							'data-locationidx'	=> $dataTransmit['location'],
							'data-sublocationidx'	=> $dataTransmit['sublocation']
						]
					];
					break;
				case 'dialog-button':
					$dataOptions = [
						'data-trigger'	=> 'get-dialogbutton',
						'data-transmit'	=> [
							'data-locale'	=> $this->locale,
							'data-type'	=> $json['data']
						]
					];
					break;
				case 'file-removal':
					$filenames	= $json['filenames'];
					$filenames	= explode (';', $filenames);
					$dataOptions = [
						'data-trigger'	=> 'images-removals',
						'data-transmit'	=> $filenames
					];
					break;
				case 'fetch-images':
					$dataOptions = [
						'data-trigger'	=> 'load-assetimages',
						'data-transmit'	=> [
							'data-loggedousr'	=> $data_ousridx
						]
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
