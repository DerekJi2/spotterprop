
<?php

class BaseTable_model extends CI_Model {
    
    protected $tableName = ""; 

    /**
     * 
     */
    function __construct($pTablename = "")
    {
        parent::__construct();
		$this->load->database();
        $this->tableName = $this->db->dbprefix($pTablename);
    }

    /**
     * Get a list in result() from DefinedType table
     */
    function get_result() {
        $this->load->database();
        $query = $this->db->get($this->tableName);

        return $query->result();
    }

    /**
     * Get a list in result_array() from DefinedType table
     */
    function get_array() {
        $this->load->database();
        $query = $this->db->get($this->tableName);

        return $query->result_array();
    }

    /**
     * Get a single row with given id (DefinedType.Id)
     */
    function get_row($id = 0) {
        $this->load->database();
        $query = $this->db->get_where($this->tableName, array('id' => $id));

        $result = $query->result();
        $row = $result[0];
        return $row;
    }
}