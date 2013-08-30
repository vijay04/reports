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
      $info = curl_getinfo($handle);
      $httpCode = $info['http_code'];
      $params = array(
        'site_id' => $value['id'],
        'total_time' => $info['total_time'],
        'connect_time' => $info['connect_time'],
        'created' => strtotime('now'),
      );
      //save information to reports table
      $this->sites_model->table_name = 'reports';
      $this->sites_model->save($params);

      /** TODO **/
      // ADD delete of old data

      $this->sites_model->table_name = 'reports';

      $old_site_data = $this->sites_model->get_by('site_id' , $value['id'], false, true);

      if ($old_site_data['total_time']) {

        //if 30 % increased then send message
        $increase = ($old_site_data['total_time'] + (0.3 * $old_site_data['total_time']));
  
        if ($increase <= $info['total_time']) {
          $this->sendmail('Increase 30% time', $value);
        }

      }

			switch ($httpCode) {
				case 500:
          $this->sendmail($httpCode, $value);
          break;
          
        case 403:
          $this->sendmail($httpCode, $value);
          break;
          
				default:
          if ($httpCode > 499 && $httpCode != 503) {
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
    $this->email->subject('Reporting error ' . $code . ' for site ' . $value['sitename']);
    $this->email->message('Reporting error ' . $code . ' for site ' . $value['sitename'] . ' @ ' . date('jS F g:i A', time()));
    $this->email->send();
  }
  
}