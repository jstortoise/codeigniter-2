<?php
class User extends Base_Model
{
	protected $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = "cd_appusers";
	}

	/**
	 * exists return true if the user_id is already existed
	 * in the users table
	 *
	 * @param array user_data
	 * @return bool
	 */
	function exists($user_data)
	{
		$this->db->from($this->table_name);

		if (isset($user_data['user_id'])) {
			$this->db->where('id',$user_data['user_id']);
		}

		if (isset($user_data['user_name'])) {
			$this->db->where('username',$user_data['user_name']);
		}

		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	/**
	 * Save function creates/updates the user data to users table.
	 * If the user_id is already exist in the users table,update user data
	 * else, the function will create new data row
	 *
	 * @param ref array $user_data
	 * @param int $user_id
	 * @return bool
	 */
	function save(&$user_data, $user_id=false)
	{
		$this->db->trans_start();
		$success = false;
		//if there is no data with this id, create new
		if (!$user_id && !$this->exists(array('id'=>$user_id))) {
			if ($this->db->insert($this->table_name, $user_data)) {
				$user_data['id']= $user_id = $this->db->insert_id();
				$success = true;
			}
		} else {
			//else update the data
			$this->db->where('id', $user_id);
			$success = $this->db->update($this->table_name, $user_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function update_profile($user_data, $user_id)
	{
		$this->db->where('id', $user_id);
		$success = $this->db->update($this->table_name, $user_data);

		return $success;
	}

	/**
	 * get_all function returns the array of user object
	 *
	 * @param int $limit
	 * @param int $offset
	 * @return user object array
	 */
	function get_all($limit=false, $offset=false)
	{
		$this->db->from($this->table_name);
		$this->db->where('status',1);

		if ($limit) {
			$this->db->limit($limit);
		}

		if ($offset) {
			$this->db->offset($offset);
		}

		$this->db->order_by('added','desc');
		return $this->db->get();
	}

	/**
	 * get_info return the user object according to the user_id
	 *
	 * @param int user_id
	 * @return user object
	 */
	function get_info($user_id)
	{
		$query = $this->db->get_where($this->table_name,array('id'=>$user_id));

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return $this->get_empty_object($this->table_name);
		}
	}

	/**
	 * get_info return the user object according to the user_id
	 *
	 * @param int user_id
	 * @return user object
	 */
	function get_info_by_email($email)
	{
		$query = $this->db->get_where($this->table_name, array('user_email'=>$email));

		if ($query->num_rows()==1) {
			return $query->row();
		} else {
			return $this->get_empty_object($this->table_name);
		}
	}

	/**
	 * Login function check the user and set session.
	 *
	 * @param string user_name
	 * @param string user_password
	 * @return bool
	 */
	function login($username, $password)
	{
		$query = $this->db->get_where($this->table_name, array('username'=>$username, 'password'=>md5($password), 'status'=>1), 1);

		if ($query->num_rows() == 1) {
			$row = $query->row();
			$this->session->set_userdata('user_id', $row->id);
			return true;
		}
		return false;
	}

	/**
	 * Log Out a user by destroying all session dta and redirect to login
	 *
	 */
	function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('/'));
	}

	/**
	 * is_logged_in determines if a employee is logged in
	 */
	function is_logged_in()
	{
		return $this->session->userdata('user_id')!=false;
	}

	/**
	 * Gets information about the currently logged in user.
	 *
	 * @return bool
	 */
	function get_logged_in_user_info()
	{
		if ($this->is_logged_in()) {
			return $this->get_info($this->session->userdata('user_id'));
		}
		return false;
	}
}
?>
