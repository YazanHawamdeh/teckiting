@include('admin.adminhome')

<body>

    <style>
        .test{
            width: 30px !important
        }
    </style>
<div class="container-scroller ">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.navbar')
    <div class="main-panel ">
        <div class="content-wrapper ">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-lg-6">
                <h2 class="text-center mb-4" style="color: white">Add User</h2>
                <form method="POST" action="{{ route('register') }}" class="bg-dark p-4 rounded">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="text-white">{{ __('Name') }}</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group mt-4">
                        <label for="email" class="text-white">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Usertype -->
                    <div class="form-group mt-4">
                        <label for="usertype" class="text-white">{{ __('Usertype') }}</label>
                        <select id="usertype" class="form-control" name="usertype" >
                            <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="tecknetion" {{ old('usertype') == 'tecknetion' ? 'selected' : '' }}>tecknetion</option>
                            <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- typeAuth -->

                    <div class="form-group " id="typeAuth">
                        <label for="types" class=" text-white">Types:</label>
                        <select class="form-control js-select2 full-width" multiple="multiple" id="types" name="type_ids[]" >
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-4">
                        <label for="password" class="text-white">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                        @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mt-4">
                        <label for="password_confirmation" class="text-white">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4 d-flex justify-content-between align-items-center">
                        {{-- <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a> --}}
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const usertypeSelect = document.getElementById('usertype');
        const typeAuthDiv = document.getElementById('typeAuth');

        function toggleTypeAuth() {
            if (usertypeSelect.value === 'tecknetion') {
                typeAuthDiv.style.display = 'block';
            } else {
                typeAuthDiv.style.display = 'none';
            }
        }

        // Initial check
        toggleTypeAuth();

        // Add event listener
        usertypeSelect.addEventListener('change', toggleTypeAuth);
    });
</script>
</body>
