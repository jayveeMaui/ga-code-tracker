<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ggpoker.com
 * @since      1.0.0
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/admin/partials
 */

function ga_code_tracker_create() {
    $id = $_POST["code"];
    $description = $_POST["description"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "ga_code_tracker";

        $wpdb->insert(
                $table_name, //table
                array('code' => $id, 'description' => $description), //data
                array('%s', '%s') //data format			
        );
        $message.="GA code tracker has been inserted!";
    }
    ?>
    <div class="wrap">
        <h2>Add New Tracker</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Code can be a url path . Note: If there are 2 or more download in a page, keywords should be used to describe the other download button. param gaTrackerID should be equal to the keyword specified. </p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Code</th>
                    <td><input type="text" name="code" value="<?php echo $id; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Description</th>
                    <td><input type="text" name="description" value="<?php echo $description; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}

function ga_code_tracker_list() {
    ?>
    <div class="wrap">
        <h2>Codes</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=ga_code_tracker_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "ga_code_tracker";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">Code</th>
                <th class="manage-column ss-list-width">Description</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->code; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->description; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=ga_code_tracker_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}


function ga_code_tracker_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ga_code_tracker";
    $id = $_GET['id'];
    $code = $_POST["code"];
    $description = $_POST["description"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('code' => $code, 'description' => $description), //data
                array('id' => $id), //where
                array('%s','%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $codes = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
        foreach ($codes as $s) {
            $codes = $s;
        }
    }
    ?>
    <div class="wrap">
        <h2>Codes</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Tracker code has been deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=ga_code_tracker_list') ?>">&laquo; Back to list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Tracker code has been updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=ga_code_tracker_list') ?>">&laquo; Back to list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Code</th><td><input type="text" name="code" value="<?php echo $codes->code; ?>"/></td></tr>
                    <tr><th>Description</th><td><input type="text" name="description" value="<?php echo $codes->description; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure?')">
            </form>
        <?php } ?>

    </div>
    <?php
}