<?php
namespace App\Controllers;


use App\Libraries\DocumentStatus;

class DashboardController extends BaseController {
	
// 	public const USERID = 3;
	
	private function isUserNotLoggedIn () {
		return get_cookie(CLIENT_USER_COOKIE) == NULL;
	}
	
	private function isConfigCookieNotSet () {
		return (get_cookie(CLIENT_CONFIG_NAME) == NULL);
	}
	
	private function saveCategoryItem ($params=[]): bool {
		
	}
	
	private function saveUser ($param=[]): array {
		$dataTrigger = 'userupdate';
		if ($param['userid'] == 0)
			$dataTransmit	= [
				'userid'	=> $param['userid'],
				'param'		=> [
					'new-username'			=> $param['username'],
					'new-email'				=> $param['email'],
					'new-password'			=> $param['password'],
					'new-usergroup'			=> $param['accesslevel'],
					'new-accesslocation'	=> $param['accesslocation']
				]
			];
		else {
			$dataTransmit	= [
				'userid'	=> $param['userid'],
				'param'		=> [
					'update-email'			=> $param['email'],
					'update-usergroup'		=> $param['accesslevel'],
					'update-accesslocation'	=> $param['accesslocation']
				]
			];
			
			if ($param['change-password'] > 0)
				$dataTransmit['param']['update-password'] = $param['npassword'];
		}
			
		$dataoptions = [
			'data-trigger'	=> $dataTrigger,
			'data-transmit'	=> $dataTransmit
		];
		return $this->dataRequest($dataoptions);
	}
	
	private function getLoggedUserID () {
		$cookie = get_cookie(CLIENT_USER_COOKIE);
		$userString = base64_decode($cookie);
		return json_decode($userString, TRUE)['id'];
	}
	
	protected function additionalInitialization() {
		$this->helpers	= ['cookie', 'url_helper'];
		$this->assets	= [
			'assetUrl'		=> '/assets',
			'assetFolder'	=> '/web',
			'webassets'		=> [
				'styles'		=> [
					'/css/dashboard.css'
				],
				'scripts'		=> [
					'/js/functions.js',
					'/js/dashboard.js'
				]
			],
			'vendorFolder'	=> '/vendors',
			'vendorassets'	=> [
				'styles'		=> [
					'/fonts/fondamento/stylesheet.css',
					'/bootstrap/css/bootstrap.css',
					'/datatables/datatables.css',
					'/fontawesome/css/all.css',
					'/now-ui/css/now-ui-dashboard.css?v=1.5.0',
// 					'/now-ui/css/now-ui-kit.css?v=1.2.0'
				],
				'scripts'		=> [
					'/jquery/jquery-3.5.1.js',
					'/popper/popper.min.js',
					'/bootstrap/js/bootstrap.js',
					'/bootstrap/js/bootstrap-datepicker.js',
// 					'/bootstrap/js/bootstrap-switch.js',
					'/datatables/datatables.js',
					'/fontawesome/js/all.js',
					'/now-ui/js/now-ui-dashboard.js',
// 					'/now-ui/js/now-ui-kit.js?v=1.2.0'
				]
			]
		];
	}
	
