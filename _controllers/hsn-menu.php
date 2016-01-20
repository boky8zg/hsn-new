<?php
    function Menu() {
        $menu = array(
            array('O nama', '/o-nama/', '/o-nama/'),
            array('Obavijesti', '/obavijesti/', '/obavijesti/'),
            array('Biblioteke', '/biblioteke/*/', '/'),
            array('Izdanja', '/izdanja/', '/izdanja/'),
            array('Lokacija', '/lokacija/', '/lokacija/'),
            array('Kontakt', '/kontakt/', '/kontakt/'),
        );

        foreach ($menu as $key => $value) {
            $menu[$key][3] = fnmatch($value[1], route()) ? ' class="active"' : '';
        }

        return $menu;
    }
?>