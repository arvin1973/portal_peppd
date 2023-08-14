<?php
/**
* 
*/
class M_guide extends CI_Model
{
	private $table = 'guides';
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
		$this->db->update($this->table, $item);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}

/**-----------------------------------------------------------------------**/

	function getallorderbydesc()
	{
		$this->db->order_by("id", "desc");
		return $this->db->get($this->table)->result();
	}

	function allandpagehint($like, $id)
	{
		$query = $this->db->query('SELECT guides.id, guides.id_category, guides.name, guides.description, guides.title_picture, guides.file, guides.created_at, guides.updated_at, count(log_portals.id) AS sum_of_log FROM guides JOIN log_portals WHERE log_portals.action LIKE "'.$like.'" AND guides.id = "'.$id.'"');
		return $query->result();
	}

	function allandpagehintdownload($like_sum_of_log, $like_sum_of_download, $id)
	{
		$query = $this->db->query('SELECT g.id, g.id_category, g.name, g.description, g.title_picture, g.file, g.created_at, g.updated_at, (SELECT COUNT(l.id) FROM log_portals l WHERE l.action LIKE "'.$like_sum_of_log.'") AS sum_of_log, (SELECT COUNT(i.id) FROM log_portals i WHERE i.action LIKE "'.$like_sum_of_download.'") AS sum_of_download FROM guides g WHERE g.id = "'.$id.'"');
		return $query->result();
	}

}
?>