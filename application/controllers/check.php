<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

  public function __construct() {
    parent::__construct();
    //auth_user();
  }

  function index() {
  	$this->load->model('sites_model');
  	$sites = $this->sites_model->get();
		foreach ($sites as $key => $value) {
      $handle = curl_init($value['path']);
      curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($handle);
      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

			switch ($httpCode) {
				case 500:
          $this->sendmail($httpCode, $value);
          break;
          
        case 403:
        $this->sendmail($httpCode, $value);
        break;
          
				default:
          if ($httpCode > 499) {
            $this->sendmail($httpCode, $value);
          }
					break;
			}
		}
  }
  
  private function sendmail($code, $value) {
    $this->load->library('email');
    $this->email->from('vijay.mayekar@focalworks.in', 'Vijay');
    $this->email->to($value['email']);
    $this->email->subject('Reporting error' . $code . 'for site ' . $value['sitename'] . ' @ ' . date('jS F g:i A', time()));
    $this->email->message('Reporting error' . $code . 'for site ' . $value['sitename'] . ' @ ' . date('jS F g:i A', time()));
    $this->email->send();
  }
  
}