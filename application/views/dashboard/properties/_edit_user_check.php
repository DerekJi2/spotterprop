<?php
    $max_limit = 1;
    

    $userId = $this->users->current->id;
    $group_id = get_group_id($userId);
    if ($group_id == 6) // Users
    {
        $property_owner_id = get_property_person_id($property_id);
        if ($property_owner_id != $userId)
        {
            echo "<h2>Warning!</h2>";
            echo '<p>Sorry, you are not allowed to update this property.</p>
            <p>If you are pretty sure there must be something wrong, please contact our service staff.</p>
            <p>Phone: 08 1234 5678</p>
            <p>Email: <a href="mailto:service@brickservices.com">service@brickservices.com</a></p>
            ';
            exit();
        }
    }

?>