<?php 

get_header(); ?>

<main>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<article>
		<h1><?php the_title(); ?></h1>
		<?php the_content();?>
	</article>

	
	<?php } ?>

	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
</main>

<?php get_footer(); ?>