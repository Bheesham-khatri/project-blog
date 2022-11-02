<x-app-layout>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <style>
            #post {
                margin-top: 10px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if(auth()->user()->is_admin)
                <h1>Welcome to Admin Panel</h1>
                @else
                <h1>Welcome to User Panel</h1>

                @endif
            </h2>
            <div class="row" id="post">
                <div class="col-sm-12  mx-auto">
                    <h1 class="text-light text-center bg-secondary"><b>Dashboard</b></h1>
                </div>
            </div>
            <br>
            <br>
            <table class="table table-bordered mx-auto table-striped table-hover bg-secoundry text-black ">
                <tr>

                    <th><b>#</b></th>
                    <th><b>Post Title</b></th>
                    <th><b>Post Description</b></th>
                    <th><b>Post Category</b></th>
                    <th><b>Posted By</b></th>
                    <th><b>Image</b></th>
                    @if(auth()->user()->is_admin)
                    <th><b>Action</b></th>
                    @endif


                </tr>

                @foreach($posts as $post)

                <tr>
                    <td class="col-sm-1.5">{{$post->id}}</td>
                    <td class="col-sm-1.5">{{$post->title}}</td>
                    <td class="col-sm-5">{{$post->post_text}}</td>
                    <td class="col-sm-1.5">{{$post->category->name}}</td>
                    <td class="col-sm-1.5">{{$post->user->name}}</td>

                    <td><img width="80px" class="img-circle" src="{{URL::asset('storage/'.$post->image) }}"></td>
                    @if(auth()->user()->is_admin)
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are You Sure')">
                        </form>
                    </td>
                    @endif
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