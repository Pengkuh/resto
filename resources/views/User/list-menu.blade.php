@extends('Layouts.user-layout')

@section('title','Booking Page ')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">

</div>
</div>
<!-- Navbar & Hero End -->

<!-- Menu Start -->

<form action="/checkout" method="post">
  @csrf


  <input type="text" name="res_table_name" value="{{$res_table}} " hidden>
  <input type="text" name="res_total_visitor" value="{{$res_visitor}} " hidden>
  <input type="datetime-local" name="datetime" value="{{$datetime}}" hidden>


  <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
        <h1 class="mb-5">Take A Dinner With</h1>
      </div>
      <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
              <i class="fa fa-coffee fa-2x text-primary"></i>
              <div class="ps-3">
                <small class="text-body">Popular</small>
                <h6 class="mt-n1 mb-0">Breakfast</h6>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
              <i class="fa fa-hamburger fa-2x text-primary"></i>
              <div class="ps-3">
                <small class="text-body">Special</small>
                <h6 class="mt-n1 mb-0">Lunch</h6>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
              <i class="fa fa-utensils fa-2x text-primary"></i>
              <div class="ps-3">
                <small class="text-body">Lovely</small>
                <h6 class="mt-n1 mb-0">Dinner</h6>
              </div>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="tab-1" class="tab-pane fade show p-0 active">
            <div class="row g-4">

              @foreach($Breakfast as $p)
              <div class="col-lg-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 img-fluid rounded" src="{{asset('storage/product/'.$p->product_image)}}" alt="" style="width: 80px;">
                  <div class="w-100 d-flex flex-column text-start ps-4">
                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                      <span>{{$p->product_name}}</span>
                      <span class="text-primary">Rp.{{$p->product_price}}</span>
                    </h5>
                    <div class="row">
                      <div class="col-lg-6">
                        <small class="fst-italic">{{$p->product_description}}</small>
                      </div>
                      <div class="col-lg-6 text-end">
                        <input type="radio" class="btn-check" name="product_code" id="{{$p->product_code}}" value="{{$p->product_code}}" autocomplete="off" required>
                        <label class="btn btn-primary" for="{{$p->product_code}}">Check Here</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </div>
          <div id="tab-2" class="tab-pane fade show p-0">
            <div class="row g-4">

              @foreach($Lunch as $p)
              <div class="col-lg-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 img-fluid rounded" src="{{asset('storage/product/'.$p->product_image)}}" alt="" style="width: 80px;">
                  <div class="w-100 d-flex flex-column text-start ps-4">
                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                      <span>{{$p->product_name}}</span>
                      <span class="text-primary">Rp.{{$p->product_price}}</span>
                    </h5>
                    <div class="row">
                      <div class="col-lg-6">
                        <small class="fst-italic">{{$p->product_description}}</small>
                      </div>
                      <div class="col-lg-6 text-end">
                        <input type="radio" class="btn-check" name="product_code" id="{{$p->product_code}}" value="{{$p->product_code}}" autocomplete="off" required>
                        <label class="btn btn-primary" for="{{$p->product_code}}">Check Here</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </div>
          <div id="tab-3" class="tab-pane fade show p-0">
            <div class="row g-4">

              @foreach($Dinner as $p)
              <div class="col-lg-6">
                <div class="d-flex align-items-center">
                  <img class="flex-shrink-0 img-fluid rounded" src="{{asset('storage/product/'.$p->product_image)}}" alt="" style="width: 80px;">
                  <div class="w-100 d-flex flex-column text-start ps-4">
                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                      <span>{{$p->product_name}}</span>
                      <span class="text-primary">Rp.{{$p->product_price}}</span>
                    </h5>
                    <div class="row">
                      <div class="col-lg-6">
                        <small class="fst-italic">{{$p->product_description}}</small>
                      </div>
                      <div class="col-lg-6 text-end">
                        <input type="radio" class="btn-check" name="product_code" id="{{$p->product_code}}" value="{{$p->product_code}}" autocomplete="off" required>
                        <label class="btn btn-primary" for="{{$p->product_code}}">Check Here</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row mt-5">
        <div class="col">
          <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Menu End -->

@endsection