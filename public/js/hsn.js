if (!String.prototype.format) {
    String.prototype.format = function () {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function (match, number) {
            return typeof args[number] != 'undefined' ? args[number] : match;
        });
    };
}

function display_book_info($book) {
    var authorsTemplate = '<span>{0}</span>';
    var authors = '';
    var descr = $book.data('description');
    var price = $book.find('.price').text();
    var title = $book.find('.title').text();
    var subtitle = $book.data('subtitle');

    $book.find('h4').each(function (key, $author) {
        authors += '<span>' + $author.innerText + '</span>';
    });

    /*
    for (var i = 0; i < books[id]['Autori'].length; i++) {
        authors += authorsTemplate.format(books[id]['Autori'][i]);
    }

    if (books[id].Opis == null) {
        descr += 'Nema opisa<br /><br />';
    } else {
        descr += 'Opis:<br />' + books[id].Opis + '<br /><br />';
    }

    if (books[id].ISBN != null) {
        descr += 'ISBN: ' + books[id].ISBN + '<br />';
    }

    if (books[id].BrojStranica != null) {
        descr += 'Broj stranica: ' + books[id].BrojStranica + '<br />';
    }

    if (books[id].FormatCmID != null) {
        var id = parseInt(books[id].FormatCmID);

        descr += 'Format: ' + formats[id].w + 'x' + formats[id].h + 'cm <br />';
    }

    price = price == null ? 'Rasprodano' : price + ' kn';
    */
    $('.main-title').html(title);
    $('.subtitle').html(subtitle);
    $('.book-authors').html(authors);
    $('.book-summary').html(descr);
    $('.book-price').html(price);
}

$(function () {
    $('.scrollbar-inner').scrollbar();

    $('#library .book').click(function () {
        display_book_info($(this));

        $('.book').removeClass('active');
        $(this).addClass('active');

        $('.wrapper').addClass('show-info-bar');
        $('.info-bar>.book-summary-wrapper').css('top', $('.info-bar-header').outerHeight() + $('.book-authors').outerHeight());
    });

    $('#close-sidebar').click(function () {
        $('.wrapper').removeClass('show-info-bar');
    });

    $('.navbar-left a:contains(Biblioteke)').click(function (e) {
        $('.navbar-categories').fadeToggle();
        $('.navbar-categories a').each(function () {
            $(this).attr('href', '/biblioteke/' + $(this).data('href') + '/');
        });
        e.preventDefault();
    });
    $('.navbar-left a:contains(Izdanja)').click(function (e) {
        $('.navbar-categories').fadeToggle();
        $('.navbar-categories a').each(function () {
            $(this).attr('href', '/izdanja/' + $(this).data('href') + '/');
        });
        e.preventDefault();
    });

    /*
    $('#submit-mail').on('click', function (e) {
    $.ajax({
    type: 'POST',
    url: 'send-email.php',
    data: $('#form-contact').serialize()
    })
    .done(function (data) {
    console.log(data);
    if (data == 'true') {
    $('#form-modal-success').modal();
    $('#form-contact')[0].reset();
    } else {
    $('#form-modal-fail').modal();
    }
    })
    .fail(function () {
    $('#form-modal-fail').modal();
    });

    e.preventDefault();
    });
    */
});