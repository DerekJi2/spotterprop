<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Pms_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "aauth_pms";
        parent::__construct($tablename);
    }

    public function send_pm($sender_id, $receiver_id, $title, $message)
    {
        $this->load->database();

        $now = date('Y-m-d H:i:s');

        $sql = "INSERT $this->tableName(sender_id, receiver_id, title, `message`, `date`, `read`)
                VALUES($sender_id, $receiver_id, '$title', '$message', '$now', 0)";

        $result = $this->db->query($sql);

        return $result;
    }

    public function list_unread($receiver_id, $desc = true)
    {
        $this->load->database();

        $sql = "SELECT *
                FROM `$this->tableName`
                WHERE `read`=0 AND `receiver_id`=$receiver_id 
                ";
        if ($desc)
            $sql .= " ORDER BY id DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function set_read_status($pm_id, $read = 1)
    {
        $this->load->database();

        $sql = "UPDATE `$this->tableName`
                SET `read`=1
                WHERE `id`=".$pm_id;

        $result = $this->db->query($sql);

        return $result;
    }

    public function set_as_read($pm_id)
    {
        return $this->set_read_status($pm_id, 1);
    }

    public function set_as_unread($pm_id)
    {
        return $this->set_read_status($pm_id, 0);
    }
}