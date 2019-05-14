$(document).ready(function() {
    $('ul').on('click', '.tasks__done', function() {
        $.ajax({
            url: './Home/removeTaskAjax',
            method: 'POST',
            dataType: 'JSON',
            success: function(data) {
                removeTaskFromList(data);
            },
            data: {
                task: $(this)
                    .closest('li')
                    .children('.tasks__text')
                    .text(),
                task_id: $(this)
                    .closest('li')
                    .data('id')
            }
        });
    });

    function removeTaskFromList(data) {
        $('li[data-id="' + data + '"]').fadeTo(250, 0, function() {
            setTimeout(function() {}, 250);
            $(this).remove();
        });
    }
});
