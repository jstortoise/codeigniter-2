<?php
require_once('main.php');

class Home extends Main
{
  function __construct()
	{
		parent::__construct();
	}
  public function index()
  {
		$cities = array();

		$cities = $this->city->get_all_by(array(
			'is_approved' => APPROVE
		))->result();

		$temp_cities_arr = array();
		foreach ($cities as $city) {
			$img = $this->image->get_all_by_type($city->id, 'city')->result();

			if ( count( $img ) > 0 ) {
				$city->image = $img[0]->path;
			} else {
				$city->image = "";
			}
			$temp_cities_arr[] = $city;
		}
		$data['cities'] = $temp_cities_arr;
    $content['content'] = $this->load->view('home/index', $data, true);
		$this->load_template($content);
  }

  function city($city_id = 0) {
    $city = $this->city->get_info($city_id);
    $img = $this->image->get_all_by_type($city->id, 'city')->result();
    if (count($img) > 0) {
      $city->image = $img[0]->path;
    } else {
      $city->image = "";
    }
		$categories = $this->category->get_all($city->id)->result();

		//categories
		$temp_cate_arr = array();
		foreach ($categories as $category) {
			//images
			$img = $this->image->get_all_by_type($category->id, 'category')->result();
			if ( count( $img ) > 0 ) {
				$category->image = $img[0]->path;
			} else {
				$category->image = "";
			}

			$temp_cate_arr[] = $category;
		}

		$city->categories = $temp_cate_arr;
    $data['city'] = $city;
    $content['content'] = $this->load->view('home/city', $data, true);
    $this->load_template($content);
  }

  function category($category_id = 0) {
    //items
    $items = $this->item->get_all_by_cat($category_id)->result();
    $temp_items_arr = array();
    foreach ($items as $item) {
      $image = $this->image->get_all_by_type($item->id, 'item')->result();

      if ( count( $image ) > 0 ) {
        $item->image = $image[0]->path;
      } else {
        $item->image = "";
      }
      $temp_items_arr[] = $item;
    }

    $data['category_id'] = $category_id;
    $data['items'] = $temp_items_arr;
    $content['content'] = $this->load->view('home/items', $data, true);
    $this->load_template($content);
  }

  function feeds($city_id = 0) {
    $feeds = $this->feed->get_all($city_id)->result();

		//categories
		$temp_feed_arr = array();
		foreach ($feeds as $feed) {
			//images
			$img = $this->image->get_all_by_type($feed->id, 'feed')->result();
			if ( count( $img ) > 0 ) {
				$feed->image = $img[0]->path;
			} else {
				$feed->image = "";
			}

			$temp_feed_arr[] = $feed;
		}

    $data['city_id'] = $city_id;
    $data['feeds'] = $temp_feed_arr;
    $content['content'] = $this->load->view('home/newsfeeds', $data, true);
    $this->load_template($content);
  }
  function login()
	{
		if ( $this->user->is_logged_in() ) {
			redirect(site_url());
		} else {
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$user_name = $this->input->post('user_name');
				$user_password = $this->input->post('user_pass');

				if ( $this->user->login($user_name, $user_password )) {
					redirect(site_url());
				} else {
					$this->session->set_flashdata('error','Username and password do not match.');
					redirect(site_url('login'));
				}
			} else {
				$this->load->view('login');
			}
		}
	}

  function logout()
	{
		$this->user->logout();
	}

	function signup()
	{
    $status = "";
		$message = "";
		if ($this->input->server('REQUEST_METHOD')=='POST') {

			$user_data = array(
				'username' => $this->input->post('user_name'),
				'email' => $this->input->post('user_email'),
				'password'=> md5($this->input->post('user_password')),
				'status'=> 0
			);

			if ($this->user->save($user_data)) {
        $status = 'success';
				$message = 'User is successfully created.';
				$this->session->set_flashdata('success','User is successfully added.');
			} else {
        $status = 'error';
				$message = 'Database error occured.Please contact your system administrator.';
				$this->session->set_flashdata('error','Database error occured.Please contact your system administrator.');
			}
			redirect(site_url('login'));
		}

    $data['status'] = $status;
		$data['message'] = $message;
		$content['content'] = $this->load->view('account/signup', $data, true);

		$this->load_template($content);
	}

  //is exist
	function exists($user_id=null)
	{
		$user_name = $_REQUEST['user_name'];

		if (strtolower($this->user->get_info($user_id)->user_name) == strtolower($user_name)) {
			echo "true";
		} else if($this->user->exists(array('user_name'=>$_REQUEST['user_name']))) {
			echo "false";
		} else {
			echo "true";
		}
	}

	function reset($code = false)
	{
		if (!$code || !$this->code->exists(array('code'=>$code))) {
			redirect(site_url('login'));
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$code = $this->code->get_by_code($code);
			if ($code->is_systemuser == 1) {
				$data = array(
					'user_pass' => md5($this->input->post('password'))
				);
				if ($this->user->update_profile($data,$code->user_id)) {
					$this->code->delete($code->user_id);
					$this->session->set_flashdata('success','Password is successfully reset.');
					redirect(site_url('login'));
				}
			} else {
				$data = array(
					'password' => md5($this->input->post('password'))
				);
				if ($this->appuser->save($data,$code->user_id)) {
					$this->code->delete($code->user_id);
					$this->session->set_flashdata('success','Password is successfully reset.');
					redirect(site_url('login'));
				}
			}
		}

		$data['code'] = $code;
		$this->load->view('reset/reset',$data);
	}

	function forgot()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $this->input->post('user_email');
			$user = $this->user->get_info_by_email($email);

			if ($user->user_id == "") {
				$this->session->set_flashdata('error','Email does not exist in the system.');
			} else {
				$code = md5(time().'teamps');
				$data = array(
          'user_id'=>$user->user_id,
          'code'=> $code,
          'is_systemuser'=>1
        );
				if ($this->code->save($data,$user->user_id)) {
					$sender_email = $this->config->item('sender_email');
					$sender_name = $this->config->item('sender_name');
					$to = $user->user_email;
				   $subject = 'Password Reset';
					$html = "<p>Hi,".$user->user_name."</p>".
								"<p>Please click the following link to reset your password<br/>".
								"<a href='".site_url('reset/'.$code)."'>Reset Password</a></p>".
								"<p>Best Regards,<br/>".$sender_name."</p>";

					$this->email->from($sender_email,$sender_name);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($html);
					$this->email->send();

					$this->session->set_flashdata('success','Password reset email already sent!');
					redirect(site_url('login'));
				} else {
					$this->session->set_flashdata('error','System error occured. Please contact your system administrator.');
				}
			}
		}

		$this->load->view('reset/forgot');
	}
}
