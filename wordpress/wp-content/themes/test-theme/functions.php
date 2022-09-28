<?php
add_theme_support( 'title-tag' );

add_action( 'init', 'register_product_post_type' );

function register_product_post_type(){

    register_taxonomy( 'taxproduct', [ 'product' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Product Tags',
            'singular_name'     => 'Product Tag',
            'search_items'      => 'Search Product Tags',
            'all_items'         => 'All Product Tags',
            'view_item '        => 'View Product Tag',
            'parent_item'       => 'Parent Product Tag',
            'parent_item_colon' => 'Parent Genre:',
            'edit_item'         => 'Edit Product Tag',
            'update_item'       => 'Update Product Tag',
            'add_new_item'      => 'Add New Product Tag',
            'new_item_name'     => 'New Product Tag Name',
            'menu_name'         => 'Product Tag',
            'back_to_items'     => '← Back to Product Tags',
        ],
        'description'           => 'Tax for products', // описание таксономии
        'public'                => true,
        // 'publicly_queryable'    => null, // равен аргументу public
        // 'show_in_nav_menus'     => true, // равен аргументу public
        // 'show_ui'               => true, // равен аргументу public
        // 'show_in_menu'          => true, // равен аргументу show_ui
        // 'show_tagcloud'         => true, // равен аргументу show_ui
        // 'show_in_quick_edit'    => null, // равен аргументу show_ui
        'hierarchical'          => false,

        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ] );

    register_post_type( 'product', [
        'label'  => 'product',
        'labels' => [
            'name'               => 'Products', // основное название для типа записи
            'singular_name'      => 'Product', // название для одной записи этого типа
            'add_new'            => 'Add New', // для добавления новой записи
            'add_new_item'       => 'Add New Product', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Edit Product', // для редактирования типа записи
            'new_item'           => 'New Product', // текст новой записи
            'view_item'          => 'View Product', // для просмотра записи этого типа.
            'search_items'       => 'Search Product', // для поиска по этим типам записи
            'not_found'          => 'Product Not Found', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Not Found In Trash', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Products', // название меню
        ],
        'description'         => '',
        'public'              => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-coffee',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor', 'excrept', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => ['taxproduct'],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
}

//register_meta('post', 'product_meta', array(
//    'object_subtype'    => 'product',
//    'type'              => 'string',
//    'show_in_rest'      => true,
//    'sanitize_callback' => 'absint',
//));

add_filter('document_title', 'add_custom_title');

function add_custom_title($title) {

    if( is_page() ) {
        $title = 'Page: '. $title;
    } else {
        $title = 'Post: '. $title;
    }

    return $title;
}

add_filter('document_title_parts', 'remove_site_name');

function remove_site_name($parts) {

    if( (isset($parts['site'])) && ( is_page() ) )
        unset($parts['site']);

    return $parts;
}

register_meta('post', 'description', [
    'type'        => 'string',
    'description' => 'Описание'
]);

//add_action('wp_head', 'add_description_metatag');
//
//function add_description_metatag() {
//
//}