<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title>
        <?php echo wp_get_document_title(); ?>
    </title>

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />

    <meta name="description" content="<?php echo get_description(); ?>" />

    <?php wp_head(); ?>
</head>

<?php
function get_description() {
    $custom_fields = get_post_custom();
    return $custom_fields['description'];
}
?>