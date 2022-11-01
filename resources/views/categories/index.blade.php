
<x-app-layout>

<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        #cat{
            margin-top: 10px;
             }
    </style>
</head>
<body>
    
            <div class="container">
                <div class="row" id="cat">
                    <div class="col-sm-12  mx-auto">
                        <h1 class="text-light text-center bg-secondary " ><b>Category</b></h1>
                    </div>
                </div>
      <div class="row">
            <div class="col-sm-12">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{route('categories.create')}}" class="btn btn-outline-info">Add new category</a>
                <br>
                <br>
                <table class="table table-bordered mx-auto table-striped table-hover bg-secoundry text-black ">
                            <tr>
                            
                                <th><b>Id</b></th>
                                <th><b>Category name</b></th>
                                <th><b>Action</b></th>
                             
                            </tr>
                            @foreach($categories as $category)
                            <tr>

                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a href="{{route('categories.edit', $category)}}" class="btn btn-primary btn-sm">Edit</a>
                                 <form action="{{route('categories.destroy', $category)}}" method="POST">
                                        @csrf
                                        @method('DELETE') 
                                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are You Sure')">
                                    </form>   
                                 </td>

                                
                            </tr>
                          @endforeach
                       
                </table>
            </div>
        </div>  
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

</x-app-layout>