<?php
/**
 * The main template file
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
	global $post;
	get_header();
	the_post();
?>

<div class="container">
	<!-- block control  -->
	<div class="row block-posts" id="post-control">
		<div class="col-md-8 col-sm-12 col-xs-12 posts-container">
			<div class="blog-wrapper">
	            <div class="row">
                    <div class="blog-content">
                        <h2 class="title-blog">
                        	<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </h2><!-- end title -->
                        <?php the_post_thumbnail( 'medium_large' ); ?>
                        <div style="margin:30px 0">
	                        <?php
	                            the_content();
	                            wp_link_pages( array(
	                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', ET_DOMAIN ) . '</span>',
	                                'after'       => '</div>',
	                                'link_before' => '<span>',
	                                'link_after'  => '</span>',
	                            ) );
	                        ?>
                        </div>
                    </div>
	            </div>
	        </div>
	        <div class="clearfix"></div>
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