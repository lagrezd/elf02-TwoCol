<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <h1 class="post__title"><?php the_title(); ?></h1>
    <?php the_content(); ?>
</article>