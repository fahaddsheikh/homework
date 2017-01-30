<?php
/**
 * The archive template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FreelanceEngine
 * @since FreelanceEngine 1.0
 */
	get_header();
?>
<div class="container">
	<!-- block control  -->
	<div class="row block-posts" id="post-control">
		<div class="col-md-8 col-sm-12 col-xs-12 posts-container" id="posts_control">
		<?php
			if(have_posts()) { while(have_posts()) { the_post(); ?>
				<div class="post-item">
				    <div class="row">
				        <div class="blog-wrapper col-md-12 col-xs-9" style="border:0;padding-top:0">
				            <div class="blog-content">
				                <h2 class="title-blog"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
				                <?php the_post_thumbnail( 'medium_large' ); ?>
				                <div style="margin:10px 0">
					                <?php
					                    if(is_single()){
					                        the_content();
					                        wp_link_pages( array(
					                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', ET_DOMAIN ) . '</span>',
					                            'after'       => '</div>',
					                            'link_before' => '<span>',
					                            'link_after'  => '</span>',
					                        ) );
					                    } else {
					                        the_excerpt();
					                ?>
					                <a href="<?php the_permalink(); ?>" class="read-more">
					                    <?php _e("READ MORE",ET_DOMAIN) ?><i class="fa fa-arrow-circle-o-right"></i>
					                </a>
					                <?php } ?>
					            </div>
				            </div>
				        </div>
				    </div>
				</div>
			<?php } } else {
				echo '<h2>'.__( 'There is no posts yet', ET_DOMAIN ).'</h2>';
			}
		echo '<div class="paginations-wrapper">';
		ae_pagination($wp_query, get_query_var('paged'));
		echo '</div>';
		?>

		</div><!-- LEFT CONTENT -->
		<div class="col-md-4 col-sm-12 col-xs-12 blog-sidebar" id="right_content">
			<?php get_sidebar('blog'); ?>
		</div><!-- RIGHT CONTENT -->
	</div>
	<!--// block control  -->
</div>
<?php
	get_footer();
?>