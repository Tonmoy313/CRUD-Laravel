<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark">
                        <ul class="nav nav-pills card-header-pills bg-white" id="myTab" role="tablist">
                            <li class="nav-item  ">
                                <a href="#formTabId" class="nav-link active" data-toggle="tab" id="myFormTab"
                                    role="tab">Form</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tableTabId" class="nav-link" data-toggle="tab" id="myTableTab"
                                    role="tab">Table</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div id="formTabId" class="tab-pane fade show active" role="tabpanel">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nameId" class="form-text">Name</label>
                                            <input type="text" class="form-control" id="nameId" name="name"
                                                placeholder="Enter Your Name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="form-text text-danger"> {{ $message }}</small>
                                                {{-- <span class="alert alert-danger">{{ $message }}</span> --}}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="imageId" class="form-text">Select Picture</label>
                                            <input type="file" accept="image/*" class="form-control" name="image"
                                                id="imageId">
                                            @error('image')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="emailId" class="form-text">Email</label>
                                            <input type="email" class="form-control" id="emailId" name="email"
                                                placeholder="example@gmail.com" value="{{ old('email') }}"
                                                aria-describedby="emailHelp">
                                            @if ($errors->has('email'))
                                                <small
                                                    class="form-text text-danger">{{ $errors->first('email') }}</small>
                                            @else
                                                <small class="form-text text-muted" id="emailHelp">We Don't Share your
                                                    Email</small>
                                            @endif
                                        </div>
                                        <div class="form-gorup">
                                            <label for="passwordId">Password</label>
                                            <input type="password" class="form-control" id="passwordId" name="password"
                                                placeholder="Must Be 4 letters" value="{{ old('password') }}">
                                            @error('password')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end mt-4 mr-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div id="tableTabId" class="tab-pane" role="tabpanel">
                            @if (session('success'))
                                <span class="alert alert-success">{{ session('succss') }}</span>
                            @endif
                            @error('delete')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>Abdullah</td>
                                        <td>tonmoy@gmail.com</td>
                                    </tr>
                                    @foreach ($infoData as $info)
                                        <tr>
                                            {{-- <tr scope='row'>{{ $i }}</tr> --}}
                                            <td scope='row'>{{ $loop->iteration }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->email }}</td>
                                            <td>
                                                @if ($info->imageName)
                                                    <img src="{{ asset('images/' . $info->imageName) }}"
                                                        alt="{{ $info->name }} Image", width="40",
                                                        height="40">
                                                @else
                                                    no Image
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit', $info->id) }}" class="btn btn-success"><i
                                                        class="fa-solid fa-pen-to-square"></i>Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('delete', $info->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i
                                                            class="fa-solid fa-trash"></i>Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

    <script></script>
</body>

</html>
