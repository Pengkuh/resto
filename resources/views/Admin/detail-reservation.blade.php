@extends('Layouts.admin-layout')

@section('title','Detail Reservation ')

@section('content')



<div class="container-fluid ">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Detail Page</h5>

      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <div class="row mb-3">
            <h4>Reservation Id</h4>
            <div class="col-lg-6">
              <h4 class="flex-shrink-0 text-primary mb-0">{{$reservation->res_id}}</h1>
            </div>
          </div>
          <div class="row mb-3">
            <h4>Status</h4>
            <div class="col-lg-6">
              <h4 class="flex-shrink-0 text-primary mb-0">{{$reservation->res_status}}</h1>
            </div>
          </div>
          <div class="row mb-3">
            <h4>Detail User</h4>
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_name_user" value="{{$reservation->res_name_user}}" />
                <label for="datetime">Name User</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_phone_user" value="{{$reservation->res_phone_user}}" />
                <label for="datetime">Phone User</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_email_user" value="{{$reservation->res_email_user}}" />
                <label for="datetime">Email User</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_total_visitor" value="{{$reservation->res_total_visitor}}" />
                <label for="datetime">Visitor</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <h4>Payment Info</h4>
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_name_user" value="{{$reservation->res_method_payment}}" />
                <label for="datetime">Method Payment</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_phone_user" value="{{$reservation->res_name_payment}}" />
                <label for="datetime">Name Payment</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-6">
              <div class="form-floating date" id="date3" data-target-input="nearest">
                <input readonly type="text" class="form-control " name="res_total_visitor" value="{{$reservation->res_code_payment}}" />
                <label for="datetime">Payment Code</label>
              </div>
            </div>
          </div>
          <div class="row">
            <h5>Reserved At</h5>
            <div class="col">
              {{date( "D d-M-Y  H:m:s",strtotime($reservation->created_at))}}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h5 class="section-title ff-secondary text-start text-primary fw-normal">Bill Order</h5>

          <div class="row">
            <h5>Table</h5>
            <div class="col-lg-6">
              {{$reservation->res_table_name}}
            </div>
            <div class="col-lg-3">
              {{$reservation->res_table_category}}
            </div>
            <div class="col-lg-3 fw-bold">
              Rp. {{$reservation->res_table_price}}
            </div>
          </div>
          <hr>
          <div class="row">
            <h5>Product</h5>
            <div class="col-lg-6">
              {{$reservation->res_product_name}}
            </div>
            <div class="col-lg-3">
              {{$reservation->res_product_category}}
            </div>
            <div class="col-lg-3">
              <div class="row">
                <div class="col-lg-12 "> <small>Rp. {{$reservation->res_product_price}} X {{$reservation->res_visitor}}</small>
                </div>
                <div class="col-lg-12 fw-bold"> Rp. {{$reservation->res_product_price * $reservation->res_visitor}}
                </div>

              </div>
            </div>
          </div>

          <hr>

          <div class="row g-4 mb-4">
            <div class="col-sm-6">
              <div class="d-flex align-items-center border-start border-5 border-primary px-3">

              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">{{$reservation->res_total }}</h1>
                <h6 class="text-uppercase mb-0">Total Bill</h6>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection