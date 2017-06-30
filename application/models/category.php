<?php
class Category extends Base_Model
{
	protected $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'cd_categories';
	}

	function exists($data)
	{
		$this->db->from($this->table_name);

		if (isset($data['id'])) {
			$this->db->where('id',$data['id']);
		}

		if (isset($data['name'])) {
			$this->db->where('name',$data['name']);
		}

		if (isset($data['city_id'])) {
			$this->db->where('city_id',$data['city_id']);
		}

		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function get_all($city_id, $limit=false, $offset=false)
	{
		$this->db->from($this->table_name);
		$this->db->where('city_id', $city_id);

		if ($limit) {
			$this->db->limit($limit);
		}

		if ($offset) {
			$this->db->offset($offset);
		}

		$this->db->order_by('ordering','asc');
		return $this->db->get();
	}

	function get_only_publish($city_id, $limit=false,$offset=false)
	{
		$this->db->from($this->table_name);
		$this->db->where('city_id', $city_id);
		$this->db->where('is_published', 1);

		if ($limit) {
			$this->db->limit($limit);
		}

		if ($offset) {
			$this->db->offset($offset);
		}

		$this->db->order_by('ordering','asc');
		return $this->db->get();
	}

	function get_info($id)
	{
		$query = $this->db->get_where($this->table_name,array('id' => $id));

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return $this->get_empty_object($this->table_name);
		}
	}

	function get_multiple_info($ids)
	{
		$this->db->from($this->table_name);
		$this->db->where_in($ids);
		return $this->db->get();
	}

	function count_all($city_id)
	{
		$this->db->from($this->table_name);
		$this->db->where('city_id', $city_id);
		$this->db->where('is_published', 1);
		return $this->db->count_all_results();
	}

	function count_all_by($city_id, $conditions=array())
	{
		$this->db->from($this->table_name);

		if (isset($conditions['searchterm'])) {
			$this->db->like('name',$conditions['searchterm']);
		}

		$this->db->where('city_id', $city_id);
		$this->db->where('is_published',1);
		return $this->db->count_all_results();
	}

	function get_all_by($city_id, $conditions=array(), $limit=false, $offset=false)
	{
		$this->db->from($this->table_name);

		if (isset($conditions['searchterm'])) {
			$this->db->like('name',$conditions['searchterm']);
		}

		$this->db->where('city_id', $city_id);
		$this->db->where('is_published',1);
		if ($limit) {
			$this->db->limit($limit);
		}

		if ($offset) {
			$this->db->offset($offset);
		}

		$this->db->order_by('added','desc');
		return $this->db->get();
	}

	function delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
 	}

 	function get_cat_name_by_id($id)
 	{
 		$this->db->from($this->table_name);
 		$this->db->where('id', $id);
 		$query = $this->db->get();
 		foreach ($query->result() as $row) {
 		    return $row->name;
 		}
 	}

 	function delete_by_city($city_id)
 	{
 		$this->db->where('city_id', $city_id);
 		return $this->db->delete($this->table_name);
 	}
 }
?>
