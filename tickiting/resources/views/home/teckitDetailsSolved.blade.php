@include('home.home')

<body>

<div class="row">
  <div class="col-lg-8 ">
        <div class="d-flex mt-3 container">
            <a  href="{{ route('index') }}"><img src="{{ asset('./imgs/1.png') }}" style="width: 40px;" class="mx-2 mt-2"></a>
            <h3 style="font-size: 22px;font-weight: bold;color: #000000;">Ticket Details</h3>
        </div>
        <section class="d-flex justify-content-end container">
            <div class="m-4">
                <button type="button" class="btn btn-ticket mt-2" style="width: 210px; height: 56px;border-radius: 11px;background-color:#C6C6C6;color: white;font-size: 18px;font-weight: normal;" onclick="sweet()">Accept Ticket</button>
                <button type="button" class="btn btn-ticket btn-ticket1 mt-2" style="width: 210px; height: 56px;border-radius: 11px;background-color:#C6C6C6;color: white;font-size: 18px;font-weight: normal;" onclick="sweet()">Reject Ticket</button>
            </div>

            @include('home.calender')
        </section>

        <section class="container" style="padding-right: 0px;">
            <div class="row">
                <div class="col-lg-6 col-md-6 mt-3">
                    <div class="card tecket-card2" style="height: 100%;">
                        <div class="card-body">
                            <div class="mt-3 ms-2">
                                <div class="w-100 d-flex">
                                    <img src="./imgs/7.jpg" style="width: 120px;height: 120px; border-radius: 11px;">
                                    <h3 class="px-3 d-flex align-items-center bold" style="font-family: Poppins;font-size: 26px; font-weight: normal;color: #6d6d6d;">Ahmad Maher</h3>
                                </div>
                                <div class="row mt-2 p-2">
                                    <button  id="statusButton" class="m-1" style="background-color:  @if($teckit->status == 'processing')
                                        #F2E160;
                                   @elseif($teckit->status == 'completed')
                                       #8CDD95;
                                     @endif  
                                    border: none;border-radius: 10px;width: 122px; height: 40px;">{{$teckit->status}}</button>


                                    <button data-bs-toggle="modal" data-bs-target="#myModal" class="ms-auto m-1" style="background-color: #60f27b;border: none;border-radius: 10px;width: 122px; height: 40px;">Solved</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mt-3">
                    <div class="card tecket-card2 px-3 py-1">
                        <div class="card-body">
                            <div class=" pb-3">
                                <h5 class="TicketTitle"> {{$teckit->title}}</h5>
                                <div class="row">
                                    @foreach ($teckit->types as $type)
                                    <span class="py-1 px-3 m-1 col-lg-6 col-md-6 col-sm-12" style="text-align: center; width: 150px;font-size: 15px;background-color: #EEEEEE;color: #888888;border-radius: 10px;">{{ $type->type->title }}</span> 
                                    @endforeach
                                </div>
                            </div>
                            <div class="dateTime row mt-4">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-2"><span style="font-family: Poppins2;color:#7b7b7b;font-weight: 500;font-size: 20px;">Date</span><br/><span style="font-family: Poppins2;font-weight: 500;font-size: 21px;color: #384554;">{{$teckit->current_date}}</span></div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-2"><span style="font-family: Poppins2;color: #7b7b7b;font-weight: 500;font-size: 20px;">Time</span><br/><span style="font-family: Poppins2;font-weight: 500;font-size: 21px;color: #485562;">{{$teckit->current_time}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <!-- Modal -->
            <div class="modal fade text-white" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="headerModel" style="color: black;">Solved the Ticket?</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 style="color: #767676;" class="headerModel">That's great! Please provide the methodology you took to solve this ticket.</h6>
                            <div class="input-group">
                                <textarea class="form-control" aria-label="With textarea" style="height: 250px;background-color: #EFEFEF;" placeholder="Solution of ticket" id="solutionTextarea"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{ route('teckit.complete', $teckit->id) }}">
                                @csrf
                                <button type="submit" class="btn btn1" style="background-color: #8CDD95;color: white;" data-bs-dismiss="modal" onclick="submitSolution()">Submit Solution</button>

                                {{-- <button type="submit" class="btn btn-success">Accept</button> --}}
                            </form>
                            <button type="button" class="btn btn-dark btn1" data-bs-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-3 container" style="padding-right: 0px;">
            <div class="card tecket-card3">
                <div class="card-body">
                    <div class="mx-4 my-3">
                        <p style="font-size: 20px;font-weight: normal;color: #000000;">Description</p>
                        <p style="font-size: 18px;line-height: 22px;color: #767676;">{{$teckit->description}}</p>
                    </div>   
                </div>
            </div>
        </section>

        <section class="mt-3 container" style="padding-right: 0px;">
            <div class="card tecket-card3">
                <div class="card-body">
                    <div class="mx-4 my-3">
                        <p style="font-size: 20px;font-weight: normal;color: #000000;">Solution</p>
                        <p id="solutionContent" style="font-size: 18px;line-height: 22px;color: #767676;">{{$teckit->solution}}</p>
                    </div>   
                </div>
            </div>
        </section>

<!-- Attachments images -->
<section class="container">
    <p style="font-size: 20px;font-weight: normal;line-height: 21px;color: #000000;" class=" mt-5 ">Attachments</p>
<div class="image-container row  ">

    @foreach ($teckit->images as $attachment)

    @php
        $filePath = $attachment->image_url;
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $encodedPath = str_replace(' ', '%20', $filePath);
        $fileUrl = asset($encodedPath);
    @endphp
    

    <div class="col-lg-3 col-md-3 col-sm-4 col-4 imageAttachments">
        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
            <a href="#" class="image-link" onclick="openModal('{{ $fileUrl }}')">
                <img src="{{ $fileUrl }}" class="popupModel imgModel" alt="Image" width="100" height="50">
            </a>
        @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
            <a href="#" class="image-link" onclick="openModal('{{ $fileUrl }}')">
                <video controls class="popupModel">
                    <source src="{{ $fileUrl }}" type="video/{{ $fileExtension }}">
                    Your browser does not support the video tag.
                </video>
            </a>
        @else
            <p>Unsupported file type.</p>
        @endif
    </div>
    @endforeach

  
  </div>

</section>
    </div>

    <section class="side col-lg-4 col-xl-4">
        @include('home.calender2')
    </section>
</div>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/calender.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
async function sweet() {
    const { value: text } = await Swal.fire({
        input: "textarea",
        inputLabel: "Message",
        inputPlaceholder: "Type your message here...",
        inputAttributes: {
            "aria-label": "Type your message here"
        },
        showCancelButton: true
    });

    if (text) {
        Swal.fire(text);
    }
}

function submitSolution() {
    const solution = document.getElementById('solutionTextarea').value;

    if (!solution) {
        Swal.fire("Please provide a solution before submitting.");
        return;
    }

    $.ajax({
        url: '/submit-solution',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
            teckitId: '{{ $teckit->id }}', // Pass the teckit ID
            solution: solution,
        },
        success: function(response) {
            if (response.success) {
                // Swal.fire("Solution submitted successfully!");
                document.getElementById('solutionContent').innerText = solution; // Update the solution content on the page
                document.getElementById('statusButton').innerText = 'completed'; 
                document.getElementById('statusButton').style.backgroundColor = '#8CDD95'; 
                // $('#myModal').modal('hide'); 
            } else {
                Swal.fire("An error occurred. Please try again.");
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            Swal.fire("An error occurred. Please try again.");
        }
    });
}
</script>

</body>
