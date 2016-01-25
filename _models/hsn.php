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

            if ($outp[$key]['DiscountPrice']) {
                $outp[$key]['DiscountPrice'] = number_format($outp[$key]['DiscountPrice'], 2, ',', ' ') . ' kn';
            }

            if ($outp[$key]['Description']) {
                $outp[$key]['Description'] = $outp[$key]['Description'] . '<br><br>';
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

    function CategoriesReadAll() {
        $c = new \Connection();

        $outp = $c->call('CategoriesReadAll');

        return $outp;
    }

    function NoticesRead($start, $number) {
        $c = new \Connection();
        $count = $c->call('NoticesCount');

        $c = new \Connection();
        $pinned = $c->call('NoticesReadPinned', array(0, 5));           /* Max 5 pinned notices */

        $c = new \Connection();
        $unpinned = $c->call('NoticesReadUnpinned', array($start, $number));
        
        return array(
            'pinned' => $pinned,
            'unpinned' => $unpinned,
            'pages' => ceil(intval($count[0]['Count']) / $number),
            'page' => ($start / $number) + 1
        );
    }
?>
