<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 
require_once(__ROOT__.'/models/Property_JsonModel.php'); 
require_once(__ROOT__.'/models/Gallery_model.php'); 
require_once(__ROOT__.'/models/PropertyFeature_model.php'); 
require_once(__ROOT__.'/models/PropertySpec_model.php'); 
require_once(__ROOT__.'/models/DefinedType_model.php'); 

class Property_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "property";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    function get_json_array($incDeleted = false, $statusRange = [1,2,3])
    {
        $arr = array();

        $result = $this->get_result();
        foreach($result as $row)
        {
            $included = true;
            $isDeleted = $row->IsDeleted;
            if ($isDeleted == 1 && $incDeleted == false)
            {
                $included = false;
            }

            if ($included == true)
            {
                $status = $row->StatusId;
                $included = in_array($status, $statusRange);
            }

            if ($included == true)
            {
                $json = $this->get_json_model_from_property_row($row);
                array_push($arr, $json);
            }
        }

        $json = new class($arr) {
            public $data;

            public function __construct($data) {
                $this->data = $data;
            }

        };

        return $json;
    }

    function get_json($propId = 0)
    {
        $row = $this->get_row($propId);

        $jsondata = $this->get_json_model_from_property_row($row);

        $json = new class($jsondata) {
            public $data;

            public function __construct($data) {
                $this->data = $data;
            }

        };
        return $json;
    }

    /**
     * 
     */
    function get_latest_result($top, $incDeleted = false, $statusRange = [3])
    {
        $where = "WHERE StatusId IN (".implode(', ', $statusRange).")";
        if ($incDeleted == false)
        {
            $where = "$where AND IsDeleted = 0";
        }

        $sql = "SELECT * FROM $this->tableName 
         $where
         ORDER BY CreatedOn DESC LIMIT $top";

        $query = $this->db->query($sql);
        $result = $query->result();

        // $filter_result = array();
        foreach($result as $row)
        {
            $propId = $row->Id;

            $row->gallery = $this->get_gallery($propId);

            $definedTypes = new DefinedType_model();
            $types = $definedTypes->get_result();
            foreach($types as $t)
            {
                if ($t->Id == $row->TypeId)
                {
                    $row->type = $t->Name;
                    $row->type_icon = $t->Icon;
                }
            }
        }
        return $result;
    }

    /**
     * 
     */
    function get_featured($top, $incDeleted = false, $statusRange = [3])
    {
        $where = "WHERE Featured=1 AND StatusId IN (".implode(', ', $statusRange).")";
        if ($incDeleted == false)
        {
            $where = "$where AND IsDeleted = 0";
        }
        $sql = "SELECT * FROM $this->tableName $where ORDER BY CreatedOn DESC LIMIT $top";

        $query = $this->db->query($sql);
        $result = $query->result();
        foreach($result as $row)
        {
            $propId = $row->Id;

            $row->gallery = $this->get_gallery($propId);

            $definedTypes = new DefinedType_model();
            $types = $definedTypes->get_result();
            foreach($types as $t)
            {
                if ($t->Id == $row->TypeId)
                {
                    $row->type = $t->Name;
                    $row->type_icon = $t->Icon;
                }
            }
        }
        return $result;
    }

    /**
     * 
     */
    function get_json_model_from_property_row($row)
    {
        // Basic
        $json = $this->get_basic_json_from_row($row);

        $propId = $row->Id;

        // Gallery[]
        $json->gallery = $this->get_gallery($propId);

        // Features[]
        $json->features = $this->get_features($propId);
        $json->FeaturesId = $this->get_featuresId($propId);
        
        // Type
        $definedTypes = new DefinedType_model();
        $types = $definedTypes->get_result();
        foreach($types as $t)
        {
            if ($t->Id == $json->TypeId)
            {
                $json->type = $t->Name;
                $json->type_icon = $t->Icon;
            }
        }

        $json->item_specific = $this->get_specific($propId);

        return $json;
    }
    
    /**
     * 
     */
    function get_basic_json_from_row($row)
    {
        $json = new Property_JsonModel();

        $json->id = $row->Id;
        $json->category = $row->Category;
        $json->title = $row->Address;
        $json->location = $row->Location;
        $json->latitude = $row->Latitude;
        $json->longitude = $row->Longitude;
        $json->TypeId = $row->TypeId;
        $json->StatusId = $row->StatusId;
        $json->rating = $row->Rating;
        $json->date_created = $row->CreatedOn;
        $json->price = $row->Price;
        $json->featured = $row->Featured;
        $json->color = $row->Color;
        $json->person_id = $row->PersonId;
        $json->year = $row->BuiltYear;
        $json->special_offer = $row->SpecialOffer;
        $json->agency_id = $row->AgencyId;
        $json->IsDeleted = $row->IsDeleted;
        $json->description = $row->Description;

        return $json;
    }

    /**
     * 
     */
    function get_gallery($propId)
    {
        $json_gallery = array();

        $galleryModel = new Gallery_model();
        $gallery = $galleryModel->get_result_by_propertyid($propId);
        foreach($gallery as $g)
        {
            array_push($json_gallery, $g->ImageUrl);
        }

        return $json_gallery;
    }

    /**
     * 
     */
    function get_features($propId)
    {
        $json_features = array();

        $propFeature = new PropertyFeature_model();
        $features = $propFeature->get_result_by_propertyid($propId);
        foreach($features as $f)
        {
            array_push($json_features, $f->Name);
        }

        return $json_features;
    }

    /**
     * 
     */
    function get_featuresId($propId)
    {
        $json_features = array();

        $propFeature = new PropertyFeature_model();
        $features = $propFeature->get_result_by_propertyid($propId);
        foreach($features as $f)
        {
            array_push($json_features, $f->FeatureId);
        }

        return $json_features;
    }

    /**
     * 
     */
    function get_specific($propId)
    {
        $json_specs = array();

        $propSpec = new PropertySpec_model();
        $specs = $propSpec->get_result_by_propertyid($propId);
        foreach($specs as $s)
        {
            $Name = $s->Name;
            $Amount = $s->SpecValue;
            $json_specs[$Name] = $Amount;
        }

        return $json_specs;
    }

    /**
     * return the newly created property row();
     */
    function insert($data)
    {
        $ok = $this->db->insert($this->tableName, $data);
        if ($ok)
        {            
            $guid = $data["guid"]; //"ECCB1523-6BEE-4ADB-86F4-2BB889504A09";
            $sql = sprintf('SELECT * FROM %s WHERE guid=\'%s\' LIMIT 1', 
                                $this->tableName, $guid);
            $query = $this->db->query($sql);
            $row = $query->row();
            return $row; // return the newly created property row();
        }

        return null; // if failed
    }

    /**
     * return the newly created property row();
     */
    function update($data)
    {
        $this->db->where('Id', $data["Id"]);
        $ok = $this->db->update($this->tableName, $data);

        return $ok; // if failed
    }

    /**
     * 
     */
    public function delete($propertyId, $really = true)
    {
        $sql = "DELETE FROM $this->tableName ";
        if ($really == false)
            $sql = "UPDATE $this->tableName SET IsDeleted=1";

        $sql = $sql." WHERE Id=$propertyId;";

        echo "\r\n".$sql."\r\n";
        $ok = $this->db->query($sql);
        return $ok;
    }

    /**
     * 
     */
    public function update_status($propertyId, $statusId)
    {
        $sql = "UPDATE $this->tableName SET StatusId=$statusId WHERE Id=$propertyId";

        echo "\r\n".$sql."\r\n";
        $ok = $this->db->query($sql);
        return $ok;
    }

    public function status_stats($userid = false)
    {
        $sql = "SELECT StatusId, COUNT(Id) AS Num FROM $this->tableName ";
        if ($userid != false && $userid > 0)
        {
            $sql .= "WHERE PersonId=$userid ";
        }
        
        $sql .= "GROUP BY StatusId";

        $query = $this->db->query($sql);
        return $query->result();
    }
}