
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class PropertyFeature_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "property"."feature";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    public function get_result_by_propertyid($propId = 0)
    {
        $this->load->database();

        $tablePropertyFeature = $this->db->dbprefix("PropertyFeature");
        $tableDefinedFeature = $this->db->dbprefix("DefinedFeature");
        
        $sql = "SELECT DF.Name, F.* 
        FROM $tablePropertyFeature F
            LEFT JOIN $tableDefinedFeature DF on F.FeatureId=DF.id
        WHERE PropertyId=".$propId;

        $query = $this->db->query($sql);

        return $query->result();
    }

    /**
     * 
     */
    public function feature_exists($prop_features_result, $feature_id)
    {
        foreach ($prop_features_result as $item)
        {
            $prop_feature_id = $item->FeatureId;
            if ($prop_feature_id == $feature_id)
            {
                return true;
            }
        }
        return false;
    }

    public function insert($propertyId, $featureId, $description = "", $image = "")
    {
        $data = array(
            'PropertyId'    => $propertyId,
            'FeatureId'     => $featureId,
            'Description'   => $description,
            'Image'         => $image,
            'IsDeleted'     => 0,
        );
        $ok = $this->db->insert($this->tableName, $data);
        
        return $ok;
    }

    public function insert_array($propertyId, $features)
    {
        $ok = true;
        if ($features != null && sizeof($features) > 0)
        {
            $values = array();
            foreach ($features as $feature_id)
            {
                $value = sprintf("(%d, %d)", $propertyId, $feature_id);
                array_push($values, $value);
            }
            $values_string = implode(", ", $values);
            $sql = sprintf("INSERT INTO %s(PropertyId, FeatureId) VALUES%s", $this->tableName, $values_string);

            $ok = $this->db->query($sql);        
        }
        return $ok;
    }

    public function delete($propertyId, $featureId, $mark_only = false)
    {
        $sql_delete = sprintf("DELETE %s", $this->$tableName);
        if ($mark_only == true)
        {
            $sql_delete = sprintf("UPDATE %s SET IsDeleted=1", $this->$tableName);
        }

        $sql = sprintf("%s WHERE PropertyId=%d AND FeatureId=%d", $sql_delete, $propertyId, $feature_id);

        $ok = $this->db->query($sql);        
        return $ok;
    }

    public function delete_array($propertyId, $features, $mark_only = false)
    {
        $ok = true;
        if ($features != null && sizeof($features) > 0)
        {
            $sql_delete = sprintf("DELETE %s", $this->$tableName);
            if ($mark_only == true)
            {
                $sql_delete = sprintf("UPDATE %s SET IsDeleted=1", $this->$tableName);
            }

            $values = array();
            foreach ($features as $feature_id)
            {
                $value = sprintf("%d", $feature_id);
                array_push($values, $value);
            }
            $values_string = implode(", ", $values);
            $sql = sprintf("%s WHERE PropertyId=%d AND FeatureId IN (%s)", $sql_delete, $propertyId, $values_string);

            $ok = $this->db->query($sql);     
        }   
        return $ok;
    }

    public function delete_by_id($id)
    {
        $sql = sprintf("DELETE %s WHERE Id=%d", $this->tableName, $id);
        $ok = $this->db->query($sql);
        
        return $ok;
    }

    public function delete_by_propertyid($property_id)
    {
        $sql = sprintf("DELETE %s WHERE PropertyId=%d", $this->tableName, $property_id);
        $ok = $this->db->query($sql);
        
        return $ok;
    }
}