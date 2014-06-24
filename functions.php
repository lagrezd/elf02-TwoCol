<?php

    require_once(
        sprintf(
            '%s/inc/%s.class.php',
            dirname(__FILE__),
            'twocol_base'
        )
    );


    add_action(
        'init',
        array(
            'twocol_base',
            'instance'
        )
    );

?>
