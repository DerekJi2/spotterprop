
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Gallery_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "gallery";
        parent::__construct($tablename);
    }

    
    public function get_result_by_propertyid($propId = 0)
    {
        $this->load->database();
        $query = $this->db->get_where($this->tableName, array('PropertyId' => $propId));

        return $query->result();
    }

    public function insert($propertyId, $imageUrl, $personId = 0, $displayNum = 0, $isFloorPlan = 0)
    {
        $now = date('Y-m-d H:i:s');
        // $data = array(
        //     'PropertyId'    => $propertyId,
        //     'ImageUrl'      => $imageUrl,
        //     'CreatedOn'     => $now,
        //     'CreatedBy'     => $personId,
        //     'ModifiedOn'    => $now,
        //     'ModifiedBy'    => $personId,
        //     'DisplayNum'    => $displayNum,
        //     'IsFloorPlan'   => $isFloorPlan,
        //     'IsDeleted'     => 0
        // );

        // $ok = $this->db->insert($this->tableName, $data);

        $sql = "INSERT INTO $this->tableName(PropertyId, ImageUrl, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, DisplayNum, IsFloorPlan, IsDeleted) 
        VALUES($propertyId, '$imageUrl', '$now', $personId, '$now', $personId, $displayNum, $isFloorPlan, 0);";

        echo "\r\n".$sql."\r\n";
        $ok = $this->db->query($sql);
        return $ok;
    }

    /**
     * 
     */
    public function delete($propertyId, $imageUrl)
    {
        $now = date('Y-m-d H:i:s');

        $sql = "DELETE FROM $this->tableName WHERE PropertyId=$propertyId AND ImageUrl='$imageUrl';";

        echo "\r\n".$sql."\r\n";
        $ok = $this->db->query($sql);
        return $ok;
    }
}