<?php
    namespace Controller;

    include('admin-menu.php');

    global $common;
    $common = array(
        'root' => root()
    );

    function Main() {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/dashboard.php', $common)
        )));
    }

    function Books($page) {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/books.php', 
                model('admin.php', 'Books', array(($page - 1)*10, 10))
            )
        )));
    }

    /* TODO: Dodati u view da prikazuje sliku ako postoji */
    function EditBook($id) {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/edit.php', array_merge($common,
                model('admin.php', 'Edit', array($id))
            )),
            'styles' => array('bootstrap-tagsinput.css'),
            'scripts' => array('bootstrap-tagsinput.js')
        )));
    }

    function BookUpdate(
        $id,
        $categories,
        $authors,
        $title,
        $subtitle,
        $showSubtitle,
        $publicationYear,
        $isbn,
        $price,
        $discountPrice,
        $format,
        $binding,
        $pages,
        $description,
        $oldCover,
        $cover,
        $isInGallery)
    {
        $categories = join(', ', $categories);
        $authors = join(', ', $authors);
        $showSubtitle = $showSubtitle ? '1' : '0';
        $isInGallery = $isInGallery ? '1' : '0';
        $coverFilename = $oldCover;
        
        if ($cover['name'] != '') {
            $timestamp = time();
            $coverFilename = $oldCover == '' ? "cover$id-$timestamp" : $oldCover;

            if(file_exists(ROOT . "/public/images/covers/$coverFilename.jpg")) {
                chmod(ROOT . "/public/images/covers/$coverFilename.jpg", 0755);
                unlink(ROOT . "/public/images/covers/$coverFilename.jpg");
            }

            move_uploaded_file($cover['tmp_name'], ROOT . "/public/images/covers/$coverFilename.jpg");
        }
        
        $dimensions = split('x', $format);
        $width = $dimensions[0];
        $height = $dimensions[1];

        echo model('admin.php', 'Update', array(
            $id,
            $categories,
            $title,
            $subtitle,
            $showSubtitle,
            $authors,
            $publicationYear,
            $isbn,
            $price,
            $discountPrice,
            $width,
            $height,
            $binding,
            $pages,
            $description,
            $coverFilename,
            $isInGallery
        ));

        header("Location: /admin/knjiga/edit/$id/");
    }

    function NewBook() {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/new.php', array_merge($common,
                model('admin.php', 'NewBook')
            )),
            'styles' => array('bootstrap-tagsinput.css'),
            'scripts' => array('bootstrap-tagsinput.js')
        )));
    }

    function BookInsert(
        $categories,
        $authors,
        $title,
        $subtitle,
        $showSubtitle,
        $publicationYear,
        $isbn,
        $price,
        $discountPrice,
        $format,
        $binding,
        $pages,
        $description,
        $cover,
        $isInGallery)
    {
        $categories = join(', ', $categories);
        $authors = join(', ', $authors);
        $showSubtitle = $showSubtitle ? '1' : '0';
        $isInGallery = $isInGallery ? '1' : '0';
        $coverFilename = '';
        
        if ($cover['name'] != '') {
            $timestamp = time();
            $coverFilename = "cover-$timestamp";

            if(file_exists(ROOT . "/public/images/covers/$coverFilename.jpg")) {
                chmod(ROOT . "/public/images/covers/$coverFilename.jpg", 0755);
                unlink(ROOT . "/public/images/covers/$coverFilename.jpg");
            }

            move_uploaded_file($cover['tmp_name'], ROOT . "/public/images/covers/$coverFilename.jpg");
        }
        
        $dimensions = split('x', $format);
        $width = $dimensions[0];
        $height = $dimensions[1];

        echo model('admin.php', 'Insert', array(
            $categories,
            $title,
            $subtitle,
            $showSubtitle,
            $authors,
            $publicationYear,
            $isbn,
            $price,
            $discountPrice,
            $width,
            $height,
            $binding,
            $pages,
            $description,
            $coverFilename,
            $isInGallery
        ));

        header("Location: /admin/knjige/");
    }

    function Notices($page) {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/notices.php', 
                model('admin.php', 'Notices', array(($page - 1)*10, 10))
            )
        )));
    }

    function EditNotice($id) {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/editNotice.php', array_merge($common,
                model('admin.php', 'EditNotice', array($id))
            )),
            'styles' => array('bootstrap3-wysihtml5.css'),
            'scripts' => array('wysihtml5x-toolbar.min.js', 'handlebars.runtime.min.js', 'bootstrap3-wysihtml5.min.js', 'notice.js')
        )));
    }

    function NoticeUpdate($id, $title, $text, $isPinned) {
        echo model('admin.php', 'NoticeUpdate', array($id, $title, $text, $isPinned));

        header("Location: /admin/obavijesti/");
    }

    function NewNotice() {
        global $common;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/newNotice.php', $common),
            'styles' => array('bootstrap3-wysihtml5.css'),
            'scripts' => array('wysihtml5x-toolbar.min.js', 'handlebars.runtime.min.js', 'bootstrap3-wysihtml5.min.js', 'notice.js')
        )));
    }

    function NoticeInsert($title, $text, $isPinned) {
        echo model('admin.php', 'NoticeCreate', array(
            $title,
            $text,
            $isPinned ? '1' : '0'
        ));

        header("Location: /admin/obavijesti/");
    }

    function ListGalleryImages() {
        $files = scandir(ROOT . '/public/images/upload/');
        $outp = array();

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $outp[] = $file;
            }
        }

        header('Content-Type: application/json');
        return json_encode($outp);
    }

    function UploadGalleryImage() {
        if ($_FILES['file'] != '') {
            $timestamp = time();
            $filename = "upload-$timestamp";

            if(file_exists(ROOT . "/public/images/upload/$filename.jpg")) {
                chmod(ROOT . "/public/images/upload/$filename.jpg", 0755);
                unlink(ROOT . "/public/images/upload/$filename.jpg");
            }

            move_uploaded_file($_FILES['file']['tmp_name'], ROOT . "/public/images/upload/$filename.jpg");
        }

        return ListGalleryImages();
    }
?>