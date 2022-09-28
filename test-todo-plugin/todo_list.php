<?php

function todo_list() {
    ?>
    <div class="wrap">
        <h2>Todo</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=todo_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        $option = get_option('mysql_on');
        $token = get_option('gorest_token');
        if ($option === 'yes') {
            global $wpdb;
            $table_name = $wpdb->prefix . 'todo';

            $rows = $wpdb->get_results('SELECT id,name from $table_name');
        ?>
        <table class="wp-list-table widefat fixed striped posts">
            <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column"><?php echo $row->id; ?></td>
                    <td class="manage-colum"><?php echo $row->name; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=todo_retrieve&id=' . $row->id); ?>">Manage</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        $rows = wp_remote_get('https://gorest.co.in/public/v2/todos', array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $token
                )
        )
        );
        $body = json_decode($rows['body']);
            ?>
            <table class="wp-list-table widefat fixed striped posts">
                <tr>
                    <th class="manage-column">ID</th>
                    <th class="manage-column">Name</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($body as $row) { ?>
                    <tr>
                        <td class="manage-column"><?php echo $row->id; ?></td>
                        <td class="manage-colum"><?php echo $row->title; ?></td>
                        <td><a href="<?php echo admin_url('admin.php?page=todo_retrieve&id=' . $row->id); ?>">Manage</a></td>
                    </tr>
                <?php } ?>
            </table>
    </div>
        <?php }
}
