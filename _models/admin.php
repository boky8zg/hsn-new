<?php
    namespace Model;

    function Books($start, $number) {
        $c = new \Connection();

        $count = $c->call('BooksCount');

        return array(
            'books' => $c->call('BooksRead', array($start, $number)),
            'pages' => ceil(intval($count[0]['Count']) / $number),
            'page' => ($start / $number) + 1
        );
    }

    function Edit($id) {
        $c = new \Connection();

        $outp = $c->multi_call('BookRead', array($id));

        if ($outp != FALSE) {
            return array_merge($outp[0][0], array(
                'categories' => $outp[1],
                'authors' => $outp[2],
                'allCategories' => $c->call('CategoriesReadAll'),
                'allAuthors' => $c->call('AuthorsReadAll')
            ));
        }

        return FALSE;
    }

    function Update($id, $categories, $title, $subtitle, $showSubtitle, $authors, $publicationYear, $isbn, $price, $discountPrice, $width, $height, $binding, $pages, $description, $cover, $isInGallery) {
        $c = new \Connection();

        return $c->call('BookUpdate', array(
            $id,
            "'$categories'",
            $title == '' ? 'NULL' : "'$title'",
            $subtitle == '' ? 'NULL' : "'$subtitle'",
            $showSubtitle,
            "'$authors'",
            $publicationYear == '' ? 'NULL' : $publicationYear,
            "'$isbn'",
            $price == '' ? 'NULL' : $price,
            $discountPrice == '' ? 'NULL' : $discountPrice,
            $width,
            $height,
            "'$binding'",
            $pages,
            "'$description'",
            "'$cover'",
            $isInGallery
        ));
    }

    function NewBook() {
        $c = new \Connection();

        return array(
            'allCategories' => $c->call('CategoriesReadAll'),
            'allAuthors' => $c->call('AuthorsReadAll')
        );
    }

    function Insert($categories, $title, $subtitle, $showSubtitle, $authors, $publicationYear, $isbn, $price, $discountPrice, $width, $height, $binding, $pages, $description, $cover, $isInGallery) {
        $c = new \Connection();

        return $c->call('BookCreate', array(
            "'$categories'",
            $title == '' ? 'NULL' : "'$title'",
            $subtitle == '' ? 'NULL' : "'$subtitle'",
            $showSubtitle,
            "'$authors'",
            $publicationYear,
            "'$isbn'",
            $price,
            $discountPrice == '' ? 'NULL' : "'$discountPrice'",
            $width,
            $height,
            "'$binding'",
            $pages,
            "'$description'",
            $cover == '' ? 'NULL' : "'$cover'",
            $isInGallery
        ));
    }

    function Notices($start, $number) {
        $c = new \Connection();

        $count = $c->call('NoticesCount');

        return array(
            'notices' => $c->call('NoticesRead', array($start, $number)),
            'pages' => ceil(intval($count[0]['Count']) / $number),
            'page' => ($start / $number) + 1
        );
    }

    function NoticeCreate($title, $text, $isPinned) {
        $c = new \Connection();

        return $c->call('NoticeCreate', array(
            "'$title'",
            "'$text'",
            $isPinned
        ));
    }

    function EditNotice($id) {
        $c = new \Connection();

        $outp = $c->call('NoticeRead', array($id));

        return $outp[0];
    }

    function NoticeUpdate($id, $title, $text, $isPinned) {
        $c = new \Connection();

        return $c->call('NoticeUpdate', array($id, "'$title'", "'$text'", $isPinned));
    }
?>