<?php
/**
 * Badge Module.
 * Used on Files: mobile/template/profile-item.php , template/profile-item.php
 * 
 /



/**
 * Register featured meta box(es).
 */
function featured_user_register_meta_boxes() {
    add_meta_box( 'featured_user_metaboxe', __( 'Featured User', 'textdomain' ), 'featured_user_content_callback', 'fre_profile' );
}
add_action( 'add_meta_boxes', 'featured_user_register_meta_boxes' );


/**
 * Display featured user box.
 *
 * @param WP_Post $post Current post object.
 */
function featured_user_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'featured_user_content_callback_nonce' );
    
    // Array for fields with respective modules.
    $featured_user_metabox = array (
        "featured_user" => "Featured",
		"verified_user" => "Verified",
		"rising_star_user" => "Rising Star"        
    );

    ?>

    <!-- Contact Stats -->
	<table class="form-table" id="<?php echo $post->ID; ?>">
	    <tbody>
	        <?php foreach ($featured_user_metabox as $key => $value) { ?>
	            <tr valign="top">
	                <td scope="row"><label for="<?php echo $key; ?>"><h2><?php echo $value; ?></h2></label></td>
	                <td style="width:75%">
	                    <?php $isfeatured = get_post_meta( $post->ID, $key, true ); ?>
	                    <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>" <?php if(isset($isfeatured) && empty(!$isfeatured)) : echo 'checked'; endif; ?>>
	                </td>
	            </tr>
	        <?php } ?>
	    </tbody>
	</table>

<?php }

/**
 * Save featured user.
 *
 * @param int $post_id Post ID
 */
function featured_user_content_save_callback( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['featured_user_content_callback_nonce'] ) || !wp_verify_nonce( $_POST['featured_user_content_callback_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    // Check the user's permissions.
    if ( !current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // Array to submit data associated to the values.
    $featured_user_metaboxvalues = array (
        "featured_user" => $_POST["featured_user"],
        "verified_user" => $_POST["verified_user"],
		"rising_star_user" => $_POST["rising_star_user"]
    );

    foreach ($featured_user_metaboxvalues as $key => $value) {
        update_post_meta($post_id, $key, sanitize_text_field( $value ));
    }
}
add_action( 'save_post_fre_profile', 'featured_user_content_save_callback' );

/**
 * Display the badges on the frontend.
 *
 * @param int $post_id Post ID
 * @param string $badge Badge Type
 */
function display_badges( $post , $badge) {

    $isfeatured = get_post_meta( $post, 'featured_user', true );
    $isverified = get_post_meta( $post, 'verified_user', true );
    $isrising = get_post_meta( $post, 'rising_star_user', true );

    if(isset($isfeatured) && empty(!$isfeatured)) { 
        $featured = "<span class='featured-badge' style='display:inline-block;max-width:30px;margin:0 5px;vertical-align: top;'><img src='" . get_stylesheet_directory_uri() . "/images/featured-badge.png' style='max-width:100%;cursor:pointer;' alt='Top Rated' Title='Top Rated'></span>";
    }
    if(isset($isverified) && empty(!$isverified)) { 
        $verified = "<span class='featured-badge' style='display:inline-block;max-width:30px;margin:0 5px;vertical-align: top;'><img src='" . get_stylesheet_directory_uri() . "/images/rising-star-badge.png' style='max-width:100%;cursor:pointer;' alt='Verified' Title='Verified'></span>";
    }
    if(isset($isrising) && empty(!$isrising)) { 
        $rising = "<span class='featured-badge' style='display:inline-block;max-width:30px;margin:0 5px;vertical-align: top;'><img src='" . get_stylesheet_directory_uri() . "/images/verified-badge.png' style='max-width:100%;cursor:pointer;' alt='Rising Star' Title='Rising Star'></span>";
    }

    switch ($badge) {
        case 'featured':
            if (isset($featured)) {
                echo $featured;
            }
            break;
        case 'verified':
            if (isset($verified)) {
                echo $verified;
            }
            break;
        case 'rising':
            if (isset($rising)) {
                echo $rising;
            }
            break;
        case 'all':
            if (isset($featured)) {
                echo $featured;
            }
            if (isset($verified)) {
                echo $verified;
            }
            if (isset($rising)) {
                echo $rising;
            }
            break;            
        default:
            return '';
            break;
    }
}