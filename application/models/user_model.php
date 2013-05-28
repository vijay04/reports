<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

  private $table_name = 'users';

  public function __construct() {
    parent::__construct();
  }

  public function validate_login($username, $password) {
    $hash_pass = hash('sha512', $password);

    $this->db->select();
    $this->db->from($this->table_name);
    $this->db->where('email', $username);
    $this->db->where('password', $hash_pass);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $result = $query->result_array();
      $result = $result[0];
      $this->set_user($result);
      $data = $this->session->all_userdata();
      return true;
    }
    else {
      redirect('users/login');
    }
  }

  // setting the session for the user
  protected function set_user($data) {
    $sesion_data = array(
      'auth' => true,
      'uid' => $data['uid'],
      'email' => $data['email'],
      'display_name' => $data['display_name']
    );

    $this->session->set_userdata($sesion_data);
  }
}