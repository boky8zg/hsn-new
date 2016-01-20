<?php
    function controller($file, $function = NULL, $params = array()) {
        include(ROOT . '/' . CONTROLLERS_PATH . '/' . $file);

        if (isset($function)) {
            echo call_user_func_array('Controller\\' . $function, $params);
        }
    }

    function get_public($file = NULL) {
        if (isset($file)) {
            readfile(ROOT . '/' . PUBLIC_PATH . '/' . $file);
        } else {
            readfile(ROOT . '/' . PUBLIC_PATH . '/' . REQUEST);
        }
    }
?>