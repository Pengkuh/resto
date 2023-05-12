@extends('Layouts.user-layout')

@section('title','Booking Page ')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">

</div>
</div>
<!-- Navbar & Hero End -->

<!-- Menu Start -->

<!-- hidden input -->




<!-- About Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-12">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
        <h1 class="text-dark mb-4">{{$user->name}} Reservation</h1>

        <hr>
        @foreach ($reservation as $r)
        <div class="row  mt-4 ">
          <div class="col-lg-3 m-auto">
            <h6> {{date( "D d-M-Y  H:m:s",strtotime($r->created_at))}}
            </h6>
          </div>
          <div class="col-lg-2">
            <p> {{$r->res_table_name}}
            </p>
          </div>
          <div class="col-lg-3">
            <p>
              Rp. {{$r->res_total}}
            </p>
          </div>
          <div class="col-lg-2">
            <p> {{$r->res_status}}
            </p>
          </div>
          <div class="col-lg-2  ">
            <a href="/detail-reservation/{{$r->res_id}}">Details</a>
          </div>
        </div>
        <hr>
        @endforeach

      </div>

    </div>
  </div>
</div>
<!-- About End -->
<br><br><br><br><br><br><br><br><br><br>



@endsection