<?php
    function Menu() {
        $menu = array(
            array('Dashboard', '/admin/', '/admin/'),
            array('Knjige', '/admin/knjige/*', '/admin/knjige/'),
            array('Obavijesti', '/admin/obavijesti/*', '/admin/obavijesti/')
        );

        foreach ($menu as $key => $value) {
            $menu[$key][3] = fnmatch($value[1] ,route()) ? ' class="active"' : '';
        }

        return $menu;
    }
?>