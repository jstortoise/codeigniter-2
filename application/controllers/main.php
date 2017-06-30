<?php
/**
 * @author panacea-soft
 */
class Main extends CI_Controller
{
	function __construct($module_name = null)
	{
		parent::__construct();
	}

	function check_access($action_id = null)
	{
		//If user has no permission,kick off.
		if (!$this->user->is_logged_in()) {
			$this->session->set_flashdata('error','You must login for this page.<br>Please click SignUp to create your account.');
			redirect(site_url('login'));
		}
		return true;
	}

	function load_template($content)
	{
		$data['content'] = $content;
		$this->load->view("templates/index", $data);
	}
}
?>
