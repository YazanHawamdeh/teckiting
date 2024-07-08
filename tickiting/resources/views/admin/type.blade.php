@include('admin.adminhome')

<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.navbar')
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="d-flex justify-content-center align-items-center ">
                <div class="col-lg-6">
                    <h2 class="text-center mb-4">Add Type</h2>
                    <form action="{{ url('/add_type') }}" method="POST" class="bg-dark p-4 rounded">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="text-white">Type Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Write type" required style="color: rgb(17, 16, 16)">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Type</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>


</body>
