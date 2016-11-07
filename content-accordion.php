<article id="post-<?php the_ID(); ?>" <?php post_class('accordion-post col-sm-12'); ?>>
	<label for="accordion-<?php the_ID(); ?>" class="accordion-post-title row">
		<div class="col-sm-12">
			<?php the_title('<h3><strong>', '</strong></h3>'); ?>
		</div>
	</label>
	<input type="radio" name="focal-areas" id="accordion-<?php the_ID(); ?>" class="accordion-radio">
	<section class="accordion-post-body row">
		<div class="col-sm-12 accordion-post-body-inner">
			<?php the_content(); ?>
		</div>
	</section>
</article>
