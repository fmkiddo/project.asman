<?php
namespace App\Controllers;

use App\Libraries\DocumentStatus;
use App\Libraries\DocumentType;

class DashboardController extends BaseController {
	
// 	public const USERID = 3;

	private $noneSelectedText	= [
		'id'	=> 'Tidak ada yang dipilih',
		'en'	=> 'Nothing selected'
	];

	private function buildMenuStructures ($menuStructures=[]): string {
		ob_start(); 
		foreach ($menuStructures as $menu): 
			$hasSubs = count ($menu['subs']) > 0; ?>
					<li class="nav-item">
<?php 			if (!$hasSubs): ?>
						<a class="nav-link" onclick="window.location.href='<?php echo $menu['target']; ?>'">
							<i class="<?php echo $menu['icon']; ?>"></i> <span data-headsmarty="<?php echo $menu['smarty']; ?>"></span>
						</a>
<?php 		else: ?>
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#<?php echo $menu['id']; ?>" aria-expanded="false" aria-controls="<?php $menu['id']?>">
							<i class="<?php echo $menu['icon']; ?>"></i> <span data-headsmarty="<?php echo $menu['smarty']; ?>"></span>
						</a>
						<div id="<?php echo $menu['id']; ?>" class="collapse" data-parent="#sidebar-wrapper" aria-labelledby="header-<?php echo $menu['id']; ?>">
							<div class="bg-white py-2 collapse-inner rounded">
<?php			$currSegment = 0;
				foreach ($menu['subs'] as $segment => $sub):
					if ($currSegment != $segment):
						if ($currSegment > 0): ?>
								<hr class="collapse-separator py-1" />
<?php
						endif;
							$currSegment = $segment; ?>
								<h6 class="collapse-header" data-headsmarty="<?php echo $sub['title']; ?>"></h6>
<?php 
					endif;
					foreach ($sub['child'] as $child): ?>
								<a class="collapse-item" onclick="window.location.href='<?php echo $child['target']; ?>'">
									<i class="<?php echo $child['icon']; ?>"></i> <span data-headsmarty="<?php echo $child['smarty']; ?>"></span>
								</a>
<?php 					endforeach;
				endforeach;
?>
							</div>
						</div>
<?php 		
			endif; ?>
					</li>
<?php 		endforeach;
		return ob_get_clean();
	}
	
	private function isUserNotLoggedIn () {
		return get_cookie($this->prefix . CLIENT_USER_COOKIE) == NULL;
	}
	
	private function isConfigCookieNotSet () {
		return (get_cookie($this->prefix . CLIENT_CONFIG_NAME) == NULL);
	}
	
	private function doYouHaveAccess () {
		$haveAccess = TRUE;
		return $haveAccess;
	}
	
