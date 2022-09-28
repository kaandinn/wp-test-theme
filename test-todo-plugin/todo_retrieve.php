<?php

function todo_retrieve() {
    ?>
    <div class="wrap">
    <h2>Todo</h2>
    <?php
    $option = get_option('mysql_on');
    $token = get_option('gorest_token');
    $id = $_GET['id'];
    if ($option === 'yes') {
        global $wpdb;
        $table_name = $wpdb->prefix . 'todo';

        if (isset($_POST['delete'])) {
            $wpdb->query($wpdb->prepare('DELETE FROM $table_name WHERE id = %s', $id));
        } else {
            $items = $wpdb->get_results($wpdb->prepare('SELECT id,name from $table_name where id=%s', $id));
            $item_id = $items[0]->id;
            $item_name = $items[0]->name;
        }
        ?>

        <?php if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>Item deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>
        <?php } else { ?>
            <table class="wp-list-table widefat fixed striped posts">
                <tr>
                    <th class="manage-column">ID</th>
                    <th class="manage-column">Name</th>
                    <th>&nbsp;</th>
                </tr>
                    <tr>
                        <td class="manage-column"><?php echo $item_id; ?></td>
                        <td class="manage-column"><?php echo $item_name; ?></td>
                        <td><a href="<?php echo admin_url('admin.php?page=todo_update&id=' . $item_id); ?>">Update</a></td>
                    </tr>
                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="submit" name="delete" value="Delete" class="button"
                               onclick="return confirm('Delete this element?')">
                    </form>
                </table>
                </div>
            <?php
        }
    } else {
        $url = 'https://gorest.co.in/public/v2/todos/' . $id;
        if (isset($_POST['delete'])) {
            $rows = wp_remote_request($url, array(
                    'method' => 'DELETE',
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $token
                    )
                )
            );
        } else {
            $rows = wp_remote_get($url, array(
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $token
                    )
                )
            );
        }
        $body = json_decode($rows['body']);
        if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>Item deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>
        <?php } else { ?>
            <table class="wp-list-table widefat fixed striped posts">
                <tr>
                    <th class="manage-column">ID</th>
                    <th class="manage-column">Title</th>
                    <th class="manage-column">Status</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td class="manage-column"><?php echo $body->id; ?></td>
                    <td class="manage-column"><?php echo $body->title; ?></td>
                    <td class="manage-column"><?php echo $body->status; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=todo_update&id=' . $body->id); ?>">Update</a></td>
                </tr>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <input type="submit" name="delete" value="Delete" class="button"
                           onclick="return confirm('Delete this element?')">
                </form>
            </table>
            </div>
            <?php
        }
    }
}