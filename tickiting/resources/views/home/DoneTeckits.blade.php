@include('home.home')

<body>
   
       



<div class="row">
   <div class="col-lg-8 col-md-12 col-sm-12">


        <!-- menu calender -->



        @include('home.calender')


                
        <!-- Cancelled/Rejected Tickets-->

        <section class="container mt-4" style="padding-right: 0px;">

            <div class="d-flex mt-3 container" >
                <a href="{{ route('index') }}"><img src="{{ asset('./imgs/1.png') }}" style="width: 40px;" class="mx-2 mt-2"></a>
                <h3 style="font-size: 22px;font-weight: bold;color: #000000;">Completed Tickets</h3>
    
            </div>
            
            <div class="row mt-3 container">


                @foreach($teckit as $teckit)
                <div class=" col-lg-6 col-md-6 mt-4">
                    <!-- start card section-->
                    <a href="{{url('teckit_details',$teckit->id)}}">
 
                        <div class="card tecket-card px-3" >
                            <div class="card-body">
                                <div class="tecket-title1 px-2">
                                    <h5 style="font-size: 32px;color:#384554 ;font-weight: bold;">{{$teckit->title}}</h5>
     
                                    <ul class="px-0">
                                     @foreach ($teckit->types as $type)
 
                                        <span class=" py-1 px-3" style="font-size: 15px;background-color: #EEEEEE;color: #888888;border-radius: 10px;">{{ $type->type->title }}</span>
     
                                     @endforeach
                                 </ul>
                                </div>
                                <div class="dateTime row mt-4 ">
                                    <div class="col-lg-6 col-sm-12 my-2"><span style="color: #7B7B7B">Date</span><br/><span style="color: #384554;font-size: 21px;font-weight: 500;">{{$teckit->current_date}}</span> </div>
                                    <div class="col-lg-6 col-sm-12 my-2"> <span style="color: #7B7B7B">Time</span><br/><span style="color: #384554;font-size: 21px;font-weight: 500;">{{$teckit->current_time}}</span> </div>
                                    
                                </div>
        
                                <div class="row mt-2">
                                    <div class="col-lg-6 col-sm-12">
                                     <div class="d-flex ">
                                         <img src="./imgs/7.jpg" style="width: 46px; height: 47px;border-radius: 11px;">
                                         <h6 class=" mt-3" style="font-size: 15px;font-weight: 500;color: #6d6d6d;margin-left: 10px;">
                                            @if($teckit->actionUser)
                                                {{ $teckit->actionUser->name }}
                                            @else
                                            Waiting for Response

                                            @endif
                                        </h6>                                     </div>
     
                                    </div>
                                    <button class="col-lg-6 col-sm-12 ms-auto mt-2" style="background-color: #8CDD95;border: none;border-radius: 10px;width: 122px; height: 40px;font-size: 14px;">{{$teckit->status}}</button>

                                    {{-- <button class="col-lg-6 col-sm-12 ms-auto mt-2" style="background-color: #F2C060;border: none;border-radius: 10px;width: 122px; height: 40px;font-size: 14px;">{{$teckit->status}}</button> --}}
                                </div>   
                            </div>
                        </div>
 
                    </a>
     
                </div>
 
                   @endforeach
               </div>        


        </section>
    </div>



    <section class="side col-lg-4 col-xl-4">
        <!--Top menu -->
     
        @include('home.calender2')

    </section>

</div>


    
</body>
