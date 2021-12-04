<?php
namespace App\Controllers;
require_once APPPATH . 'ThirdParty/vendor/dompdf/autoload.inc.php';

class PortableDocumentController extends BaseController {
	
	private function getResources () {
		return [
			'styles'	=> [
				'assets/vendors/fonts/fondamento/stylesheet.css',
				'assets/vendors/bootstrap/css/bootstrap.css',
				'assets/vendors/fontawesome/css/all.css'
			]
		];
	}
	
	protected function additionalInitialization() {
		$this->helpers	= ['cookie', 'url'];
	}
	
// 	public function loadPortableDocument () {
// 		$method = $this->request->getMethod(TRUE);
// 		if ($method !== 'POST') return $this->response->redirect(base_url($this->locale . '/dashboard'), 'GET');
// 		else {
// 			$post		= $this->request->getPost();
// 			if ($post['target'] !== 'print') throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
// 			else {
// 				$docnum = $post['doc-target'];
// 				$data = [
// 					'is_portable'	=> FALSE,
// 					'resources'		=> $this->getResources()
// 				];
// 				return view ('dashboard/portables/test', $data);
// 			}
// 		}
// 	}
	
	public function loadPortableDocument () {
		$method = $this->request->getMethod(TRUE);
		if ($method !== 'POST') ;
		else {
			$doPdf	= FALSE;
			$post	= $this->request->getPost();
			$pageData	= [];
			if ($post['target'] === 'print') {
				$dataOptions = [
					'data-trigger'	=> 'docuportable',
					'data-transmit'	=> [
						'data-documentnumber'	=> $post['doc-target'],
						'data-loggedousr'		=> $this->getLoggedUserID()
					]
				];
				$result	= $this->dataRequest($dataOptions);
				$doPdf	= $result['good'];
			}
			
			if (!$doPdf) return '';
			else {
				$pageData = $result['document'];
				$data = [
					'resources'		=> $this->getResources(),
					'pagedata'		=> $pageData
				];
				
// 				$pdfopt = new \Dompdf\Options ();
// 				$pdfopt->setDpi (72);
				$dompdf = new \Dompdf\Dompdf ();
				$dompdf->loadHtml (view ('dashboard/portables/portable-moveout', $data));
				$dompdf->setPaper ('A4', 'portrait');
// 				$dompdf->setOptions($pdfopt);
				$dompdf->render ();
				$dompdf->stream ('ASMDOC' . $result['document-type'] . '_' . date('Ymd-His') . ".pdf", array("Attachment" => FALSE));
			}
		}
	}
}