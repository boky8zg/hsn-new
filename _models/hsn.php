<?php
    namespace Model;

    function BookReadByCategory($categoryId) {
        $c = new \Connection();

        $outp = $c->call('BookReadByCategory', array($categoryId));

        foreach ($outp as $key => $val) {
            if ($outp[$key]['Price']) {
                $outp[$key]['Price'] = number_format($outp[$key]['Price'], 2, ',', ' ') . ' kn';
            } else {
                $outp[$key]['Price'] = 'Rasprodano';
            }

            if ($outp[$key]['Description']) {
                $outp[$key]['Description'] = 'Opis:<br>' . $outp[$key]['Description'] . '<br><br>';
            } else {
                $outp[$key]['Description'] = 'Nema opisa<br><br>';
            }

            if ($outp[$key]['ISBN']) {
                $outp[$key]['Description'] .= 'ISBN: ' . $outp[$key]['ISBN'] . '<br>';
            }

            if ($outp[$key]['Pages']) {
                $outp[$key]['Description'] .= 'Broj stranica: ' . $outp[$key]['Pages'] . '<br>';
            }

            if ($outp[$key]['Width'] && $outp[$key]['Height']) {
                $outp[$key]['Description'] .= 'Format: ' . $outp[$key]['Width'] . 'x' . $outp[$key]['Height'] . '<br>';
            }

            $authors = $c->call('BookReadAuthors', array($outp[$key]['IDBook']));
            $outp[$key]['Authors'] = $authors;
        }

        return $outp;
    }
?>
