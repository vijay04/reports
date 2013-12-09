<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login');
		}
  }

  function index() {
  	$this->carabiner->js('angular.min.js');
    $this->carabiner->js('sites.js');
  	$this->load->model('sites_model');
  	$data['header']['page_title'] = 'Sites'; // title for the page
    $data['content']['view_name'] = 'sites_view'; // name of the partial view to load

    $data['content']['view_data'] = $this->sites_model->get(); // data coming inside the view
  	render_page($data);
  }
  
  function listing() {
  	$this->load->view('sites_list');
  }
  
  function getjson($sid=NULL) {
    $this->load->model('sites_model');
    if($sid) {
      $output = $this->sites_model->get($sid);
    }
    else {
    $output = $this->sites_model->get();
    }
    $jsonOutput = json_encode($output);
    echo $jsonOutput;
  }
  
  function add() {
    $this->load->view('sites_add_form');
  }
  
  function savejson() {
    $this->load->model('sites_model');
    if (isset($_POST['id'])) {
      $sid = $this->sites_model->save($_POST, $_POST['id']);
    }
    else {
      $sid = $this->sites_model->save($_POST);
    }
    $output = $this->sites_model->get($sid);
    $jsonOutput = json_encode($output);
    echo $jsonOutput;
  }
  
  function delete() {
    $this->load->model('sites_model');
    if (isset($_POST['id'])) {
      $this->sites_model->delete($_POST['id']);
    }
  }

  function view() {
    $this->load->view('single_site_view');
  }

  function history() {
    $this->load->view('single_site_history_view');
  }

  function viewjson() {
    $this->load->model('sites_model');

    $site_data = $this->sites_model->get($_POST['site_id']);
    $output =  array(
      'site_id' => $_POST['site_id'],
      'path' => $site_data['path'], 
      'sitename' => $site_data['sitename'], 
      'email' => $site_data['email'],
    ); 
      
    $this->sites_model->table_name = 'reports';
    $old_site_data_reports = $this->sites_model->get_by('site_id' , $_POST['site_id'], false, true);
    $output['total_time'] = $old_site_data_reports['total_time'];
    $output['connect_time'] = $old_site_data_reports['connect_time']; 
    $output['created'] = date('d-m-Y h:i:s A', $old_site_data_reports['created']);
    echo json_encode($output);
  }

  function historyjson() {
    $this->load->model('sites_model');
    $this->sites_model->table_name = 'reports';

    $site_data = $this->sites_model->get_by(array('site_id' => $_POST['site_id']));
   
    $this->sites_model->table_name = 'reports';
    $old_site_data_reports = $this->sites_model->get_by('site_id' , $_POST['site_id']);
    echo json_encode($old_site_data_reports);
    
  }
}