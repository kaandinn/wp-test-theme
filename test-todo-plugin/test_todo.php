<?php
/**
 * Plugin Name: test_todo
 * Description: Этот плагин делает мир лучше!
 * Version: 1.0.0
 * Author: Sassr
 * License: GPL2
 */

if (!defined('ABSPATH')){
    exit;
}

class ToDoPlugin {

    public function register(){
        add_action('init', [$this, 'todo_options_install']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_menu', [$this, 'todo_crud_menu']);
        add_action ('wp', [$this, 'todo_front_list']);
        add_action( 'admin_notices', [$this, 'todo_notice']);
    }

    static function activation(){
        flush_rewrite_rules();
    }

    static function deactivation(){
        flush_rewrite_rules();
    }

    public function todo_options_install() {

        global $wpdb;

        $table_name = $wpdb->prefix . 'todo';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(50) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    public function todo_crud_menu() {

        add_menu_page('ToDo',
            'ToDo',
            'manage_options',
            'todo_list',
            'todo_list',
            'dashicons-edit-page'
        );

        add_submenu_page('todo_list',
            'Add New Item',
            'Add New',
            'manage_options',
            'todo_create',
            'todo_create');

        add_submenu_page(null,
            'Retrieve Item',
            'Retrieve',
            'manage_options',
            'todo_retrieve',
            'todo_retrieve');

        add_submenu_page(null,
            'Update Item',
            'Update',
            'manage_options',
            'todo_update',
            'todo_update');

        add_submenu_page(
            'todo_list',
            'ToDo Settings',
            'Settings',
            'manage_options',
            'todo_settings',
            'todo_settings'
        );
    }

    public function todo_front_list() {
        if(is_page('todo-list')){
            $dir = plugin_dir_path( __FILE__ );
            include($dir.'todo_frontend.php');
            die();
        }
    }

    public function register_settings() {

        add_settings_section(
        'todo_section_id',
        '',
        '',
        'todo_settings'
        );

        register_setting(
            'todo-settings',
            'mysql_on',
            [$this, 'todo_sanitize_checkbox']
        );

        register_setting(
            'todo-settings',
            'gorest_token',
            [$this, 'todo_sanitize_token']
        );

        add_settings_field(
            'mysql_on',
            'MySQL ON',
            [$this, 'todo_checkbox'],
            'todo_settings',
            'todo_section_id'
        );

        add_settings_field(
            'gorest_token',
            'GoREST Token',
            [$this, 'todo_token'],
            'todo_settings',
            'todo_section_id',
            array(
                'label_for' => 'rest_token',
                'name' => 'rest_token'
            )
        );
    }

    function todo_checkbox($args) {
        $value = get_option('mysql_on');
        ?>
        <label>
            <input type="checkbox" name="mysql_on" <?php checked( $value, 'yes') ?> /> Yes
        </label>
        <?php
    }

    function todo_sanitize_checkbox( $value ) {
        return 'on' === $value ? 'yes' : 'no';
    }

    public function todo_token($args) {
        ?>
        <label>
            <input type="text" name="gorest_token" />
        </label>
        <?php
    }

    function todo_notice() {
        if(
            isset($_GET['page'])
            && 'todo_settings' == $_GET['page']
            && isset( $_GET['settings-updated'])
            && $_GET['settings-updated']
        ) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p>
                    <strong>ToDo settings saved.</strong>
                </p>
            </div>
            <?php
        }
    }

}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'todo_list.php');
require_once(ROOTDIR . 'todo_retrieve.php');
require_once(ROOTDIR . 'todo_create.php');
require_once(ROOTDIR . 'todo_update.php');
require_once(ROOTDIR . 'todo_settings.php');

if (class_exists('ToDoPlugin')){
    $testTodo = new ToDoPlugin();
    $testTodo->register();
}

register_activation_hook(__FILE__, array($testTodo, 'activation'));
register_deactivation_hook(__FILE__, array($testTodo, 'deactivation'));
