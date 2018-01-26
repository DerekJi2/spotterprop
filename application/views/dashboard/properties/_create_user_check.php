<?php
    $max_limit = 1;
    

    $userId = $this->users->current->id;
    $group_id = get_group_id($userId);
    if ($group_id == 6) // Users
    {
        $list = get_property_list();
        $properties = filter_properties($list->data, $userId);
        if (sizeof($properties) >= $max_limit)
        {
            $this->load->view("dashboard/properties/_create_exceed_limit");
            exit();
        }
    }

?>