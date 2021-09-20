$(function () {
    $('body').on('click', '.del', function (e) {
        const id = $(this).attr('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const api = "http://127.0.0.1:8000/api/";
        $.ajax({
            type: "POST",
            url: api + "prijave/" + id,
            data: {
                _method: 'DELETE',
            },
            success: function (response) {
                alert(response.poruka)
            }
        });
    });

});
