@extends('Layouts.user-layout')

@section('title','Booking Page ')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">

</div>
</div>
<!-- Navbar & Hero End -->


<!-- Reservation Start -->
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
  <div class="row g-0">
    <div class="col-md-6 bg-dark container">

      <div class="row m-auto mt-5 ">

        @foreach($table as $t)
        <div class=" col-3 m-auto">
          <div class="mb-3 m-auto  ">
            <?php
            if ($t->table_status == "Already") {
              $bg = "bg-success";
            } elseif ($t->table_status == "Reserved") {
              $bg = "bg-danger";
            }

            ?>

            <div class="kotak-1 <?php echo $bg ?>">
              {{$t->table_name}}
            </div>

          </div>
        </div>
        @endforeach

      </div>



    </div>
    <div class="col-md-6 bg-dark d-flex align-items-center">
      <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
        <h1 class="text-white mb-4">Book A Table Online</h1>
        <form action="/reserved" method="post">
          @csrf

          <div class="row g-3">

            <div class="col-md-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input type="datetime-local" class="form-control datetimepicker-input" name="datetime" required />
                <label for="datetime">Date & Time</label>
              </div>
            </div>
            <div class="col-md-6">

              <div class="form-floating">
                <select class="form-select" id="select" name="res_table_name" required>
                  @foreach ($table as $t)
                  <option class="text-dark" value="{{$t->table_name}}">{{$t->table_name}}</option>
                  @endforeach
                </select>
                <label for="select1">Select Table</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input type="number" class="form-control" name="visitor" required  />
                <label for="datetime">Visitor</label>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- 16:9 aspect ratio -->
        <div class="ratio ratio-16x9">
          <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Reservation Start -->


@endsection