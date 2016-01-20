<?php
    global $is_routed;
    $is_routed = FALSE;

    function route($route = NULL, $method = NULL, $requestType = NULL) {
        global $is_routed;

        if (isset($route)) {
            if (!$is_routed) {
                if (fnmatch($route, REQUEST)) {
                    if (isset($requestType)) {
                        if ($requestType == $_SERVER['REQUEST_METHOD']) {
                            call_user_func($method);
                            $is_routed = TRUE;
                        }
                    } else {
                        call_user_func($method);
                        $is_routed = TRUE;
                    }
                }
            }
        } else {
            return REQUEST;
        }
    }
    
    function route404($method) {
        global $is_routed;
        
        if (!$is_routed) {
            call_user_func($method);
        }
    }
    
    function param($index) {
        $ret = explode('/', REQUEST);
        return $ret[$index + 1];
    }
    
    function root() {
        return HOST;
    }
?>