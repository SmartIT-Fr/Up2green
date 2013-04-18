$(function() {
    // Wall
    var modal = $('#modal');

    function resizeModalSize() {
        $('.modal-body', modal).css('max-height', ($(window).height() * .62)+'px');
    }

    if (modal) {

        resizeModalSize();
        $(window).resize(resizeModalSize);

        var modalBody = $('.modal-body', modal);

        $("a.classroom-picture-modal").click(function(e){
            e.preventDefault();

            $.get($(this).attr('href'), function(data){
                modalBody.html(data);
                modal.modal();
            });

        });

    }
});