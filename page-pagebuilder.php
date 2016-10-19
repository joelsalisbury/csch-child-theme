<?php
/**
 Template Name: Page Builder
 */

get_header(); ?>
<div id="page-page-builder">
	<?php include('inc/sidebar-check.php')?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php include('inc/submenu-check.php')?>
			<div class="row">
				<div class="col-sm-<?php echo (is_active_sidebar( $sidebar )?9:12); ?>">
                	<div id="primary" class="content-area subpage">
						<main id="main" class="site-main" role="main">
							<?php get_template_part( 'content', 'blank' ); ?>
                            <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>
                    	</main>
                    </div>
				</div>
				<?php include('inc/sidebar-if-active.php')?>
			</div>
		<?php include('inc/submenu-closing-tags.php')?> 
	<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>
