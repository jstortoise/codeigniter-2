<?php
require_once('main.php');

class Favourites extends Main
{
	function __construct()
	{
		parent::__construct('favourites');
		$this->check_access();
	}

	function index()
	{
		$pag['base_url'] = site_url('favourites/index');
		$favorites = $this->favourite->get_by_user_id($this->session->userdata('user_id'))->result();

		$temp_fav_arr = array();
		foreach ($favorites as $fav) {
			$item = $this->item->get_info($fav->item_id);
			$img = $this->image->get_all_by_type($fav->item_id, 'item')->result();

			if ( count( $item ) > 0 ) {
				$fav->id = $item->id;
				$fav->name = $item->name;
				$fav->description = $item->description;
				$fav->address = $item->address;
				$fav->phone = $item->phone;
				$fav->email = $item->email;
				$fav->website = $item->website;
				$fav->image = $img[0]->path;
			} else {
				$fav->name = "";
				$fav->description = "";
				$fav->address = "";
				$fav->phone = "";
				$fav->email = "";
				$fav->website = "";
				$fav->image = "";
			}
			$temp_fav_arr[] = $fav;
		}

		$data['favourites'] = $temp_fav_arr;
		$content['content'] = $this->load->view('favourites/index', $data, true);

		$this->load_template($content);
	}

	function delete_all()
	{
		if(!$this->session->userdata('is_city_admin')) {
		     $this->check_access('delete');
		}


		if ($this->favourite->delete_by_city($this->get_current_city()->id)) {
			$this->session->set_flashdata('success','All favourites records are successfully deleted.');
		} else {
			$this->session->set_flashdata('error','Database error occured.Please contact your system administrator.');
		}

		redirect(site_url('favourites'));
	}

	function delete($id=0)
	{
		if(!$this->session->userdata('is_city_admin')) {
		     $this->check_access('delete');
		}


		if ($this->favourite->delete_by_id($id)) {
			$this->session->set_flashdata('success','The record is successfully deleted.');
		} else {
			$this->session->set_flashdata('error','Database error occured.Please contact your system administrator.');
		}

		redirect(site_url('favourites'));
	}

}
?>
