$(function() {
    // Wall
    modal = $('#modal');

    if (modal) {

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