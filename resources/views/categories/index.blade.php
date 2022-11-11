<x-app-layout>

<!DOCTYPE html>
<html>
<head>
    <title>Laravel Yajra Datatable</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <style>

        #add{
            margin-bottom: 3%;
            text-align: right;
        }
        .mb-4{
            color: grey;
             font-family : lobster;
             font-weight: bold;
             font-size: 50px;
        }

        #table_1{
            background-color: grey;
        }
        #table_1 thead tr th{
            
            color: whitesmoke;
        }


    </style>
</head>
    <body>


    

    
            <div class="container mt-5">
                <h2 class="mb-4" align="center">Category</h2>
             <!-- Form Header -->
             <div id="add">
            <button type="button" name="create_category" id="create_category" class="btn btn-primary"> <i class="bi bi-plus-square" ></i> Add New Category</button>
                </div>
         
            <table class="table table-bordered yajra-datatable" id="table_1">
            <span id="Add_Cat_result"></span>
            <span id="Edit_cat_result"></span>
                <thead>
                <tr>

                        <th><b>#</b></th>
                        <th><b>Category Name</b></th>
                        <th><b>Action</b></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

                 <!-- Create Category Modal -->
                <div class="modal fade" id="Add_Cat_Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="POST" id="Add_Cat_Form" class="form-horizontal" enctype="multipart/form-data">
                        <!-- Model header -->
                        @csrf
                        @method('POST')
                        <div class="modal-header" >
                            <h5 class="modal-title" id="Add_ModalLabel">Add New Category</h5>
                        </div>
                        <!-- Model Body -->
                        <div class="modal-body">
                            <span id="Add_Cat_result"></span>
                            <div class="form-group">
                                <label>Category Name : </label>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                           <input type="hidden" name="Add_action" id="Add_action" value="Add" />
                          </div>
                        <!-- Model Footer -->

                         <div class="modal-footer">
                            <input type="submit" name="Add_action_button" id="Add_action_button" value="Add" class="btn btn-info" /> 
                            <button type="button"  name="close_btn" data-dismiss="modal"  id="close_btn" class="btn btn-secondary">Close</button>
                        </div> 
                    </form>
                    </div>
                    </div>
                </div>


                    <!-- Edit Data Modal -->
                    <div class="modal fade" id="Edit_cat_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="post" id="Edit_cat_form" class="form-horizontal" enctype="multipart/form-data">
                        <!-- Model header -->
                        @csrf
                        @method('PUT')
                        <div class="modal-header" >
                            <h5 class="modal-title" id="ModalLabel">Edit Category</h5>
                        </div>
                        <!-- Model Body -->
                        <div class="modal-body">
                            <span id="Edit_cat_result"></span>
                            <div class="form-group">
                                <label>Category Name: </label>
                                <input type="text" name="editname" id="editname" class="form-control" />
                            </div>
                        </div>
                        <div>
                           <input type="hidden" name="Edit_action_button" id="Edit_action_button" value="Edit" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <!-- Model Footer -->

                         <div class="modal-footer">
                            <input type="submit" name="Edit_action_button" id="Edit_action_button" value="Edit" class="btn btn-info" /> 
                            <button type="button"  name="close_btn" data-dismiss="modal"  id="close_btn" class="btn btn-secondary">Close</button>
                        </div> 
                    </form>
                    </div>
                    </div>
                </div>


                <!-- Delete Form Field -->

            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="POST" id="sample_form" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Confirmation..</h5>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Are you sure you want to remove this post?</h4>
                        </div>
                        <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">YES</button>
                        <button type="button"  name="close_btn" data-dismiss="modal"  id="close_btn" class="btn btn-secondary">
                            Close
                        </button>

                        </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
    </body>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


        <script type="text/javascript">


            // Fecthing yajra DataTable
                $(document).ready(function() {
                        var table= $('.yajra-datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('categories.index') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'name', name: 'name'},
                            {data: 'action', 
                                name: 'action', 
                                orderable: false, 
                                searchable: false},
                        ]
                    });
                      
                    

                        //Add Post Record

                        $('#create_category').click(function(){
                        $('#Add_Cat_Modal').modal('show');
                        });
                            $(document).on('click', '#Add_action_button', function(event){
                            event.preventDefault();
                            let Add_data =new FormData($('#Add_Cat_Form')[0]);
                            $.ajax({
                            type: 'POST',
                            method:'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{route('categories.store')}}",
                            data:Add_data,
                            contentType:false,
                            processData:false,
                            success: function(response) {
                                console.log('success:'+response);
                                var html = '';
                                if(response.errors)
                                {
                                    html = '<div class="alert alert-danger">';
                                    for(var count = 0; count < response.errors.length; count++)
                                    {
                                        html += '<p>' + response.errors[count] + '</p>';
                                    }
                                    html += '</div>';
                                    $('#Add_Cat_Modal').modal(' ');
                                }
                                if(response.success)
                                {
                                    html = '<div class="alert alert-success">' + response.success + '</div>';
                                    $('#Add_Cat_Form')[0].reset();
                                    $('.yajra-datatable').DataTable().ajax.reload();
                                    $('#Add_Cat_Modal').modal('hide');
                                }

                                $('#Add_Cat_result').html(html);
                            },

                            }); 
                            });

                       
                            //Reset addd Popup form
                        $('#close_btn').click(function(){
                        $('#Add_Cat_Form')[0].reset();
                        });

                        // Edit Form record

                        $(document).on('click', '.edit', function(event){
                        event.preventDefault();
                        var id = $(this).attr('id');
                        $('#Edit_cat_modal').modal('show');
                        $('#Edit_cat_result').html('');
                        $.ajax({
                            url :"categories"+'/'+id+'/'+"edit",
                            method: "GET",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success:function(data)
                            {
                               console.log(data);
                                $('#editname').val(data.result.name);
                                $('#hidden_id').val(id);
                                $('#Edit_action').val('Edit');
                                $('#Edit_action_button').val('Update');
                                $('#Edit_cat_modal').modal('show');
                                


                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                            })
                            });


                 // update post ajax request
                
                 $('#Edit_cat_form').on('submit' , function(event){
                    event.preventDefault();
                    var hide_id = $("#hidden_id").val();
                    let data =new FormData($('#Edit_cat_form')[0]); 
                    $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "categories/"+hide_id+'/',
                    data:data,
                    contentType:false,
                    processData:false,
                    success: function(response) {
                        console.log('success:'+response);
                        var html = '';
                        if(response.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < response.errors.length; count++)
                            {
                                html += '<p>' + response.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#Edit_cat_modal').modal(' ');
                        }
                        if(response.success)
                        {
                            html = '<div class="alert alert-success">' + response.success + '</div>';
                            $('#Edit_cat_form')[0].reset();
                            $('.yajra-datatable').DataTable().ajax.reload();
                            $('#Edit_cat_modal').modal('hide');
                        }

                        $('#Edit_cat_result').html(html);
                    },

                    }); 
                    });

                    
                //    Delete Record using id
                   var data_id;
                   
                   $(document).on('click', '.delete', function()
                {
                   data_id = $(this).attr('id');
                   $('.modal-title').text('Confirmation..');
                   $('#confirmModal').modal('show');
                   $('#Edit_cat_result').val('Data Deleted Succesfully');
                   
                });
                
                   $('#ok_button').click(function(){
                   $.ajax({
                    type: "DELETE",
                    url: "categories"+'/'+data_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       beforeSend:function(){
                           $('#ok_button').text('Deleting...');
                       },
                       success:function(data)
                       {
                            
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