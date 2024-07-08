@include('admin.adminhome')

    <style>
        .badge-type {
            font-size: 15px;
            background-color: #EEEEEE;
            color: #212020;
            border-radius: 10px;
            padding: 5px 10px;
            margin-right: 5px;
        }
        .content-wrapper{
          background-color: #EEEEEE !important
        }
    </style>
<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="mb-4">User Management</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Types</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->types as $type)
                                    <span class="badge badge-type">{{ $type->type->title }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->usertype }}</td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ url('delete_user', $user->id) }}">Delete</a>
                                <a class="btn btn-success btn-sm" href="{{ url('update_user', $user->id) }}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('admin.footer')
    </div>

</body>
