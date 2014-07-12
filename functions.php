<?php

    require_once(
        sprintf(
            '%s/inc/%s.class.php',
            dirname(__FILE__),
            'twocol_base'
        )
    );


    twocol_base::$css_rev_name = 'style.min-fe855e4b.css';
    twocol_base::$js_rev_name = 'scripts.min-f2b616f8.js';


    add_action(
        'init',
        array(
            'twocol_base',
            'instance'
        )
    );

?>
