$(document).ready(function(){
    $('#button-addon2').on('click', function() {
        $.ajax({
            url: './Home/addTask',
            method: 'POST',
            dataType: 'JSON',
            data:  {
                task: $('input[name="task"]').val()
            },
            success: function (data) {
                console.log(data);
            },
            error: function (jqXHR, status, errorThrown) {
                console.log(jqXHR);
                console.log(status);
                console.log(errorThrown);

            }
        }).fail(function () {
            console.log('fail')
        })
    })

});