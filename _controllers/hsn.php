<?php
    namespace Controller;

    include('hsn-menu.php');

    global $common;
    $common = array(
        'root' => root(),
        'categories' => model('hsn.php', 'CategoriesReadAll')
    );

    function Books($categoryId) {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/books.php', array_merge($common, array(
                'books' => model('hsn.php', 'BookReadByCategory', array($categoryId))
            )))
        )));
    }

    function About() {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/about.php', array_merge($common)
        ))));
    }

    function Notices() {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/notices.php', array_merge($common)
        ))));
    }

    function Editions() {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/editions.php', array_merge($common)
        ))));
    }

    function Location() {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/location.php', array_merge($common)
        ))));
    }

    function Contact() {
        global $common;

        return view('hsn/hsn.php', array_merge($common, array(
            'content' => view('hsn/contact.php', array_merge($common)
        ))));
    }
?>