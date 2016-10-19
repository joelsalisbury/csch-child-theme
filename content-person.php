<?php

$information_to_display = get_field( "information_to_display" );


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php  if ( has_post_thumbnail() ) {
			echo '<div class="row">';
				echo '<div class="col-sm-2"><a href="'.get_permalink().'">';
					the_post_thumbnail();
				echo '</a></div>';
				echo '<div class="col-sm-10">';
		} ?>
		<header class="entry-header">
		<?php  
			echo '<h2 class="archive-person-name"><a href="'.get_permalink().'">';
			the_field('first_name');
			echo ' ';
			if (get_field('middle_name')){
				the_field('middle_name');
				echo ' ';
			}
			the_field('last_name'); 
			echo '</a></h2>';
		?>
		</header><!-- .entry-header -->
		
		
	
	
	<div class="entry-content clearfix subpage">
		<?php 
		
		echo '<p>'.get_field('title').'</p>';
		if (strlen(get_field('email')) . 0 ){
			echo '<p><a href="mailto:'.get_field('email').'">'.get_field('email').'</a></p>';
		}
		if (strlen(get_field('phone')) > 0 ){
			echo '<p>'.get_field('phone').'</p>';
		}
		
		?>
		
		
		
		
		<hr/>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cs' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( has_post_thumbnail() ) {
				echo '</div>';
			echo '</div>';	
		} ?>
</article><!-- #post-## -->
