
<?php

/**
 * Property Table
 */
class PropertyEntity_model {
    public $Id;
    public $Category;
    public $Address;
    public $Location;
    public $Latitude;
    public $Longtitude;
    public $TypeId;
    public $Rating;
    public $CreatedOn;
    public $Price;
    public $Featured;
    public $Color;
    public $PersonId;
    public $BuiltYear;
    public $SpecialOffer;
    public $AgencyId;
    public $IsDeleted;
    public $Description;
}

/**
 * Gallery Table
 */
class GalleryEntity_model {
    public $Id;
    public $PropertyId;
    public $ImageName;
    public $ImageUrl;
    public $CreatedOn;
    public $CreatedBy;
    public $ModifiedOn;
    public $ModifiedBy;
    public $Comments;
    public $DisplayNum;
    public $IsDeleted;
    public $IsFloorplan;
}

/**
 * PropertyFeature Table
 */
class PropertyFeatureEntity {
    public $Id;
    public $PropertyId;
    public $FeatureId;
    public $Descriptions;
    public $Image;
    public $IsDeleted;
}

/**
 * PropertySpec Table
 */
class PropertySpecEntity {
    public $Id;
    public $PropertyId;
    public $SpecId;
    public $SpecValue;
    public $IsDeleted;
}