<?php

    add_action(
        'init',
        array(
            'twocol_base',
            'instance'
        )
    );


    spl_autoload_register('twocol_autoload');

    function twocol_autoload($class) {
        if(substr($class, 0, 7) === 'twocol_') {
            require_once(
                sprintf(
                    '%s/inc/%s.class.php',
                    dirname(__FILE__),
                    strtolower($class)
                )
            );
        }
    }

?>
