<?php
$myid = $this->users->current->id;
$groupid = get_group_id($myid);

if ($groupid < 6)
{
    $users = get_users();
?>
    <div class="form-group">
        <label for="select-owner">Select the Owner:</label>
        <select class="form-control" id="select-owner" onchange="javascript: onSelect_UserOption();">
    <?php
        
        foreach ($users as $user)
        {
            $selected = ($user->id == $myid) ? "selected" : "";
        ?>
            <option value="<?= $user->id ?>" <?= $selected ?>><?= $user->name ?></option>
        <?php
        } // foreach $users
        ?>
        </select>
    </div>

<?php 
} // if $gourpid < 6
?>

<script>
function onSelect_UserOption()
{
    input = "#personid";
    var selected_userid = $('#select-owner').val();
    $(input).val(selected_userid);
}
</script>