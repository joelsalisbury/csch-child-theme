<?php get_header(); ?>
<div id="page-archive">
	<div class="row">
		<div class="col-sm-9 col-push-sm-3">
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">	
					<header class="entry-header">
						<img src="http://dmd.dev.uconn.edu/csch/wp-content/uploads/sites/3/2016/09/CSCH_200px.png" alt="CSCH">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<?php while (have_posts()) : the_post(); ?>
						
					<?php endwhile; ?>
				</main>
			</section>
		</div>
		<div class="col-sm-3 col-pull-sm-9">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
