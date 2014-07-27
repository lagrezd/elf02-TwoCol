<?php

    defined('ABSPATH') OR exit;


    final class twocol_base {

        /**
         * Rev file handling
         */
        public static $css_rev_name = 'style.min.css';
        public static $js_rev_name = 'scripts.min.js';



        /**
         * Singleton
         */
        private static $instance = null;

        public static function instance() {
            if(NULL === self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }


        /**
         * Constructor
         */
        private function __construct() {
            // Clean up
            add_filter('show_admin_bar', '__return_false');
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'noindex', 1);
            remove_action('wp_head', 'rel_canonical');

            // Custom assets loader
            add_action(
                'wp_enqueue_scripts',
                array(
                    $this,
                    'assets_loader'
                )
            );

            // Exclude specific category from main loop
            add_action(
                'pre_get_posts',
                array(
                    $this,
                    'exclude_specific_cats'
                )
            );

            // Thumbnail jpeg compression
            add_filter('jpeg_quality',
                function($arg) { return 95; }
            );

            // Image post format
            add_theme_support('post-formats',
                array(
                    'image'
                )
            );
        }


        /**
         * Exclude specific category from main loop
         */
        public function exclude_specific_cats($wp_query) {
            if(!is_admin() && is_main_query() && is_home()) {
                // Pictures
                $wp_query->set('cat', '-4,-31');
            }
        }


        /**
         * Pagination without plugins
         * @author https://github.com/toddmotto/html5blank
         */
        public static function pagination() {
            global $wp_query;
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => '«',
                'next_text' => '»'
            ));
        }


        /**
         * Custom assets loader
         */
        public function assets_loader() {

            // google font css
            wp_register_style(
                'gf',
                'http://fonts.googleapis.com/css?family=Open+Sans:400,600',
                array(),
                null,
                'all'
            );
            wp_enqueue_style('gf');

            // TwoCol css
            wp_register_style(
                'twocol',
                self::template_uri(sprintf('%s%s',
                    'dist/css/',
                    self::$css_rev_name
                )),
                array(),
                null,
                'all'
            );
            wp_enqueue_style('twocol');


            // jquery 1.11.0
            /*if (!is_admin()) {
                wp_deregister_script('jquery');
                wp_register_script(
                    'jquery',
                    'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
                    array(),
                    null,
                    true
                );
                wp_enqueue_script('jquery');
            }

            // TwoCol js
            wp_register_script(
                'twocol',
                self::template_uri(sprintf('%s%s',
                    'dist/js/',
                    self::$js_rev_name
                )),
                array(),
                null,
                true
            );
            wp_enqueue_script('twocol');*/
        }


        /**
         * SEO stuff
         * @author http://digwp.com/2013/08/basic-wp-seo/
         */
        public static function basic_wp_seo() {
            global $post;
            $default_keywords = 'Webentwicklung, Web Development, WordPress, WooCommerce, Plugins, Themes, Laravel, Web-Apps, php, css, html, jQuery, js, Fotografie, Photography, Bilder, Pictures';
            $default_description = 'Hallo! Mein Name ist Christopher. Ich bin Webentwickler für PHP, CSS3/HTML5, WordPress+WooCommerce und Laravel.';
            $output = array();

            // description
            $description = $default_description;
            $pagedata = get_post($post->ID);
            if(is_singular()) {
                if(!empty($pagedata)) {
                    $description = apply_filters('the_excerpt_rss', $pagedata->post_content);
                    $description = substr(trim(strip_tags($description)), 0, 155);
                    $description = preg_replace('#\n#', ' ', $description);
                    $description = preg_replace('#\s{2,}#', ' ', $description);
                    $description = trim($description);
                } else {
                    $description = $default_description;
                }
            } else {
                $description = $default_description;
            }
            $output[] = '<meta name="description" content="' . esc_attr($description) . '">';

            // keywords
            $cats = get_the_category();
            $tags = get_the_tags();
            $keys = '';
            if (!empty($cats)) foreach($cats as $cat) $keys .= $cat->name . ', ';
            if (!empty($tags)) foreach($tags as $tag) $keys .= $tag->name . ', ';
            $keys .= $default_keywords;
            $output[] = '<meta name="keywords" content="' . esc_attr($keys) . '">';

            // robots
            $robots = '';
            if (is_category() || is_tag()) {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                if ($paged > 1) {
                    $robots =  '<meta name="robots" content="noindex,follow">';
                } else {
                    $robots =  '<meta name="robots" content="index,follow">';
                }
            } else if (is_home() || is_singular()) {
                $robots = '<meta name="robots" content="index,follow">';
            } else {
                $robots = '<meta name="robots" content="noindex,follow">';
            }
            $output[] = $robots;

            // title
            $name = 'elf02 - Webentwicklung & Fotografie';
            $title = wp_title('|', false);
            $seo_title = $name . $title;
            $output[] = '<title>' . esc_attr($seo_title) . '</title>';

            // canonical
            if(is_singular()) {
                $output[] = '<link rel="canonical" href="' . get_permalink() . '">';
            } else if(is_front_page()) {
                $output[] = '<link rel="canonical" href="' . get_bloginfo('url') . '">';
            }

            return implode("\n", $output) . "\n";
        }


        /**
         * link helper
         */
        public static function link($link='', $name='', $title='', $class='') {
            printf('<a href="%s"%s%s>%s</a>',
                get_bloginfo('url').'/'.$link,
                (!empty($title)) ? ' title="'.$title.'"' : '',
                (!empty($class)) ? ' class="'.$class.'"' : '',
                (!empty($name)) ? $name : $link
            );
        }


        /**
         * get_template_directory_uri helper
         */
        public static function template_uri($path = '') {
            if(substr($path, 0, 1) != '/') $path = '/'.$path;
            return get_template_directory_uri() . $path;
        }


        /**
         * Multiple get_template_part
         */
        public static function get_template_parts($parts = array()) {
            foreach($parts as $part) {
                $a = explode(';', $part);
                if(isset($a[1])) {
                    get_template_part($a[0], $a[1]);
                } else {
                    get_template_part($a[0]);
                }
            };
        }


        /**
         * Debug array helper
         */
        public static function print_a($a) {
            printf('<pre>%s</pre>', print_r($a, true));
        }


        /**
         * Get german day
         */
        public static function get_day() {
            $german_days = array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag');
            $day = date('w');
            echo $german_days[$day];
        }


        /**
         * Get title for linked post
         */
        public static function get_linked_title() {
            $link = get_post_meta(get_the_ID(), 'link', true);

            if(empty($link)) {
                $link = (is_single()) ?
                    get_the_title() :
                    sprintf('<a href="%s">%s</a>', get_permalink(), get_the_title());
            } else {
                $link = sprintf('<a href="%s">&infin; %s</a>', $link, get_the_title());
            }

            echo $link;
        }

    }
?>
