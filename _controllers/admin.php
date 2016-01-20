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

        $booksPerPage = 25;

        return view('admin/admin.php', array_merge($common, array(
            'content' => view('admin/books.php', 
                model('admin.php', 'Books', array(($page - 1)*$booksPerPage, $booksPerPage))
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

    function ImportBooks() {
        if (!isset($_POST['submit'])) {
?>
        <form enctype="multipart/form-data" method="post" action="">
            <input type="file" name="file" />
            <input type="submit" name="submit" />
        </form>
<?php
        } else {
            $file = fopen($_FILES['file']['tmp_name'], 'r');
            $c = new \Connection();
            $line = fgets($file);
            echo '<html><head><meta charset="utf-8" /></head><body>';
            echo '<table borders="1">';

             while (($line = fgets($file)) != FALSE) {
                $cell = explode("\t", $line);

                if ($cell[5]) {
                    $format = explode('x', $cell[5]);
                    $width = str_replace(',', '.', $format[0]);
                    $height = str_replace(',', '.', $format[1]);
                } else {
                    $width = "0";
                    $height = "0";
                }

                foreach ($cell as $key => $val) {
                    $cell[$key] = FormatIt($cell[$key]);
                }

                //$c->call('BookCreate', array($cell[0], $cell[2], $cell[3], 0, $cell[1], $cell[8], $cell[4], $cell[7], "NULL", $width, $height, $cell[6], $cell[9], $cell[10], $cell[11], 1));

                //echo "<tr><td>$cell[0]</td><td>$cell[1]</td><td>$width</td><td>$height</td></tr>";
                echo "<tr><td>";
                echo "CALL BookCreate($cell[0], $cell[2], $cell[3], 0, $cell[1], $cell[8], $cell[4], $cell[7], NULL, $width, $height, $cell[6], $cell[9], $cell[10], $cell[11], 1);";
                echo "</td></tr>";
             }

             echo '</table></body></html>';
        }
    }

    function FormatIt($value) {
        $value = trim($value);

        if ($value == '') {
            return 'NULL';
        }

        if (is_numeric($value)) {
            return $value;
        }
        
        $value = str_replace("'", "''", $value);
        return "'$value'";
    }
?>