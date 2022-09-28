<?php

function todo_update() {

    $option = get_option('mysql_on');
    $token = get_option('gorest_token');
    $id = $_GET['id'];

    if ($option === 'yes') {
        global $wpdb;
        $table_name = $wpdb->prefix . 'todo';

        if (isset($_POST['update'])) {
            $name = $_POST['name'];

            $wpdb->update(
                $table_name,
                array('name' => $name),
                array('ID' => $id)
            );
        }
        ?>

        <div class="wrap">
            <h2>Item</h2>

            <?php if (isset($_POST['update'])) { ?>
                <div class="updated"><p>Item updated</p></div>
                <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>

            <?php } else { ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <table class="wp-list-table fixed">
                        <tr><th>Name</th><td><input type="text" name="name" /></td></tr>
                    </table>
                    <input type="submit" name="update" value="Save" class="button">
                </form>
            <?php } ?>

        </div>
    <?php } else {
        $url = 'https://gorest.co.in/public/v2/todos/' . $id;
        $body = array('title' => $_POST['title'], 'status' => $_POST['status']);
        $body = json_encode($body);
        $rows = wp_remote_request($url, array(
                'method' => 'PUT',
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
            <h2>Item</h2>

            <?php if (isset($_POST['update'])) { ?>
                <div class="updated"><p>Item updated</p></div>
                <a href="<?php echo admin_url('admin.php?page=todo_list') ?>">&laquo; Back to list</a>

            <?php } else { ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <table class='wp-list-table fixed'>
                        <tr><th>Title</th><td><input type="text" name="title" /></td></tr>
                        <tr><th>Status</th><td><input type="text" name="status" /></td></tr>
                    </table>
                    <input type="submit" name="update" value="Save" class="button">
                </form>
            <?php } ?>

        </div>
        <?php
    }
}