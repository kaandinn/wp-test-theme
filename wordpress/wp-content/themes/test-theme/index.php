<?php
get_header();
?>

<body>
<header class="header">
    <h1><a href="/"><?php bloginfo( 'name' ); ?></a></h1>
    <h2><?php bloginfo( 'description' ); ?></h2>
</header>

<div class="middle">
    <?php
        $pages = get_pages();

        foreach( $pages as $page ) {
    ?>
        <a href="<?php echo get_page_link($page->ID) ?>" class="nav"><?php echo $page->post_title ?></a>
    <?php
        }
    ?>
</div>

<div class="middle">
    <?php
    // циклы вывода записей
    // если записи найдены
    if ( have_posts() ){
        while ( have_posts() ){
            the_post();

            echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';

            echo get_the_excerpt();
        }
    }
    // елси записей не найдено
    else{
        echo ' <p>Записей нет...</p>';
    }
    ?>
</div>

<footer class="footer">
    <?php echo date('Y') ?> © Я и компания моя
</footer>

<?php wp_footer(); ?>
</body>

</html>