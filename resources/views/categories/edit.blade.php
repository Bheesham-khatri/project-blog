<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        #edit{
            margin-top: 10px;
             }
    </style>
</head>
<body>
    
            <div class="container">
                <div class="row" id="edit">
                    <div class="col-sm-12  mx-auto">
                        <h1 class="text-light text-center bg-secondary " ><b>Edit Category</b></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12  mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        
                        <form action="{{route('categories.update' , $category)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <label class="form-label" for="name"><b>Category Name :</b></label>
                                <input name="name" value="{{$category->name}}"  class="form-control" autofocus>
                                <br>
                                <br>
                                <input class="btn btn-secondary btn-lg btn-block " style="margin-bottom:5%;" type="submit" value="Edit Category" />
                        </form>
                    </div>
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>


