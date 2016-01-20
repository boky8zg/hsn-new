$(function () {
    $('.richedit').wysihtml5();
    $('.modal-dialog').addClass('modal-lg');
    $('.modal-footer').prepend('<button class="btn btn-default btn-upload"><span>Upload slike</span><input type="file" class="upload" /></button>')
    $('.btn-upload').css({
        position: 'relative',
        overflow: 'hidden',
        margin: '10px'
    });
    $('.upload').css({
        position: 'absolute',
        top: 0,
        right: 0,
        margin: 0,
        padding: 0,
        fontSize: '20px',
        cursor: 'pointer',
        opacity: 0,
        filter: 'alpha(opacity=0)'
    });
    var $imageUrl = $('.bootstrap-wysihtml5-insert-image-url');
    var $modalBody = $('.modal-body');

    $.getJSON('/admin/gallery/images/').done(function (data) {
        DisplayImages(data);
    });

    $modalBody.on('click', 'img', function () {
        $imageUrl.val($(this).attr('src'));
    });

    $('.btn-upload')[1].onchange = function (e) {
        console.log(e.target.files[0]);

        $('.btn-upload')[1].value = 'Pričekajte...';

        var data = new FormData();
        data.append('file', e.target.files[0]);

        $.ajax({
            url: '/admin/gallery/images/upload/',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false
        }).done(function (data) {
            DisplayImages(data);
            $('.btn-upload')[1].value = 'Upload slike';
        });
    }
});

function DisplayImages(images) {
    $modalBody = $('.modal-body');

    $modalBody.find('img').remove();

    images.forEach(function (image) {
        $modalBody.append('<img style="padding: 5px; height: 200px;" src="/images/upload/' + image + '" />');
    });
}