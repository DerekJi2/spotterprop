<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 

class Property_JsonModel extends CI_Model {
    public $id;
    public $category;
    public $title;  // Address
    public $location;
    public $latitude;
    public $longitude;
    public $TypeId;
    public $rating;
    public $date_created;
    public $price;
    public $featured;
    public $color;
    public $person_id;
    public $year;
    public $special_offer;
    public $agency_id;
    public $IsDeleted;
    public $description;

    public $type;
    public $type_icon;
    public $gallery = array();
    public $item_specific = array();
    public $features = array();
    public $FeaturesId = array();

    function __construct() {
        parent::__construct();

        $Id = 0;
    }

}