<?php
/**
 * A controller helping with debugging output, useful during development.
 * 
 * @package MedesCore
 */
class CControllerDeveloper implements IController {

	/**
	 * A reference to current CPrinceOfPersia
   * @var CPrinceOfPersia
   */
	private $pp;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->pp = CPrinceOfPersia::GetInstance();
		$pp = &$this->pp;
		
		$header = '<h1>Developer information</h2><p>Here is useful information for a developer, and maybe e menu (bar) of the options.</p>';

		$nav = array(
			array(
				'text'=>'Configuration',
				'url'=>$pp->req->CreateUrlToControllerAction(null, 'config'),
			),
			array(
				'text'=>'Request',
				'url'=>$pp->req->CreateUrlToControllerAction(null, 'request'),
			),
			array(
				'text'=>'$_SERVER',
				'url'=>$pp->req->CreateUrlToControllerAction(null, 'server'),
			),
		);
		$header .= CNavigation::GenerateMenu($nav, $pp->pageUseListForMenus, 'mds-nav-developer', 'mds-nav-tabs');	

		$v = new CView();
		$v->AddStatic($header);
		$pp->AddView($v, -1);
	}
	
	
	/**
 	 * Implementing interface IController. All controllers must have an index action.
	 */
	public function Index() {	
	}


	/**
 	 * Action to print out the $pp cfg (configuration).
	 */
	public function Config() {	
		$pp = &$this->pp;
		$pp->AddView(new CView(array('html'=>'<h2>$pp->cfg</h2><pre>' . print_r($pp->cfg, true) . '</pre>')));
	}


	/**
 	 * Action to print out the request object.
	 */
	public function Request() {	
		$pp = &$this->pp;
		$pp->AddView(new CView(array('html'=>'<h2>$pp->req</h2><pre>' . print_r($pp->req, true) . '</pre>')));
	}


	/**
 	 * Action to print out $_SERVER.
	 */
	public function Server() {	
		$pp = &$this->pp;
		$pp->AddView(new CView(array('html'=>'<h2>$_SERVER[]</h2><pre>' . print_r($_SERVER, true) . '</pre>')));
	}


} // End of class
