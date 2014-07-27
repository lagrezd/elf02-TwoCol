    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ChrisB">

    <?php echo twocol_base::basic_wp_seo(); ?>

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="shortcut icon" href="<?php echo twocol_base::template_uri('/dist/img/favicon.png'); ?>" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo twocol_base::template_uri('/dist/img/apple-touch-icon-precomposed.png'); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@_elf02">
    <meta name="twitter:domain" content="elf02.de">
    <meta name="twitter:creator" content="@_elf02">
    <meta name="twitter:title" content="elf02 - Webentwicklung & Fotografie">
    <meta name="twitter:description" content="Hallo! Mein Name ist Christopher. Ich bin Webentwickler für PHP, CSS3/HTML5, WordPress+WooCommerce und Laravel.">

    <?php wp_head(); ?>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->