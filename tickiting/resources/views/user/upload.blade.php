<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="multyselect/css/style.css">

    <style>
        .form-container {
            width: 75%;
            margin: 0 auto;
        }
        .upload-content {
            text-align: center;
        }
        .upload-content img {
            display: block;
            margin: 0 auto;
        }
        #uploaded-image {
/* height: 30rem; */
            display: flex !important;
            flex-wrap: wrap !important;
        }
        /* .upload-content button {
            width: 100%;
        } */
        .btn-submit {
            width: 100%;
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
        }

        
    </style>
</head>
<body>
    <div class="row">
        <a href="{{ route('index') }}"><img src="{{ asset('./imgs/1.png') }}" style="width: 40px;" class="mx-2 mt-2"></a>

        <div class="col-lg-9 col-xl-8">
            <section class="mt-5">
                <div class="container text-center">
                    <h4>What can we help you with today?</h4>
                    <p style="font-size: 15px; color: #767676;">Tell us more about the problem you’re dealing with so we can help you in the best way possible.</p>
                </div>
                <div class="line container my-5"></div>
            </section>

            <section>
                <form action="{{ url('add_teckit') }}" method="POST" enctype="multipart/form-data" class="form-container p-4 rounded">
                    @csrf
                    <div class="container">
                        <label for="title" class="form-label uplodFont" style="color: #4D4D4D">Title</label>
                        <input type="text" id="title" name="title" class="form-control uplodFont fs-6" placeholder="Ticket Title" required>
                    </div>

                    <div class="upload-container container text-center ">
                        <div class="upload-content">
                            <input type="file" id="file-input" name="images[]" accept="image/*" multiple style="display: none;">
                            <img src="./imgs/10.png" class="my-3 m-auto">
                            <p style="font-size: 20px;">Upload media</p>
                            <p class="uplodFont">Upload up to 2 videos and 5 photos</p>
                            <button type="button" id="upload-button" class="btn btn-dark uplodFont px-3  rounded">Upload Picture</button>
                            {{-- <div style="margin: 10rem 0rem"> --}}
                                <div id="uploaded-image" ></div>

                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="form-group container mt-5">
                        <label for="types">Types:</label>
                        <select class="form-control js-select2 d-flex justify-content-center" multiple="multiple" id="types" name="type_ids[]" required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="line container my-5"></div>

                    <div class="container">
                        <label for="description" class="form-label uplodFont mx-2" style="color: #4D4D4D">Description</label>
                        <textarea id="description" name="description" class="form-control uplodFont fs-6" placeholder="Describe the problem you’re dealing with" style="height: 300px;" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit mt-3">Create Teckit</button>
                </form>
            </section>
        </div>

        <div class="side col-lg-3 col-xl-4">
            @include('home.calender2')
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/calender.js') }}"></script>
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
    <script src="multyselect/js/jquery.min.js"></script>
    <script src="multyselect/js/popper.js"></script>
    <script src="multyselect/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="multyselect/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('#types').select2({
                placeholder: 'Select types',
                allowClear: true
            });

            $('#upload-button').on('click', function() {
                $('#file-input').click();
            });

            $('#file-input').on('change', function() {
                var files = this.files;
                $('#uploaded-image').empty();

                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css('margin', '10px').css('max-width', '150px').css('max-height', '150px');
                        $('#uploaded-image').append(img);
                    }
                    reader.readAsDataURL(files[i]);
                }
            });
        });
    </script>
</body>
</html>
