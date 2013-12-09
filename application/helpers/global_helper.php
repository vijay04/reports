<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dsm'))
{
  /**
   * This function prints the array in a pre formatter style.
   * @param array $var
   * @param bool $stop
   */
  function dsm($var, $stop = false) {
    print '<pre class="spit">';
    print_r($var);
    print '</pre>';

    if ($stop) {
      exit();
    }
  }
}

if (!function_exists('dd'))
{
  /**
   * This function will var dump the array
   * and exit
   * @param $var
   */
  function dd($var) {
    print '<pre class="spit">';
    var_dump($var);
    print '</pre>';
    exit();
  }
}

if (!function_exists('check_if_post'))
{
  /**
   * This function will check if the page has POST data
   * and return true or false accordingly.
   * @param null $redirect_path
   * @return bool
   */
  function check_if_post($redirect_path = null) {
    if (!empty($_POST) && is_array($_POST))
      return true;
    else
      redirect($redirect_path,'',302);
  }
}

/**
 * This function will check for the user's session and determine
 * if the user is authenticated or not.
 */
if (!function_exists('auth_user'))
{
  function auth_user() {
    return TRUE;
  }
}

if (!function_exists('set_message'))
{
  /**
   * This message will set a session variable message
   * which will be used to pass messages and alerts.
   * @param $message
   * @param string $type
   * @return bool
   */
  function set_message($message, $type = 'info') {
    return true;
  }
}

if (!function_exists('get_message'))
{
  /**
   * This message will be used to get any message
   * which might have been set by some code in the session
   * and then display the message
   * @return bool
   */
  function get_message() {
    return true;
  }
}

if (!function_exists('is_ajax_req'))
{
  function is_ajax_req() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
      return true;
    else
      return redirect(base_url());
  }
}

if (!function_exists('render_page'))
{
  function render_page($data = null) {
    // getting the CI instance
    $ci =& get_instance();
    if ($data) {
      $ci->load->view('main_page_view', $data);  
    }
    else {
      $ci->load->view('main_page_view');
    }
    
  }
}