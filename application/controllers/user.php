<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  // everyone will be redirected to profile.
  public function index() {
    redirect('user/profile');
  }

  // user profile page
  public function profile() {
    auth_user();
    $data['content']['view_name'] = 'user/profile_view';
    $data['content']['view_data'] = array(1,2,3);
    render_page($data);
  }

  // login form
  public function login() {
    $data['content']['view_name'] = 'user/login_view';
    $data['content']['view_data'] = array(1,2,3);
    render_page($data);
  }

  // post login
  public function dologin() {
    if ($_POST && is_array($_POST)) {
      $this->load->model('users/user_model', 'user');

      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $auth = $this->user->validate_login($username, $password);

      if ($auth) {
        redirect('timesheet');
      } else {
        redirect('user/login');
      }

    } else {
      redirect('user/login');
    }
  }

  // logout the user, destory session
  public function logout() {
    $this->session->sess_destroy();
    redirect('user/login');
  }
}