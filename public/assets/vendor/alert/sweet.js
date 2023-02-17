$(document).ready(function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var delete_id = $(this).closest('tr').find('.delete').val();
        swal({
            title: "Você tem certeza?",
            text: "uma vez excluído, você não poderá recuperar este arquivo!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    var data = {
                        "_token": $('input[name="csrf-token"]').val(),
                        "id": delete_id,
                    };

                    $.ajax({
                        type: "DELETE",
                        url: "posts/delete/" + delete_id,
                        data: data,
                        success: function (data) {

                            swal({
                                icon: "success",
                            })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        }

                    });


                }
            });
    });
    $('.deletebtnPub').click(function (e) {
        e.preventDefault();
        var delete_id = $(this).closest('tr').find('.delete').val();
        swal({
            title: "Você tem certeza?",
            text: "uma vez excluído, você não poderá recuperar este arquivo!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    var data = {
                        "_token": $('input[name="csrf-token"]').val(),
                        "id": delete_id,
                    };

                    $.ajax({
                        type: "DELETE",
                        url: "publicidade/delete/" + delete_id,
                        data: data,
                        success: function (data) {

                            swal({
                                icon: "success",
                            })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        }

                    });


                }
            });
    });
});
