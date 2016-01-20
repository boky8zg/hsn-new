<?php
    function format($string, $array) {
        $result = $string;
    
        foreach ($array as $key => $value) {
            if (!is_array($value)) {
                $result = str_replace('{{' . $key . '}}', $value, $result);
            }
        }
    
        return $result;
    }

    function str_format($string, $array) {
        $result = $string;
    
        foreach ($array as $key => $value) {
            $result = str_replace('{' . $key . '}', $value, $result);
        }
    
        return $result;
    }
?>