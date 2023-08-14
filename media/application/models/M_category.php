<?php
/**
* 
*/
class M_category extends CI_Model
{
	private $table = 'categories';
	private $id    = 'id';
	
	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}

/**-----------------------------------------------------------------------**/
	
	function getall()
	{
		return $this->db->get($this->table)->result();
	}

	function getby($where)
	{
		$this->db->where($where);
		return $this->db->get($this->table)->result();
	}

	function likeby($like)
	{
		$this->db->like($like);
		return $this->db->get($this->table)->result();
	}

	function getbyid($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->result();
	}

	function countall()
	{
		return $this->db->count_all($this->table);
	}

	function add($item)
	{
		$this->db->insert($this->table, $item);
		return $this->db->insert_id();
	}

	function edit($id, $item)
	{
		$this->db->where($this->id, $id);
		return $this->db->update($this->table, $item);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}

/**-----------------------------------------------------------------------**/

}
?>