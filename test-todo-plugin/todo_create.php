<?php

function todo_create() {

    $option = get_option('mysql_on');
    $token = get_option('gorest_token');

    if ($option === 'yes') {

        if (isset($_POST['create'])) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'todo';

            $name = $_POST['name'];

            $wpdb->insert(
                $table_name,
                array('name' => $name),
                array('%s', '%s')
            );
        }
        ?>
        <div class="wrap">
            <h2>Add New Item</h2>
            <?php if (isset($_POST['create'])) { ?>
                <div class="updated"><p><?php echo "Item created"; ?></p></div>
                <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>

            <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class="wp-list-table fixed">
                    <tr>
                        <th>Item</th>
                        <td><input type="text" name="name" /></td>
                    </tr>
                </table>
                <input type="submit" name="create" value="Save" class="button">
            </form>
        </div>
        <?php }
    } else {
        $url = 'https://gorest.co.in/public/v2/todos';
        $body = array('user_id' => $_POST['user_id'], 'title' => $_POST['title'], 'status' => $_POST['status']);
        $body = json_encode($body);
        $rows = wp_remote_post($url, array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ),
                'body' => $body,
                'data_format' => 'body'
            )
        );
        ?>
        <div class="wrap">
        <h2>Add New Item</h2>
        <?php if (isset($_POST['create'])) { ?>
            <div class="updated"><p><?php echo "Item created"; ?></p></div>
            <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class="wp-list-table fixed">
                    <tr>
                        <th>User ID</th>
                        <td><input type="text" name="user_id" /></td>
                        <th>Title</th>
                        <td><input type="text" name="title" /></td>
                        <th>Status</th>
                        <td><input type="text" name="status" /></td>
                    </tr>
                </table>
                <input type="submit" name="create" value="Save" class="button">
            </form>
            </div>
        <?php }
    }
}
