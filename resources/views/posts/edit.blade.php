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
                        <h1 class="text-light text-center bg-secondary " ><b>Edit Post</b></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12  mx-auto">
                        
                            <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <label class="form-label" for="title"><b>Post title:</b></label>
                                <input type="text" name="title" placeholder="Post Title" class="form-control" value="{{ $post->title }}">
                                <br>
                                <label class="form-label" for="post_text"><b>Post Description :</b></label>
                                <textarea name="post_text" class="form-control" value="{{$post->post_text }}" cols="30" rows="10">{{$post->post_text}}</textarea>
                                <br>
                                <label class="form-label" for="image"><b>Upload Image:</b></label>
                                <input type="file" name="image" class="form-control" value="{{$post->image}}">
                                  <img src="/storage/{{$post->image}}" width="150px">
                                <br>
                                <label class="form-label" for="category"><b>Category:</b></label>
                                <select name="category_id" class="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @selected($category->id == $post->category_id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                    
                                <br>
                                <br>
                                <br>
                                <input class="btn btn-secondary btn-lg btn-block" type="submit" value="Update" />
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

