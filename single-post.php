<?php get_header(); ?>
<?php if ( have_posts() ): while ( have_posts() ): the_post() ?>
    <p>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: auto; margin-top: 2px">
    </p>
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(); ?> </p>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
