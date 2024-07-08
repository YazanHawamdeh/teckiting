@include('home.home')

<body>
   
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xl-8">

<!-- ==================================== -->

<!-- menu calender -->

@include('home.calender')


<!-- ==================================== -->


                
<!-- Cancelled/Rejected Tickets-->

        <div class="container mt-4" style="padding-right: 0px;">
            
        <div class="d-flex mt-3 " >
            <a href="{{ route('index') }}"><img src="{{ asset('./imgs/1.png') }}" style="width: 40px;" class="mx-2 mt-2"></a>
            <h3 style="font-size: 22px;font-weight: bold;color: #000000;">Cancelled/Rejected Tickets</h3>

        </div>
            <div class="row g-3 mt-3 container">

        
                                @foreach($teckit as $teckit)
                                <div class=" col-lg-6 col-md-6" >
                                    <!-- start card section-->
                                    <a href="{{url('teckit_details',$teckit->id)}}">
                 
                                        <div class="card tecket-card px-3" >
                                            <div class="card-body">

                                                @if($teckit->status=="rejected")
                                                <div class="tecket-title2 px-2">
                                                    @else
                                                    <div class="redLine px-2">

                                            @endif
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
                                                         <h6 class=" " style="font-size: 15px;font-weight: 500;color: #6d6d6d;margin-left: 10px;">
                                                            @if($teckit->actionUser)
                                                                {{ $teckit->actionUser->name }}
                                                            @else
                                                                Waiting for Response

                                                            @endif
                                                        </h6>                                                     </div>
                     
                                                    </div>
                                                    <button class="col-lg-6 col-sm-12 ms-auto mt-2" style="  background-color:@if($teckit->status == 'canceled') #E68282 ;
                                                        @elseif($teckit->status == 'rejected') #B481E6 ;
                                                        @endif border: none;border-radius: 10px;width: 122px; height: 40px;border-radius: 10px;width: 122px; height: 40px;font-size: 14px;">{{$teckit->status}}</button>
                                                </div>   
                                            </div>
                                        </div>
                 
                                    </a>
                     
                                </div>
                 
                                   @endforeach
                               

            </div>
       </div>
</div>



<div class="side col-lg-4 col-xl-4">
    <!--Top menu -->
    
    @include('home.calender2')

</div>

</div>


    
</body>
