<x-app-layout>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Laravel Yajra Datatable</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


        <style>
            #add {
                margin-bottom: 3%;
                text-align: right;
            }

            .mb-4 {
                color: grey;
                font-family: lobster;
                font-weight: bold;
                font-size: 50px;
            }

            #table_1 {
                background-color: grey;
            }

            #table_1 thead tr th {

                color: whitesmoke;
            }
        </style>
    </head>

    <body>





        <div class="container mt-5">
            @if(auth()->user()->is_admin)
            <h1>Welcome to Admin Panel</h1>
            <br>
            <br>
            @else
            <h1>Welcome to User Panel</h1>
            <br>
            <br>
            @endif
            <h2 class="mb-4" align="center">Dashboard</h2>
            <!-- Form Header -->

            <table class="table table-bordered yajra-datatable" id="table_1">
                <span id="form_result"></span>
                <thead>
                    <tr>

                        <th><b>#</b></th>
                        <th><b>Post Title</b></th>
                        <th><b>Post Description</b></th>
                        <th><b>Post Category</b></th>
                        <th><b>Posted By</b></th>
                        <th><b>Image</b></th>
                        @if(auth()->user()->is_admin)
                        <th class="action"><b>Action</b></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


            <!-- Edit Data Modal -->
             @include("editform")

            <!-- Delete Form Field -->

            @include("/deleteform")

        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script> -->
    </body>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


    <script type="text/javascript">
        // Fecthing yajra DataTable
        $(document).ready(function() {
            var id = "{{auth()->user()->is_admin}}";
            if (id == false) {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('dashboard') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'post_text',
                            name: 'post_text'
                        },
                        {
                            data: 'category.name',
                            name: 'category'
                        },
                        {
                            data: 'user.name',
                            name: 'user'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },

                    ]
                });
            } else {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('dashboard') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'post_text',
                            name: 'post_text'
                        },
                        {
                            data: 'category.name',
                            name: 'category'
                        },
                        {
                            data: 'user.name',
                            name: 'user'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }

            // Edit Form record

            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                var id = $(this).attr('id');
                $('#formModal').modal('show');
                $('#form_result').html('');
                $.ajax({
                    url: "posts" + '/' + id + '/' + "edit",
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        $('#title').val(data.result.title);
                        $('#post_text').val(data.result.post_text);
                        $('#Category').val(data.result.category.name);
                        $("#img").attr("src", 'storage/' + data.result.image);
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Record');
                        $('#action').val('Edit');
                        $('#action_button').val('Update');
                        $('#formModal').modal('show');



                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                })
            });


            // update post ajax request

            $('#edit_sample_form').on('submit', function(event) {
                event.preventDefault();
                var hide_id = $("#hidden_id").val();
                let data = new FormData($('#edit_sample_form')[0]);
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "posts/" + hide_id + '/',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('success:' + response);
                        var html = '';
                        if (response.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < response.errors.length; count++) {
                                html += '<p>' + response.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#formModal').modal(' ');
                        }
                        if (response.success) {
                            html = '<div class="alert alert-success">' + response.success + '</div>';
                            $('#edit_sample_form')[0].reset();
                            $('.yajra-datatable').DataTable().ajax.reload();
                            $('#formModal').modal('hide');
                        }

                        $('#form_result').html(html);
                    },

                });
            });


            //    Delete Record using id
            var data_id;

            $(document).on('click', '.delete', function() {
                data_id = $(this).attr('id');
                $('.modal-title').text('Confirmation..');
                $('#confirmModal').modal('show');
                $('#form_result').val('Data Deleted Succesfully');

            });

            $('#ok_button').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "posts" + '/' + data_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#ok_button').text('Deleting...');
                    },
                    success: function(data) {

                        $('#confirmModal').modal('hide');
                        $('.yajra-datatable').DataTable().ajax.reload();
                        $('#ok_button').text('YES');

                    }

                })
            });

        });
    </script>

    </html>
</x-app-layout>