<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ChrisB">
    <?php echo twocol_base::basic_wp_seo(); ?>
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//platform.twitter.com">
    <link rel="shortcut icon" href="<?php echo twocol_base::template_uri('/img/favicon.png'); ?>" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo twocol_base::template_uri('/img/apple-touch-icon-precomposed.png'); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div class="page-main wrap">
        <div class="grid">
            <div class="page-main__left col-12-8">