	private function saveUser ($param=[]): array {
		$dataTrigger = 'userupdate';
		if ($param['userid'] == 0)
			$dataTransmit	= [
				'userid'	=> $param['userid'],
				'param'		=> [
					'new-username'		=> $param['username'],
					'new-email'		=> $param['email'],
					'new-password'		=> $param['password'],
					'new-usergroup'		=> $param['accesslevel'],
					'new-accesslocation'	=> $param['accesslocation']
				]
			];
		else {
			$dataTransmit	= [
				'userid'	=> $param['userid'],
				'param'		=> [
					'update-email'		=> $param['email'],
					'update-usergroup'	=> $param['accesslevel'],
					'update-accesslocation'	=> $param['accesslocation']
				]
			];
			
			if ($param['change-password'] > 0)
				$dataTransmit['param']['update-password'] = $param['npassword'];
		}
		
		$dataTransmit['data-loggedousr']	= $this->getLoggedUserID();
			
		$dataoptions = [
			'data-trigger'		=> $dataTrigger,
			'data-transmit'		=> $dataTransmit
		];
		return $this->dataRequest($dataoptions);
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
	
	private function renderLocationList ($result): array {
		$locArray = [];
		$dataoptions	= [
			'data-trigger'	=> 'user-retrieve',
			'data-transmit'	=> [
				'data-loggedousr'	=> $this->getLoggedUserID ()
			]
		];
		$users	= $this->dataRequest ($dataoptions)['userdata'];
		if ($users->olct_idx == 0):
			$locations = $result['locations'];
			$idx = 0;
			foreach ($locations as $location) {
				$locArray[$idx] = [
					'id'	=> $location->idx,
					'code'	=> $location->code,
					'name'	=> $location->name
				];
				$idx++;
			}
		else:
			$idx = 0;
			foreach ($locations as $location) {
				if ($location->idx == $users->olct_idx) {
					$locArray[$idx] = [
						'id'	=> $location->idx,
						'code'	=> $location->code,
						'name'	=> $location->name
					];
					break;
				}
				$idx++;
			}
		endif;
		return $locArray;
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
					$dataoptions = [
						'data-trigger'	=> 'dashboard-summary',
						'data-transmit'	=> [
							'data-loggedousr'	=> $this->getLoggedUserID ()
						]
					];
					$result	= $this->dataRequest ($dataoptions);
					$options ['pagedata'] = $result;
					$options ['docstats'] = new DocumentStatus ($result['docStats']);
					$options ['doctypes'] = new DocumentType ($result['docTypes']);
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
					$options['pagedata']		= $result;
					$pageName = 'dashboard/location/main';
					break;
				case 'location-detail':
					$dataTransmit = [
						'data-trigger'	=> 'detailedlocation',
						'data-transmit'	=> [
							'data-locationcode'	=> $this->request->getGet('location-code')
						]
					];
					$result = $this->dataRequest($dataTransmit);
					if (count ($result) == 0) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
					$options['pagedata'] = $result;
					$options['locationheader']	= [
						'{3}', '{4}', '{5}', '{6}', '{7}', '{8}', '{9}'
					];
					$options['assetheader'] = [
						'{24}', '{25}', '{26}', '{27}', '{28}', '{29}', '{30}', 
					];
					$pageName = 'dashboard/location/detail';
					break;
				case 'form-location':
					$options['idx'] = 0;
					$options['before'] = 'location';
					if ($this->request->getMethod(TRUE) === 'POST') {
						$post = $this->request->getPost();
						if (array_key_exists('location', $post)) {
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
						} else {
							$dataoptions = [
								'data-trigger'	=> 'update-locationprofile',
								'data-transmit'	=> [
									'data-loggedousr'	=> $this->getLoggedUserID(),
									'data-form'		=> $post
								]
							];
							$result = $this->dataRequest($dataoptions);
							
						}
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
				case 'asset-service':
					$method = $this->request->getMethod (TRUE);
					$get	= $this->request->getGet ();
					if (!array_key_exists ('service-form', $get) || $get['service-form'] === 'false')
						$pageName	= 'dashboard/service/main';
					else if ($get['service-form'] === 'true') {
						if (array_key_exists ('form-submitted', $get)) {
							$post		= $this->request->getPost ();
						} else {
							$dataoptions	= [
								'data-trigger'	=> 'location'
							];
							$locationResult	= $this->dataRequest ($dataoptions);
							$options['psassets'] = [
								'styles'	=> [
									base_url('assets/vendors/bootstrap/css/bootstrap-select.css')
								],
								'scripts'	=> [
									base_url('assets/vendors/bootstrap/js/bootstrap-select.js')
								]
							];
							$options['pagedata']['datalist-locations']	= $this->renderLocationList ($locationResult);
							$options['pagedata']['noneselected']		= $this->noneSelectedText;
							$pageName	= 'dashboard/service/form';
						}
					} else return $this->response->redirect (base_url ($this->locale . '/dashboard/asset-service?service-form=false'));
					break;
				case 'form-sublocation':
					if ($this->request->getMethod(TRUE) === 'GET') {
						$get = $this->request->getGet();
						$locationCode = $get['location-code'];
						$sublocationCode = $get['sublocation-code'];
						$dataoptions = [
							'data-trigger'	=> 'load-sublocation',
							'data-transmit'	=> [
								'data-locationcode'		=> $locationCode,
								'data-sublocationcode'	=> ($sublocationCode === 'new') ? 0 : $sublocationCode
							]
						];
						$result = $this->dataRequest($dataoptions);
						if (count ($result) == 0) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
						
						$options['pagedata']	= $result;
						$options['referal']		= $this->request->getHeader ('Referer')->getValue ();
					}
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
							else $saveResult = [];
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
					$dataoptions = [
						'data-trigger'	=> 'userprofile',
						'data-transmit'	=> [
							'data-loggedousr'	=> $this->getLoggedUserID()
						]
					];
					$serverResponse = $this->dataRequest($dataoptions);
					$options['pagedata'] = [
						'profile'	=> $serverResponse['data-profile']
					];
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
					
					$options['pagedata'] 			= $result;
					$options['pagedata']['requisition']	= (array_key_exists ('requisition', $this->request->getGet ())) ? 1 : 0;
					$options['docstat']			= new DocumentStatus($result['docStats']);
					$options['doctype']			= new DocumentType($result['docTypes']);
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
						'omvoths'		=> $result['mvosHead'],
						'useridx'		=> $loggedOusr,
						'username'		=> $username,
						'user-location'		=> $userLocation,
						'mvout-th'		=> ['{8}', '{23}', '{24}', '{25}', '{26}', '{27}'],
						'mvout-summary'		=> $result['mvosSumm'],
						'mvout-lists'		=> $result['mvosList']
					];
					
					$options['docstat'] = new DocumentStatus($result['docStats']);
					$pageName = 'dashboard/assets/move-out';
					break;
				case 'doc-assetremoval':
					$dataoptions = [
						'data-trigger'	=> 'removal-documents',
						'data-transmit'	=> [
							'data-loggedousr'	=> $loggedOusr
						]
					];
					$result = $this->dataRequest($dataoptions);
					$options['pagedata'] =	[
						'data-removaldocs'	=> $result['pendingDocs'],
						'data-summaries'	=> $result['arvSummaries'],
						'data-removals'		=> $result['removaldocs']
					];
					$options['docstat']	= new DocumentStatus($result['docStats']);
					$pageName = 'dashboard/assets/removal';
					break;
				case 'doc-assetproc':
					$dataOptions	= [
						'data-trigger'	=> 'procure-summaries',
						'data-transmit'	=> [
							'data-loggedousr'	=> $loggedOusr,
							'data-locale'		=> $this->locale
						]
					];
					
					$result	= $this->dataRequest ($dataOptions);
					$options['pagedata']['req-summaries'] 	= $result['summaries'];
					$options['pagedata']['req-list']	= $result['requestlist'];
					$options['pagedata']['req-summstyle'] 	= $result['styles'];
					$options['pagedata']['req-titlecode']	= $result['titles'];
					$pageName = 'dashboard/assets/procurement';
					break;
				case 'file-manager':
					$dataoptions	= [
						'data-trigger'	=> 'load-assetimages',
						'data-transmit'	=> [
							'data-loggedousr'	=> $loggedOusr
						]
					];
					$result	= $this->dataRequest ($dataoptions);
					$imageList	= array ();
					$index = 0;
					foreach ($result['data-imagelist'] as $image) {
						$imageList[$index]	= [
							'filename'	=> $image['name'],
							'filesize'	=> round (($image['size'] / 1024), 2) . " KB",
							'filetype'	=> $image['mime'],
							'date_created'	=> date ('d-m-Y H:i:s', $image['lastc']),
							'filecontents'	=> $image['content']
						];
						$index++;
					}
					
					$options['pagedata']	= [
						'data-userstat'	=> $result['data-userstat'],
						'data-images'	=> $imageList
					];
					$pageName = 'dashboard/filemanager';
					break;
				case 'user-settings':
					$pageName = 'dashboard/user-settings';
					break;
					break;
				case 'system-settings':
					$pageName = 'dashboard/syssettings/main';
					break;
				case 'about':
					$pageName = 'dashboard/about';
					break;
				case 'test1':
				case 'test2':
					$pageName = 'dashboard/main';
					break;
				case 'logout':
					return $this->response->redirect(base_url($this->locale . '/assets/do-logout'), 'GET');
			}
			
			$headOptions = [
				'data-trigger'	=> 'headdata',
				'data-transmit'	=> [
					'data-loggedousr'	=> $this->getLoggedUserID()
				]
			];
			
			$headResponse = $this->dataRequest($headOptions);
			if ($headResponse !== NULL) {
				$options['logger']	= $headResponse['data-logger'];
				$options['loggerType']	= $headResponse['data-loggertype'];
				$options['menus']	= $this->buildMenuStructures($headResponse['data-menustructure']);
				$options['messages']	= $headResponse['data-messages'];
				$options['notifs']	= $headResponse['data-notifications'];
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
