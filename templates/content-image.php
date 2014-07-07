<article id="post-<?php the_ID(); ?>" <?php post_class('post--image'); ?>>
    <h1 class="post__title"><?php twocol_base::get_linked_title(); ?></h1>
    <time datetime="<?php the_time('Y-m-d'); ?>" class="post__time">—&nbsp;<?php the_time(get_option('date_format')); ?>&nbsp;—</time>
    <?php the_content('mehr...'); ?>
</article>