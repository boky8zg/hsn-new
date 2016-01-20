<?php
/* Includes */
     include('framework/engine.php');
    
/* Constants */
    define('APP_NAME', 'HSN');

/* Public routes */
    route('/css/*', function () {
        header('Content-Type: text/css');
        get_public();
    });

    route('/js/*', function () {
        header('Content-Type: text/javascript');
        get_public();
    });

    route('/fonts/*', function () {
        header('Content-Type: */*');
        get_public();
    });

    route('/images/*', function () {
        if (fnmatch(route(), '/images/*.jpg')) {
            header('Content-Type: image/jpeg');
        }
        elseif (fnmatch(route(), '/images/*.png')) {
            header('Content-Type: image/png');
        }
        else {
            header('Content-Type: image/*');
        }

        get_public();
    });

/* Site routes */
    route('/', function () {
        header('Location: /biblioteke/1/');
    });

    route('/biblioteke/*/', function () {
        controller('hsn.php', 'Books', array(param(1)));
    });

    route('/o-nama/', function () {
        controller('hsn.php', 'About');
    });

    route('/obavijesti/', function () {
        controller('hsn.php', 'Notices');
    });

    route('/izdanja/', function () {
        controller('hsn.php', 'Editions');
    });

    route('/lokacija/', function () {
        controller('hsn.php', 'Location');
    });

    route('/kontakt/', function () {
        controller('hsn.php', 'Contact');
    });

/* Admin routes */
    route('/admin', function () {
        header('Location: /admin/');
    });

    route('/admin/', function () {
        controller('admin.php', 'Main');
    });

    route('/admin/login/', function () {
        controller('admin.php', 'Login');
    });

    route('/admin/knjige/', function () {
        header('Location: /admin/knjige/1/');
    });

    route('/admin/knjige/*/', function () {
        controller('admin.php', 'Books', array(param(2)));
    });

    route('/admin/knjiga/edit/*/', function () {
        controller('admin.php', 'EditBook', array(param(3)));
    });
    
    route('/admin/knjiga/update/', function () {
        controller('admin.php', 'BookUpdate', array(
            $_POST['IDBook'],
            $_POST['Categories'],
            $_POST['Authors'],
            $_POST['Title'],
            $_POST['Subtitle'],
            isset($_POST['ShowSubtitle']) ? $_POST['ShowSubtitle'] : '',
            $_POST['PublicationYear'],
            $_POST['ISBN'],
            $_POST['Price'],
            $_POST['DiscountPrice'],
            $_POST['Format'],
            $_POST['Binding'],
            $_POST['Pages'],
            $_POST['Description'],
            $_POST['OldCover'],
            $_FILES['Cover'],
            isset($_POST['IsInGallery']) ? $_POST['IsInGallery'] : ''
        ));
    });
    
    route('/admin/knjiga/new/', function () {
        controller('admin.php', 'NewBook');
    });
    
    route('/admin/knjiga/insert/', function () {
        controller('admin.php', 'BookInsert', array(
            $_POST['Categories'],
            $_POST['Authors'],
            $_POST['Title'],
            $_POST['Subtitle'],
            isset($_POST['ShowSubtitle']) ? $_POST['ShowSubtitle'] : '',
            $_POST['PublicationYear'],
            $_POST['ISBN'],
            $_POST['Price'],
            $_POST['DiscountPrice'],
            $_POST['Format'],
            $_POST['Binding'],
            $_POST['Pages'],
            $_POST['Description'],
            $_FILES['Cover'],
            isset($_POST['IsInGallery']) ? $_POST['IsInGallery'] : ''
        ));
    });
    /*
    route('/admin/knjiga/delete/', function () {
        controller('admin.php', 'DeleteBook', array(param(2)));
    });
    */
    route('/admin/obavijesti/', function () {
        header('Location: /admin/obavijesti/1/');
    });

    route('/admin/obavijesti/*/', function () {
        controller('admin.php', 'Notices', array(param(2)));
    });
    
    route('/admin/obavijest/edit/*/', function () {
        controller('admin.php', 'EditNotice', array(param(3)));
    });
    
    route('/admin/obavijest/update/', function () {
        controller('admin.php', 'NoticeUpdate', array(
            $_POST['IDNotice'],
            $_POST['Title'],
            $_POST['Text'],
            isset($_POST['IsPinned']) ? '1' : '0'
        ));
    });
    
    route('/admin/obavijest/new/', function () {
        controller('admin.php', 'NewNotice');
    });
    
    route('/admin/obavijest/insert/', function () {
        controller('admin.php', 'NoticeInsert', array(
            $_POST['Title'],
            $_POST['Text'],
            isset($_POST['IsPinned']) ? $_POST['IsPinned'] : ''
        ));
    });
    /*
    route('/admin/obavijest/delete/', function () {
        controller('admin.php', 'NoticeDelete', array(param(2)));
    });
    */
    route('/admin/gallery/images/', function () {
        controller('admin.php', 'ListGalleryImages');
    });

    route('/admin/gallery/images/upload/', function () {
        controller('admin.php', 'UploadGalleryImage');
    });

    route('/admin/import/', function () {
        controller('admin.php', 'ImportBooks');
    });

/* 404 */
    route('/404/', function () {
        controller('hsn.php', 'NotFound');
    });

    route404(function () {
        header('Location: /404/');
    });
?>
