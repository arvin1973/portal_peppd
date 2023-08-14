<?php
/**
* 
*/
class M_article extends CI_Model
{
	private $table = 'articles';
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

	function editby($where, $item)
	{
		$this->db->where($where);
		return $this->db->update($this->table, $item);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}

/**-----------------------------------------------------------------------**/

	function selectdistinctorderbydesc($distinct, $order_by, $value)
	{
		$this->db->distinct();
		$this->db->select($distinct);
		$this->db->order_by($order_by, $value);
		return $this->db->get($this->table)->result();
	}

	function getallorderbydesc()
	{
		$this->db->order_by("id", "desc");
		return $this->db->get($this->table)->result();
	}

	function getallorderbydescwhere1($w1, $v1)
	{
		$this->db->where($w1, $v1);
		$this->db->order_by("created_at", "desc");
		return $this->db->get($this->table)->result();
	}

	function joinCategories()
	{
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id ORDER BY articles.created_at DESC');
		return $query->result();
	}

	function joinCategorieswhere1($where1, $value1)
	{
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id WHERE '.$where1.' = "'.$value1.'" ORDER BY articles.created_at DESC');
    	return $query->result();
	}

	function joinCategorieswhere1limit($where1, $value1, $limit)
	{
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id WHERE '.$where1.' = "'.$value1.'" ORDER BY articles.created_at DESC LIMIT '.$limit);
    	return $query->result();
	}

	function joinCategorieswhere2($where1, $value1, $where2, $value2)
	{
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id WHERE '.$where1.' = "'.$value1.'" AND '.$where2.' = "'.$value2.'" ORDER BY articles.id DESC');
    	return $query->result();
	}

	function joinCategorieswhere2limit($where1, $value1, $where2, $value2, $limit)
	{
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id WHERE '.$where1.' = "'.$value1.'" AND '.$where2.' = "'.$value2.'" ORDER BY articles.id DESC LIMIT '.$limit);
    	return $query->result();
	}

	function count_all()
	{
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	function fetch_details($limit, $start)
	{
		
		$query = $this->db->query('SELECT articles.id, articles.id_category, categories.name, articles.title, articles.slug, articles.description, articles.title_picture, articles.text, articles.author, articles.status, articles.created_at, articles.updated_at FROM `articles` JOIN categories ON articles.id_category = categories.id WHERE status = "publish" ORDER BY articles.created_at DESC LIMIT '.$start.', '.$limit);
		return $query->result();
	}

	function article_before($id_category, $timestamp)
	{
		$query = $this->db->query('SELECT * FROM articles WHERE id_category = "'.$id_category.'" AND status = "publish" AND created_at < TIMESTAMP("'.$timestamp.'", "yyyy-mm-dd hh24:mi:ss")');
		return $query->result();
	}

	function article_before_limit($id_category, $timestamp, $limit)
	{
		$query = $this->db->query('SELECT * FROM articles WHERE id_category = "'.$id_category.'" AND status = "publish" AND created_at < TIMESTAMP("'.$timestamp.'", "yyyy-mm-dd hh24:mi:ss") ORDER BY created_at DESC LIMIT '.$limit);
		return $query->result();
	}

	function article_after($id_category, $timestamp)
	{
		$query = $this->db->query('SELECT * FROM articles WHERE id_category = "'.$id_category.'" AND status = "publish" AND created_at > TIMESTAMP("'.$timestamp.'", "yyyy-mm-dd hh24:mi:ss")');
		return $query->result();
	}

	function article_after_limit($id_category, $timestamp, $limit)
	{
		$query = $this->db->query('SELECT * FROM articles WHERE id_category = "'.$id_category.'" AND status = "publish" AND created_at > TIMESTAMP("'.$timestamp.'", "yyyy-mm-dd hh24:mi:ss") ORDER BY created_at ASC LIMIT '.$limit);
		return $query->result();
	}

}
?>