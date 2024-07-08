{{-- <x-app-layout></x-app-layout> --}}

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="m-0 border-0 bd-example border-0">


    <div class="row">

        @include('home.calender')

        <div class="col-lg-9 col-xl-8 col-md-12 " style="padding-right: 0px;">

            @if(Auth::user()->usertype == 'user')
        <div class="d-flex justify-content-end container">
            <a href="{{ url('upload') }}">  <button class="btn btn-primary mt-5 " style="width: 10rem ;background:#0271A2">+ Open Teckit</button>
            </a>
        </div>




            @endif
            
            <div class=" container">
                <div class="d-flex container mt-5 align-items-center pro1">
                    
                    <img  href="{{ route('index') }}" src="./imgs/7.jpg" class="img1 position-block">
                    <div class="ms-3 info">
                        
                        <div class="d-flex">
                            <p style="color: #131313; margin-bottom: 0px;" class="p-name">Hello {{$name}}</p>
                        </div> 
                        <p class="p-profile">what can we do for you today?</p>           
                        
                    </div>
                            <div style="margin-top: 2rem;margin-left:10px">
                                <x-app-layout>
                                </x-app-layout>

                            </div>
                            

                </div>



            </div>

            <section class="header-ticket container mt-3" style="padding-right: 0px;">
                <div class="row g-3 container">
                    <a href="{{ url('onWorkTeckit') }}" class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-head">
                            <div class="card-body">
                                <p class="card-title card-title-header">On Work Ticket</p>
                                <p class="p-calinder">
                                    <span id="teckitcountOnWork" style="color: black; font-size: 74px;">{{$teckitcountOnWork}}</span>/{{ $teckitcount }}
                                </p>
                                <img class="fileImg" src="./imgs/6.png">
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('DoneTeckits') }}" class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-head">
                            <div class="card-body">
                                <p class="card-title card-title-header">Completed Ticket</p>
                                <p class="p-calinder">
                                    <span id="teckitcountDone" style="color: black; font-size: 74px;">{{$teckitcountDone}}</span>/{{ $teckitcount }}
                                </p>
                                <img class="fileImg" src="./imgs/5.png">
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('canceledRejected') }}" class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-head">
                            <div class="card-body">
                                <p class="card-title card-title-header">Cancelled/Rejected Ticket</p>
                                <p class="p-calinder">
                                    <span id="teckitcountRejected" style="color: black; font-size: 74px;">{{$teckitcountRejected}}</span>/{{ $teckitcount }}
                                </p>
                                <img class="fileImg" src="./imgs/4.png">
                            </div>
                        </div>
                    </a>
                </div>
                <div style="border-top: 1px solid #959595; margin-top: 3%;"></div>
            </section>

            <!-- New request tickets section... -->
            <section class="container mt-4" style="padding-right: 0px;">
                <div style="font-size: 22px;columns: #525252;" class="d-flex">
                    <img src="./imgs/8.png" class="mx-3"> <span> New Request</span>
                </div>
                <div class="row g-3 mt-3 container">
                    @foreach($teckit as $teckit)
                    <div class="col-lg-6 col-md-6">
                        <a href="{{url('teckit_details',$teckit->id)}}">
                            <div class="card tecket-card px-3">
                                <div class="card-body">
                                    <div class="tecket-title px-2">
                                        <h5 style="font-size: 32px;color:#384554;font-weight: bold;">{{$teckit->title}}</h5>
                                        <ul class="px-0">
                                            @foreach ($teckit->types as $type)
                                            <span class="py-1 px-3" style="font-size: 15px;background-color: #EEEEEE;color: #888888;border-radius: 10px;">{{ $type->type->title }}</span>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="dateTime row mt-4">
                                        <div class="col-lg-6 col-sm-12 my-2">
                                            <span style="color: #7B7B7B">Date</span><br/><span style="color: #384554;font-size: 21px;font-weight: 500;">{{$teckit->current_date}}</span>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 my-2">
                                            <span style="color: #7B7B7B">Time</span><br/><span style="color: #384554;font-size: 21px;font-weight: 500;">{{$teckit->current_time}}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="d-flex">
                                                <img src="./imgs/7.jpg" style="width: 46px; height: 47px;border-radius: 11px;">
                                                <h6 class=" mt-3" style="font-size: 15px;font-weight: 500;color: #6d6d6d;margin-left: 10px;">
                                                    @if($teckit->actionUser)
                                                        {{ $teckit->actionUser->name }}
                                                    @else
                                                    Waiting for Response

                                                    @endif
                                                </h6>                                             </div>
                                        </div>
                                        <button id="status1" class="col-lg-6 col-sm-12 ms-auto mt-2" style="background-color: @if($teckit->status == 'pinding') #F2C060; @elseif($teckit->status == 'completed') #8CDD95; @elseif($teckit->status == 'rejected') #B482E6; @elseif($teckit->status == 'processing') #F2E160; @endif; border: none;border-radius: 10px;width: 122px; height: 40px;font-size: 14px;" value={{$teckit->status}}>{{$teckit->status}}</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <section class="side col-lg-3 col-xl-4">
            @include('home.calender2')
        </section>
    </div>

    <script src="./js/script.js"></script>
    <script src="./js/calender.js"></script>

</body>
</html>
