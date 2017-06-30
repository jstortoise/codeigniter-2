<?php
require_once('main.php');
class Cities extends Main
{
	function __construct()
	{
		parent::__construct('cities');
	}

	function index($city_id = 0)
	{
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

			//items
			$items = $this->item->get_all_by_cat($category->id)->result();
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

			$category->items = $temp_items_arr;
			$temp_cate_arr[] = $category;
		}


		$city->categories = $temp_cate_arr;
    $data['city'] = $city;
    $content['content'] = $this->load->view('cities/index', $data, true);
    $this->load_template($content);
	}
}
?>
