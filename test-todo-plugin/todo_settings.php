<?php
function todo_settings(){
    ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title() ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('todo-settings');
            do_settings_sections('todo_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}