@include('admin.adminhome')


  <style>
    /* body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f5f7;
      color: #333;
    } */
    /* .container-scroller {
      display: flex;
      flex-direction: column;
    }
    .main-panel {
      flex: 1;
    } */
    .content-wrapper {
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .table th, .table td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }
    .table th {
      background-color: #f8f9fa;
      text-align: left;
    }
    .btn {
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      color: #fff;
    }
    .btn-danger {
      background-color: #dc3545;
    }
    .btn-success {
      background-color: #28a745;
    }
    .btn:hover {
      opacity: 0.8;
    }
  </style>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.navbar')

    <div class="main-panel">
      <div class="content-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Solution</th>
              <th>Status</th>
              <th>Reject Reason</th>
              <th>Current Date</th>
              <th>Current Time</th>
              <th>User Id</th>
              <th>Types</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($teckits as $teckit)
            <tr>
              <td>{{ $teckit->title }}</td>
              <td>{{ $teckit->description }}</td>
              <td>{{ $teckit->solution }}</td>
              <td>{{ $teckit->status }}</td>
              <td>{{ $teckit->rejectReason }}</td>
              <td>{{ $teckit->current_date }}</td>
              <td>{{ $teckit->current_time }}</td>
              <td>{{ $teckit->user_id }}</td>
              <td>{{ $teckit->user->name }}</td>
              <td>{{ $teckit->actionUser->name }}</td>


              {{-- <td>{{$teckit->types->type}}</td> --}}

              <td>
                @foreach ($teckit->types as $type)

                   <span class=" py-1 px-3" style="font-size: 15px;background-color: #080808;color: #888888;border-radius: 10px;">{{ $type->type->title }}</span>

                @endforeach
              </td>
              {{-- <td>
                <a class="btn btn-danger" href="{{url('delete_user', $user->id)}}">Delete</a>
                <a class="btn btn-success" href="{{url('update_user', $user->id)}}">Edit</a>
              </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @include('admin.footer')
  </div>


</body>