	public function displayDashboard ($param='') {
		if ($this->isConfigCookieNotSet())
			return $this->response->redirect(base_url($this->locale . '/assets/user-login'), 'GET');
		elseif ($this->isUserNotLoggedIn())
			return $this->response->redirect(base_url($this->locale . '/assets/user-login'), 'GET');
		else {
			if ($param === '') return $this->response->redirect(base_url($this->locale . '/dashboard/index'));

			$loggedOusr = $this->getLoggedUserID();
			$render = true;
			$pageName = '';
			$options = $this->getPageOptions();
			switch ($param) {
				default:
					$render = false;
					break;
				case 'index':
				case 'welcome':
					$pageName = 'dashboard/main';
					break;
				case 'master-categories':
					$result = $this->dataRequest(['data-trigger' => 'categories']);
					$options ['pagedata'] = $result;
					$pageName = 'dashboard/category/main';
					break;
				case 'new-category':
					if ($this->request->getMethod(TRUE) === 'POST') {
						$post = $this->request->getPost();
						$dataoptions = [
							'data-trigger'	=> 'new-oaci',
							'data-transmit'	=> $post
						];
						$result = $this->dataRequest($dataoptions);
						
						$options['retcode'] = $result['returncode'];
						$options['retmsg'] = $result['message'];
					}
					$options['ci']	= 0;
					
					$pagedata['title']		= 'Tambah Baru Kategori Item';
					$pagedata['name']		= '';
					$pagedata['dscript']	= '';
					$pagedata['ciattribs']	= '';
					$pagedata['ciattrtext'] = [
						'hidden' => '',
						'texts' => ''
					];
					
					$pagedata['attribs'] = $this->dataRequest([
						'data-trigger' => 'ciattributes'
					])['cta'];
					
					$pagedata['attribtypes'] = $this->dataRequest([
						'data-trigger' => 'ciattributtype'
					])['attribTypes'];
					
					$pageName = 'dashboard/category/new-category';
					
					$options['pagedata'] = $pagedata;
					break;
				case 'asset-categoryitem':
					
					if ($this->request->getMethod(TRUE) === 'POST') {
						$post = $this->request->getPost();
						$dataoptions = [
							'data-trigger'	=> 'update-oaci',
							'data-transmit'	=> $post
						];
					}
					
					$get = $this->request->getGet();
					$ci = $get['categoryitem'];
					
					$options['ci'] = $ci;
					$dataoptions = [
						'data-trigger'	=> 'categoryitem',
						'data-transmit'	=> [
							'oaci-idx' => $get['categoryitem']
						]
					];
					
					$dataRequest = $this->dataRequest($dataoptions);
					$cidata = $dataRequest['cidata'];
					$pagedata['title']		= 'Edit Informasi Kategori Item';
					$pagedata['name']		= $cidata['oaci_name'];
					$pagedata['dscript']	= $cidata['oaci_dscript'];
					$pagedata['ciattribs']	= $dataRequest['ciattribs'];
					$pagedata['ciattrtext'] = $dataRequest['ciattribsinput'];
				
					$pagedata['attribs'] = $this->dataRequest([
						'data-trigger' => 'ciattributes'
					])['cta'];
					
					$pagedata['attribtypes'] = $this->dataRequest([
						'data-trigger' => 'ciattributtype'
					])['attribTypes'];
					
					$pageName = 'dashboard/category/new-category';					
					
					$options['pagedata'] = $pagedata;
					break;
				case 'master-loanee':
					$pagedata = [];
					
					$pageName = 'dashboard/loanee/main';
					
					$options['pagedata'] = $pagedata;
					
					break;
				case 'location':
					$result = $this->dataRequest(['data-trigger' => 'location']);
					$options['pagedata']	= $result;
					$pageName = 'dashboard/location/main';
					break;
				case 'location-detail':
					$dataTransmit = [
						'data-trigger'	=> 'detailedlocation',
						'data-transmit'	=> [
							'olctid' 		=> $this->request->getGet('location')
						]
					];
					$result = $this->dataRequest($dataTransmit);
					$options['pagedata'] = $result;
					$pageName = 'dashboard/location/detail';
					break;
				case 'form-location':
					$options['idx'] = 0;
					$options['before'] = 'location';
					if ($this->request->getMethod(TRUE) === 'POST') {
						$dataoptions = [
							'data-trigger'	=> 'locationprofile',
							'data-transmit'	=> [
								'olctid'	=> $this->request->getPost('location')
							]
						];
						$result = $this->dataRequest($dataoptions);
						$options['pagedata'] = $result;
						$options['idx'] = $this->request->getPost('location');
						$options['before'] = $this->request->getPost('before');
					}
					$pageName = 'dashboard/location/add';
					break;
				case 'master-assets':
					$dataoptions = [
						'data-trigger'		=> 'assets-main-list'
					];
					$result = $this->dataRequest($dataoptions);
					$options['pagedata'] = $result;
					$pageName = 'dashboard/assets/main';
					break;
				case 'asset-details':
					$code	= $this->request->getGet('code');
					$dataoptions = [
						'data-trigger'		=> 'asset-details',
						'data-transmit'		=> [
							'assetcode'			=> $code
						]
					];
					
					$result = $this->dataRequest($dataoptions);
					$options['pagedata'] = $result;
					$pageName = 'dashboard/assets/detail';
					break;
				case 'new-asset':
					$options['idx'] = 0;
					if ($this->request->getMethod(TRUE) == 'POST') {
						$dataoptions = [
							'data-trigger'	=> '',
							'data-transmit'	=> [
								'oitaid'
							]
						];
						$result = $this->dataRequest($dataoptions);
						$options['pagedata'] = $result;
					} else {
						$dataoptions = [
							'data-trigger'	=> 'newassets'
						];
						$result = $this->dataRequest($dataoptions);
						$options['pagedata'] = $result;
					}
					
					$options['psassets'] = [
						'styles'	=> [
							base_url('assets/vendors/bootstrap/css/bootstrap-select.css')
						],
						'scripts'	=> [
							base_url('assets/vendors/bootstrap/js/bootstrap-select.js')
						]
					];
					$pageName = 'dashboard/assets/new-asset';
					break;
				case 'form-sublocation':
					$pageName = 'dashboard/sublocation';
					break;
				case 'users':
					$dataoptions = [
						'data-trigger'	=> 'muser-retrieve'
					];
					
					$result = $this->dataRequest($dataoptions);
					$options['pagedata'] = $result;
					$pageName = 'dashboard/users/main';
					break;
				case 'masteruser-newform':
					if ($this->request->getMethod(TRUE) === 'POST') {
						$post = $this->request->getPost();
						$pswd	= $post['password'];
						$cpswd	= $post['cpassword'];
						if ($pswd === $cpswd) $options['saveresult'] = $this->saveUser($post);
						else {
							
						}
					}
					
					if (array_key_exists('pagedata', $options))	$options['pagedata'] = ['ousr-idx' => 0];
					else $options['pagedata']['ousr-idx'] = 0;
					goto pageMuserLoad;
				case 'masteruser-edit':
					$get = $this->request->getGet();
					$userid = $get['userid'];
					if ($this->request->getMethod(TRUE) === 'POST') {
						$post = $this->request->getPost();
						if ($post['change-password'] == 0) $options['saveresult'] = $this->saveUser($post);
						else {
							$npswd = $post['npassword'];
							$cpswd = $post['cpassword'];
							
							$saveResult = NULL;
							if ($npswd === $cpswd) $saveResult = $this->saveUser($post);
							else {
								$saveResult = [];
							}
							$options['saveresult'] = $saveResult;
						}
					} else {
						$dataoptions = [
							'data-trigger'	=> 'user-retrieve',
							'data-transmit'	=> [
								'data-loggedousr'	=> $userid
							]
						];
						$userRequest = $this->dataRequest($dataoptions);
						$options['pagedata'] = $userRequest;
					}
					$options['pagedata']['ousr-idx'] = $userid;
					
					pageMuserLoad:
					if (array_key_exists('saveresult', $options) && array_key_exists('returnCode', $options['saveresult'])
							&& $options['saveresult']['returnCode'] == 200) 
						return $this->response->redirect(base_url($this->locale . '/dashboard/users'));
					
					$dataoptions = [
						'data-trigger' => 'userform-data'
					];
					$formdataresult = $this->dataRequest($dataoptions);
					if (count ($options['pagedata']) == 0) $options['pagedata'] = $formdataresult;
					else 
						foreach ($formdataresult as $key => $value) 
							$options['pagedata'][$key] = $value;
					$pageName = 'dashboard/users/form';
					
					break;
				case 'user-profile':
					$options['pagedata'] = [];
					$pageName = 'dashboard/users/profile';
					break;
				case 'groups':
					$dataoptions = [
						'data-trigger'	=> 'mgroup-retrieve'
					];
					
					$result = $this->dataRequest($dataoptions);
					
					$options['pagedata'] = $result;
					$pageName = 'dashboard/users/groups/main';
					break;
				case 'usergroups-formnew':
				case 'usergroups-editgroup':
					$dataoptions = [
						'data-trigger'	=> ''
					];
					$result = $this->dataRequest($dataoptions);
					$options['pagedata'] = [];
					$pageName = 'dashboard/users/groups/form';
					break;
				case 'doc-assetreq':
					$dataoptions = [
						'data-trigger'	=> 'movereq-documents',
						'data-transmit'	=> [
							'data-loggedousr'	=> $loggedOusr
						]
					];
					$result = $this->dataRequest($dataoptions);
					
					$options['pagedata'] = $result;
					$options['docstat']		= new DocumentStatus($result['docStats']);
					$pageName = 'dashboard/assets/request';
					break;
				case 'doc-assetin':
					$dataoptions = [
						'data-trigger'	=> 'user-retrieve',
						'data-transmit'	=> [
							'data-loggedousr'	=> $loggedOusr
						]
					];
					$result = $this->dataRequest($dataoptions);
					$ousr = $result['userdata'];
					
					$userLocation = $ousr->olct_idx;
					$username = $ousr->username;
					
					$dataoptions = [
						'data-trigger'	=> 'movein-documents',
						'data-transmit'	=> [
							'data-loggedousr' => $loggedOusr
						]
					];
					$result = $this->dataRequest($dataoptions);
					$receivedCount = 0;
					foreach ($result['mvisList'] as $mvis) if ($mvis->status == 4) $receivedCount++;
					$options['pagedata'] = [
						'data-locations'	=> $result['locations'],
						'data-sublocations'	=> $result['sublocations'],
						'data-userlocation'	=> $result['ousrlocation'],
						'mvin-summary'		=> $result['mvisSum'],
						'mvin-th'			=> ['{8}', '{9}', '{10}', '{11}', '{12}', '{13}'],
						'mvin-lists'		=> $result['mvisList'],
						'mvin-details'		=> $result['mvisDetails'],
						'mvin-received'		=> $receivedCount
					];
					$options['docstat'] = new DocumentStatus($result['docStats']);
					
					$pageName = 'dashboard/assets/move-in';
					break;
				case 'doc-assetout':
					$dataoptions = [
						'data-trigger' => 'user-retrieve',
						'data-transmit' => [
							'data-loggedousr' => $loggedOusr
						]
					];
					
					$result = $this->dataRequest($dataoptions);
					$ousr = $result['userdata'];
					$userLocation = $ousr->olct_idx;
					$username = $ousr->username;
					
					$dataoptions = [
						'data-trigger' => 'moveout-documents',
						'data-transmit' => [
							'data-loggedousr' => $loggedOusr
						]
					];
					$result = $this->dataRequest($dataoptions);	
					
					$options['pagedata'] = [
						'data-locations'	=> $result['locations'],
						'omvoths'			=> $result['mvosHead'],
						'useridx'			=> $loggedOusr,
						'username'			=> $username,
						'user-location'		=> $userLocation,
						'mvout-th'			=> ['#', 'Kode', 'Nama Aset', 'Sublokasi Awal', 'Qty', 'Hapus'],
						'mvout-summary'		=> $result['mvosSumm'],
						'mvout-lists'		=> $result['mvosList']
					];
					$options['docstat'] = new DocumentStatus($result['docStats']);
					$pageName = 'dashboard/assets/move-out';
					break;
				case 'doc-removal':
					$pageName = 'dashboard/assets/destroy-request';
					break;
				case 'file-manager':
					$pageName = 'dashboard/filemanager';
					break;
				case 'about':
					$pageName = 'dashboard/about';
					break;
				case 'test1':
				case 'test2':
					$pageName = 'dashboard/main';
				case 'logout':
					return $this->response->redirect(base_url($this->locale . '/assets/do-logout'), 'GET');
			}
			
			if ($render) return view($pageName, $options);
			else {
				$this->response->setJSON([
					'status' 	=> 404,
					'message'	=> 'Page not found!'
				]);
				$this->response->setHeader('Content-Type', 'application/json');
				$this->response->send();
			}
		}
	}
}