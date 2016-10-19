<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cornerstone
 */

get_header(); ?>
<div id="page-archive">
	<div class="row">
		<div class="col-sm-9">
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">	
				<?php if ( have_posts() ) : ?>
					<header class="entry-header">
                    
						<h1 class="page-title">
							<?php
								if ( is_category() ) :
									single_cat_title();
		
								elseif ( is_tag() ) :
									single_tag_title();
		
								elseif ( is_author() ) :
									printf( __( 'Author: %s', 'cs' ), '<span class="vcard">' . get_the_author() . '</span>' );
		
								elseif ( is_day() ) :
									printf( __( 'Day: %s', 'cs' ), '<span>' . get_the_date() . '</span>' );
		
								elseif ( is_month() ) :
									printf( __( 'Month: %s', 'cs' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cs' ) ) . '</span>' );
		
								elseif ( is_year() ) :
									printf( __( 'Year: %s', 'cs' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cs' ) ) . '</span>' );
		
								elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
									_e( 'Asides', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
									_e( 'Galleries', 'cs');
		
								elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
									_e( 'Images', 'cs');
		
								elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
									_e( 'Videos', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
									_e( 'Quotes', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
									_e( 'Links', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
									_e( 'Statuses', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
									_e( 'Audios', 'cs' );
		
								elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
									_e( 'Chats', 'cs' );
									
								elseif ( is_tax( 'group') || is_tax('persontag')):
									global $wp_query;
									$term = $wp_query->get_queried_object();
									$name = $term->name;
									echo $name;
		
								else :
									_e( 'Archives', 'cs' );
		
								endif;
							?>
						</h1>
						<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;
						?>
					</header><!-- .page-header -->
		
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
		
						<?php
							if ( is_tax( 'group') || is_tax('persontag')){
								get_template_part( 'content', 'person' );
							} else {
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							}
						?>
		
					<?php endwhile; ?>
		
					<?php cs_paging_nav(); ?>
		
				<?php else : ?>
		
					<?php get_template_part( 'content', 'none' ); ?>
		
				<?php endif; ?>
		
				</main><!-- #main -->
			</section><!-- #primary -->
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
