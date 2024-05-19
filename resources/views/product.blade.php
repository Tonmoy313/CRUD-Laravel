<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="container align-item-center">
        <div class="row">
            @if ($errors->any())
                <span class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>

            @endif
            <span class="alert"></span>
            <div class="col card">
                <div class="card-header  text-center bg-dark text-white">
                    <h1>Product:{{ $info->id }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('update',$info->id) }}" method="post">
                        @csrf @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="form-text col">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $info->name}}" disabled>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="form-text col">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{$info->email }}">
                            @error('email')
                                <small class="alert alert-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password" class="form-text col">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                value="{{ $info->password}}">
                            @error('password')
                                <small class="alert alert-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row justify-content-between">
                            <div class="col">
                                <a href="{{ route('home') }}" class="btn btn-outline-success">Back</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-outline-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
