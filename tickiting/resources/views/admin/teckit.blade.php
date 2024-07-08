@include('admin.adminhome')


<style>
    th {
        background-color: rgb(139, 185, 185);
        padding: 15px;
        border: 1px solid #ddd;
    }
    td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    label {
        color: white;
        width: 150px;
    }
</style>

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

            <h2 class="mb-4">Add Teckit</h2>

            <form action="{{ url('add_teckit') }}" method="POST" enctype="multipart/form-data" class="bg-dark p-4 rounded">
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Enter description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" class="form-control" placeholder="Enter status" required>
                </div>

                <div class="form-group">
                    <label for="types">Types:</label>
                    <select class="form-control js-select2" multiple="multiple" id="types" name="type_ids[]" required>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="images">Images:</label>
                    <input type="file" id="images" name="images[]" class="form-control-file" multiple accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Create Teckit</button>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#types').select2({
            placeholder: 'Select types',
            allowClear: true
        });
    });
</script>
</body>
