<?php
/**
Template Name: Home

 * The template for displaying the homepage.
 *
 * @package cornerstone
 */
$rows = get_theme_mod('homepagerows', '2');
$count = 1;
get_header();
?>
<div id="page-home">
	<?php while ( have_posts() ) : the_post(); ?>
	<?php for($i=0; $i<$rows; $i++){ /* Begin Homepage Builder... */?>
	<div class="row">
		<?php 
			$widths = get_theme_mod('homepage_'.$i, '12');
			$widths = explode(',',$widths);
			if(count($widths) == 1) $widths[0] = 12;
			foreach($widths as $width){
			if($width == 0) break; 
		?>
		<div class="col-sm-<?php echo $width; ?>">
			<div class="home-section" id="home-section-<?php echo $count; ?>">
				<?php if ( is_active_sidebar( 'home'.$count ) ) {
					dynamic_sidebar( 'home'.$count );
				} elseif(isset( $wp_customize )) {
					?>
                    <div class="widget widget-placeholder">
                    	<h3>Home <?php echo $count; ?></h3>
                    	<p>This is a placeholder and will not be visible to the public. Add content to this section with the "Widgets" tool.</p>
                    </div>
                    <?php
				} else {
					
				}?>
			</div>
		</div>
		<?php $count ++; } ?>
	</div>
	<!-- /row-->
	<?php  } /* ... end Homepage Builder */?>
	<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>
