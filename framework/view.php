<?php
    function view($file, $array = NULL) {
        ob_start();
        include(ROOT . '/' . VIEWS_PATH . '/' . $file);
        return format(ob_get_clean(), $array);
    }

    function load($file, $data = NULL) {
        ob_start();
        include(ROOT . '/' . VIEWS_PATH . '/' . $file);
        return ob_get_clean();
    }

    function starteach($array, $param_name = 'value') {
        global $each_parameter;
        global $each_param_name;
        
        $each_parameter = $array;
        $each_param_name = $param_name;

        ob_start();
    }

    function endeach() {
        global $each_parameter;
        global $each_param_name;

        $html = ob_get_clean();
        
        foreach ($each_parameter as $param) {
            if (is_array($param)) {
                echo format($html, $param);
            } else {
                echo format($html, array($each_param_name => $param));
            }
        }
    }
?>