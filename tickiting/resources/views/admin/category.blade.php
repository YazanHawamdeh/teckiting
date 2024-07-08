<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="stylesheet" href="{{asset("admin/assets/css/admin.css")}}">

    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
         @include('admin.navbar')
         <div class="main-panel">
            <div class="content-wrapper">
              @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
              @endif
                <div class="d-flex justify-content-center align-items-center">
                    <h2 class="div_center">
                        add category
                    </h2>
                    <form action="{{url('/add_category')}}" method="POST">
                      @csrf
                        <input class="input_form" type="text" name="category" placeholder="Write category">
                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">

                    </form>
                </div>
                <table class="trow">
                  <tr class="trow">
                    <td>category name</td>
                    <td>Action</td>
        
                  </tr>

                  @foreach ($data as $data)

                  <tr class="trow">
                        
                    <td>{{$data->category_name}}</td>
                    <td>
                      <a class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a>
                    </td>
        
                  </tr>
               @endforeach
                 </table>

            </div>

         </div>


        <!-- partial -->
        {{-- @include('admin.partial') --}}

        @include('admin.footer')



    </div>

    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>

    <script src="assets/js/dashboard.js"></script>

  </body>
</html>