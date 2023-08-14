<?php

/**
 * 
 */
class M_infograph extends CI_Model
{
    private $table = '';
    private $id    = 'id';

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pemantauan', TRUE);
    }

    /**-----------------------------------------------------------------------**/

    function getall()
    {
        return $this->db2->get($this->table)->result();
    }

    function getby($where)
    {
        $this->db2->where($where);
        return $this->db2->get($this->table)->result();
    }

    function likeby($like)
    {
        $this->db2->like($like);
        return $this->db2->get($this->table)->result();
    }

    function getbyid($id)
    {
        $this->db2->where($this->id, $id);
        return $this->db2->get($this->table)->result();
    }

    function countall()
    {
        return $this->db2->count_all($this->table);
    }

    function add($item)
    {
        $this->db2->insert($this->table, $item);
        return $this->db2->insert_id();
    }

    function edit($id, $item)
    {
        $this->db2->where($this->id, $id);
        $this->db2->update($this->table, $item);
    }

    function delete($id)
    {
        $this->db2->where($this->id, $id);
        $this->db2->delete($this->table);
    }

    /**-----------------------------------------------------------------------**/

    function getbyorderby($where, $order_value, $order)
    {
        $this->db2->order_by($order_value, $order);
        $this->db2->where($where);
        return $this->db2->get($this->table)->result();
    }
}
