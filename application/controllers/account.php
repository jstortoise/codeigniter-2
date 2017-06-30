<?php
require_once('main.php');
class Account extends Main
{
	function __construct()
	{
		parent::__construct('account');
		$this->check_access();
	}

	function profile()
	{
		$user_id = $this->user->get_logged_in_user_info()->id;
		$status = "";
		$message = "";

		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$user_data = array(
				'username' => $this->input->post('user_name'),
				'about_me' => $this->input->post('about_me'),
				'email' => $this->input->post('user_email')
			);

			//If new user password exists,change password
			if ($this->input->post('user_password')!='') {
				$user_data['password'] = md5($this->input->post('user_password'));
			}

			if ($this->user->update_profile($user_data, $user_id)) {
				$status = 'success';
				$message = 'User is successfully updated.';
			} else {
				$status = 'error';
				$message = 'Database error occured.Please contact your system administrator.';
			}
		}

		$data['user'] = $this->user->get_info($user_id);
		$data['status'] = $status;
		$data['message'] = $message;

		$content['content'] = $this->load->view('account/profile',$data,true);

		$this->load_template($content);
	}

	//is exist
	function exists($user_id=null)
	{
		$user_name = $_REQUEST['user_name'];

		if (strtolower($this->user->get_info($user_id)->username) == strtolower($user_name)) {
			echo "true";
		} else if($this->user->exists(array('user_name'=>$_REQUEST['user_name']))) {
			echo "false";
		} else {
			echo "true";
		}
	}
}
?>
