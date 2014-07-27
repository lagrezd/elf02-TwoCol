<?php

    get_template_part('templates/header', get_post_format());


    if (have_posts()) :

        while (have_posts()) : the_post();

            get_template_part('templates/content', get_post_format());

        endwhile;

    else :

        get_template_part('templates/content', 'none');

    endif;


    get_template_part('templates/footer', get_post_format());

?>