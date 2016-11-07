<?php $link = get_post_custom_values('post-external-link'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('panel-post col-md-4'); ?>>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12">
					<?php 
					echo '<a href="' . $link[0] . '">';
					the_post_thumbnail(); 
					echo '</a>';
					?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php the_title('<h1 class="panel-title"><a href="' . $link[0] . '">', '</a></h1>'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</article>
