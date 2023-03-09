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
            text: "Uma vez excluído, você não poderá recuperar este arquivo!",
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


    // $('.form-check-input').click(function (e) {
    //     e.preventDefault();
    //     // var v = $('.form-check-input').val();
    //     console.log("chamou uma funçao");

    //  });



});


function statusDestaque (input, destaque_id){
    console.log(input.checked);
    var data = {
        "_token": $('input[name="_token"]').val(),
        "id": destaque_id,
        "status": input.checked,
    };
    console.log(data._token);
    $.ajax({
        type: "PUT",
        url: "/posts/destaque",
        data: data,
        success: function (data)
        {
            console.log(data)
        }, error: function(data){
            var erros = $.parseJSON(data.responseText);
            console.log(erros);
            }


    });
}
