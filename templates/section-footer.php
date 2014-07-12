<div class="wrap">
    <ul class="nav">
    <?php
        $categories = get_categories();
        foreach($categories as $category) {
            printf('<li class="nav__item"><a href="%s/category/%s">#%s</a></li>', get_bloginfo('url'), $category->slug, $category->name);
        }
    ?>
    </ul>
    <p>&copy; 2012-<?php echo date("Y"); ?> <?php twocol_base::link('', 'elf02.de'); ?> | <?php twocol_base::link('impressum', 'Impressum'); ?></p>
</div>