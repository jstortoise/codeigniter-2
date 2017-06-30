<?php
require_once('main.php');

class Items extends Main
{
	function __construct()
	{
		parent::__construct('items');
	}

	function index($item_id = 0)
	{
		$this->check_access();
		$item = $this->item->get_info($item_id);

		$img = $this->image->get_all_by_type($item->id, 'item')->result();
		if (count($img) > 0) {
			$item->image = $img[0]->path;
		} else {
			$item->image = "";
		}

		$item->likes_count = $this->like->count_all(0, $item_id);
		$item->reviews_count = $this->review->count_all(0, $item_id);

		$item->reviews = $this->review->get_all_by_item_id($item_id)->result();

		$data['item'] = $item;
		$content['content'] = $this->load->view('items/index', $data, true);

		$this->load_template($content);
	}

	function search()
	{
		$this->session->unset_userdata('keyword');
		$this->session->unset_userdata('sel_city_id');
		$search_arr = array(
			"sel_city_id" => $this->input->post('sel_city_id'),
			"keyword" => $this->input->post('keyword')
		);

		$search_term = $this->searchterm_handler($search_arr);
		$data = $search_term;

		$items = $this->item->get_all_by($search_term['sel_city_id'], $search_term)->result();
		$temp_items_arr = array();
		foreach ($items as $item) {
			$img = $this->image->get_all_by_type($item->id, 'item')->result();

			if (count($img) > 0) {
				$item->image = $img[0]->path;
			} else {
				$item->image = "";
			}
			$temp_items_arr[] = $item;
		}
		$data['items'] = $temp_items_arr;

		$content['content'] = $this->load->view('items/search', $data, true);

		$this->load_template($content);
	}

	function searchterm_handler($searchterms = array())
	{
		$data = array();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			foreach ($searchterms as $name=>$term) {
				if ($term && trim($term) != " ") {
					$this->session->set_userdata($name,$term);
					$data[$name] = $term;
				} else {
					$this->session->unset_userdata($term);
					$data[$name] = "";
				}
			}
		} else {
			foreach ($searchterms as $name=>$term) {
				if ($this->session->userdata($name)) {
					$data[$name] = $this->session->userdata($name);
				} else {
					$data[$name] = "";
				}
			}
		}

		return $data;
	}

	function like($item_id = 0) {
		$city_id = $this->item->get_info($item_id)->city_id;
		$user_id = $this->user->get_logged_in_user_info()->id;
		$data = array('item_id' => $item_id, 'appuser_id' => $user_id, 'city_id' => $city_id);
		if ($this->like->count_all($city_id, $item_id, $user_id) > 0) {
			echo 0;
		} else {
			$this->like->insert($data);
			echo $this->like->count_all($city_id, $item_id);
		}
	}

	function favorite($item_id = 0) {
		$city_id = $this->item->get_info($item_id)->city_id;
		$user_id = $this->user->get_logged_in_user_info()->id;
		$data = array('item_id' => $item_id, 'appuser_id' => $user_id, 'city_id' => $city_id);
		if (!$this->favourite->exists($data)) {
			if ($this->favourite->save($data)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}

	function addinquiry() {
		$status = "";
		$message = "";

		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$item_id = $this->input->post('item_id');
			$url = $this->input->post('cur_url');
			$data = array(
				'item_id' => $item_id,
				'city_id' => $this->item->get_info($item_id)->city_id,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'message' => $this->input->post('email')
			);

			if ($this->inquiry->save($data)) {
				$status = 'success';
				$message = 'User is successfully updated.';
				redirect($url);
			} else {
				$status = 'error';
				$message = 'Database error occured.Please contact your system administrator.';
			}
		}
		$data['item'] = $this->item->get_info($item_id);
		$data['status'] = $status;
		$data['message'] = $message;
		$content['content'] = $this->load->view('items/index', $data,true);

		$this->load_template($content);
	}

	function addreview() {
		$user_id = $this->user->get_logged_in_user_info()->id;
		$status = "";
		$message = "";

		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$item_id = $this->input->post('item_id');
			$url = $this->input->post('cur_url');
			$data = array(
				'item_id' => $item_id,
				'appuser_id' => $user_id,
				'city_id' => $this->item->get_info($item_id)->city_id,
				'review' => $this->input->post('review')
			);

			if ($this->review->save($data)) {
				$status = 'success';
				$message = 'User is successfully updated.';
				redirect($url);
			} else {
				$status = 'error';
				$message = 'Database error occured.Please contact your system administrator.';
			}
		}
		$data['item'] = $this->item->get_info($item_id);
		$data['status'] = $status;
		$data['message'] = $message;
		$content['content'] = $this->load->view('items/index', $data,true);

		$this->load_template($content);
	}
}
?>
