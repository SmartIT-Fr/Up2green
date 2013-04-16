$(function() {
    // Wall
    modal = $('#modal');

    if (modal) {

        $('.modal-body', modal).css('max-height', ($(window).height() * .62)+'px');

        $(window).resize(function() {
            $('.modal-body', modal).css('max-height', ($(window).height() * .62)+'px');
        });

        modalBody = $('.modal-body', modal);

        $("a.classroom-picture-modal").click(function(e){
            e.preventDefault();

            $.get($(this).attr('href'), function(data){
                modalBody.html(data);
                modal.modal();
            });

        });

    }
});