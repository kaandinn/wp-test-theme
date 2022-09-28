<div class="wrap">
    <h2>Todo</h2>

    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . "todo";

    $rows = $wpdb->get_results("SELECT id,name from $table_name");
    ?>
    <table class='wp-list-table widefat fixed striped posts'>
        <tr>
            <th class="manage-column">ID</th>
            <th class="manage-column">Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td class="manage-column"><?php echo $row->id; ?></td>
                <td class="manage-colum"><?php echo $row->name; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php
