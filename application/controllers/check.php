<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

  public function __construct() {
    parent::__construct();
    //auth_user();
  }

  function index() {
  	$sites = array(
  		'http://www.deccanchronicle.com/index.php',
  		'http://www.khelnama.com/index.php',
  	);

		foreach ($sites as $value) {
	  	file_get_contents($value);
			switch ($http_response_header[0]) {
				case 'HTTP/1.1 200 OK':
					$this->load->library('email');

					$this->email->from('vijay.mayekar@focalworks.in', 'Vijay');
					$this->email->to('amitav.roy@focalworks.in'); 

					$this->email->subject('Site report for ' . $value . ' at ' . date('jS F g:i A', time()));
					$this->email->message('Site report for ' . $value . ' at ' . date('jS F g:i A', time()));	

					$this->email->send();
					break;
				
				default:
					# code...
					break;
			}
		}
  }


}