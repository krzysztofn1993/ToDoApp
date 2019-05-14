$(document).ready(function() {
    $('#button-addon2').on('click', function() {
        let task = $('input[name="task"]').val();
        if (task == '' || task == undefined) {
            return;
        }
        $.ajax({
            url: './Home/addTaskAjax',
            method: 'POST',
            dataType: 'JSON',
            success: function(data) {
                addTaskToList(data);
            },
            data: {
                task: task
            }
        });
    });

    $(document).keypress(function(event) {
        if (event.keyCode == 13) {
            $('#button-addon2').click();
        }
    });

    function addTaskToList(data) {
        let wrapper = $('.wrapper');
        if (wrapper.children().length < 2) {
            wrapper.append('<ul class="list-group container my-4 tasks"></ul>');
        }

        $('input[name="task"]').val('');

        $('.list-group').prepend(
            '<li class="row tasks__positions align-items-start my-2" data-id="">' +
                '<div class="tasks__text col-lg-11 col-10 align-self-center">' +
                data[0] +
                '</div>' +
                '<div class="col-lg-1 col-2 px-0 d-flex justify-content-end">' +
                '<a href="#" class="btn btn-success tasks__done mx-1 my-1" tabindex="0">' +
                '<i class="far fa-check-square"></i>' +
                '</a>' +
                '</div>' +
                '</li>'
        );

        let allTasks = $('.tasks__positions');

        for (let index = 0; index < allTasks.length; index++) {
            $(allTasks[index]).attr('data-id', index);
        }
    }
});
