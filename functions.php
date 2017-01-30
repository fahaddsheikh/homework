<?php


include( get_stylesheet_directory() . '/badge-module/badge-module.php' );


function add_script_custom() {

    if( !is_user_logged_in() ){ ?>
        <script type="text/javascript">
            (function($){
                $(document).ready(function(){
                    $(".enable-login").click(function(){
                        $(".login-btn").trigger("click");
                    });

                    $(".enable-signup").click(function(){
                        $(".register-btn").trigger("click");
                    });                   
                });
            })(jQuery);
        </script>
    <?php
    }
}
add_action( 'wp_footer', 'add_script_custom', 100);

if ( ! function_exists('press_release_post_type') ) {

// Register Custom Post Type
function press_release_post_type() {

    $labels = array(
        'name'                  => _x( 'Press Releases', 'Post Type General Name', 'press_release' ),
        'singular_name'         => _x( 'Press Release', 'Post Type Singular Name', 'press_release' ),
        'menu_name'             => __( 'Press Releases', 'press_release' ),
        'name_admin_bar'        => __( 'Press Release', 'press_release' ),
        'archives'              => __( 'Press Release Archives', 'press_release' ),
        'attributes'            => __( 'Press Release Attributes', 'press_release' ),
        'parent_item_colon'     => __( 'Parent Press Release:', 'press_release' ),
        'all_items'             => __( 'All Press Release', 'press_release' ),
        'add_new_item'          => __( 'Add New Press Release', 'press_release' ),
        'add_new'               => __( 'Add New Press Release', 'press_release' ),
        'new_item'              => __( 'New Press Release', 'press_release' ),
        'edit_item'             => __( 'Edit Press Release', 'press_release' ),
        'update_item'           => __( 'Update Press Release', 'press_release' ),
        'view_item'             => __( 'View Press Release', 'press_release' ),
        'view_items'            => __( 'View Press Release', 'press_release' ),
        'search_items'          => __( 'Search Press Release', 'press_release' ),
        'not_found'             => __( 'Press Release Not found', 'press_release' ),
        'not_found_in_trash'    => __( 'Press Release Not found in Trash', 'press_release' ),
        'featured_image'        => __( 'Press Release Featured Image', 'press_release' ),
        'set_featured_image'    => __( 'Set Press Release featured image', 'press_release' ),
        'remove_featured_image' => __( 'Remove Press Release featured image', 'press_release' ),
        'use_featured_image'    => __( 'Use Press Release as featured image', 'press_release' ),
        'insert_into_item'      => __( 'Insert into Press Release', 'press_release' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Press Release', 'press_release' ),
        'items_list'            => __( 'Press Releases list', 'press_release' ),
        'items_list_navigation' => __( 'Press Release list navigation', 'press_release' ),
        'filter_items_list'     => __( 'Filter Press Release list', 'press_release' ),
    );
    $rewrite = array(
        'slug'                  => 'press',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Press Release', 'press_release' ),
        'description'           => __( 'Press Release Post Type', 'press_release' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail'),
        'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-write-blog',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'press',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'press_release', $args );

}
add_action( 'init', 'press_release_post_type', 0 );

}