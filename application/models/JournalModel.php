<?php
/**
* @author   Bhuvan Rikka
* @date     26th Feb, 2020
* @copyright    No Copyrights, but please link back in any way
*/

class JournalModel extends CI_Model{
    public function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->dbforge();
        $this->table = 'journal';
    }
    
    /**
     * Function to get journal entries
     */
    public function get_journal($where){

        $this->db->from($this->table);
        $this->db->where($where);
        //order data by modified time
        $this->db->order_by('tModified', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('iID',$id);
		$query = $this->db->get();
        return  $query->row();
        //print_r($this->db->last_query());exit;
	}

    /**
     * Function to make journal entries
     */
    public function insert_journal($data){    
        $this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

    /**
     * Function to update journal entries
     */
    public function update_journal($data, $where) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Function to disable journal entries
     */
    public function disable($id) {
        $data = array(
            'iIsEnabled' => 0
        );
        $where = "iID = ".$id;
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
?>