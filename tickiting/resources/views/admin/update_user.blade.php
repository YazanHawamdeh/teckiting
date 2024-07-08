@include('admin.adminhome')



<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <h2 class="mb-4">Update User</h2>
                <form action="{{ url('/update_user_confirm', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">User Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Write a name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">User Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Write an email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="usertype">Usertype:</label>
                        <select id="usertype" class="form-control" name="usertype">
                            <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="tecknetion" {{ old('usertype') == 'tecknetion' ? 'selected' : '' }}>Tecknetion</option>
                            <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">User Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Write a password" value="{{ $user->password }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" class="form-control" name="type[]" multiple required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ in_array($type->id, $user->types->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Update User">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
