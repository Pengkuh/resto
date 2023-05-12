@extends('Layouts.user-layout')

@section('title','Booking Page ')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">

</div>
</div>
<!-- Navbar & Hero End -->

<!-- Menu Start -->

<!-- hidden input -->
<form action="/pay" id="callback" method="POST">
  @csrf
  <input type="hidden" id="json_callback" name="json">

  <input hidden type="text" class="form-control " name="res_id" value="{{$res_id}}" />

  <input hidden type="text" class="form-control " name="res_name_user" value="{{$res_user->name}}" />
  <input hidden type="text" class="form-control " name="res_phone_user" value="{{$res_user->phone}}" />
  <input hidden type="text" class="form-control " name="res_email_user" value="{{$res_user->email}}" />
  <input hidden type="text" class="form-control " name="res_total_visitor" value="{{$res_visitor}}" />

  <input hidden type="text" class="form-control " name="res_table_name" value="{{$res_table->table_name}}" />
  <input hidden type="text" class="form-control " name="res_table_price" value="{{$res_table->table_price}}" />
  <input hidden type="text" class="form-control " name="res_table_category" value="{{$res_table->table_category}}" />

  <input hidden type="text" class="form-control " name="res_product_name" value="{{$res_product->product_name}}" />
  <input hidden type="text" class="form-control " name="res_product_price" value="{{$res_product->product_price}}" />
  <input hidden type="text" class="form-control " name="res_product_category" value="{{$res_product->product_category}}" />

  <input hidden type="datetime-local" class="form-control " name="datetime" value="{{$datetime}}" />


  <input hidden type="text" class="form-control " name="res_total" value="{{$total_bill}}" />

</form>



<!-- About Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="row mb-3">
          <h4>Reservation Id</h4>
          <div class="col-lg-6">
            <h4 class="flex-shrink-0 text-primary mb-0">{{$res_id}}</h1>
          </div>
        </div>
        <div class="row mb-3">
          <h4>Detail User</h4>
          <div class="col-lg-6">
            <div class="form-floating date" id="date3" data-target-input="nearest">
              <input type="text" class="form-control " name="res_name_user" value="{{$res_user->name}}" />
              <label for="datetime">Name User</label>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-floating date" id="date3" data-target-input="nearest">
              <input type="text" class="form-control " name="res_phone_user" value="{{$res_user->phone}}" />
              <label for="datetime">Phone User</label>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-lg-6">
            <div class="form-floating date" id="date3" data-target-input="nearest">
              <input type="text" class="form-control " name="res_email_user" value="{{$res_user->email}}" />
              <label for="datetime">Email User</label>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-floating date" id="date3" data-target-input="nearest">
              <input type="text" class="form-control " name="res_total_visitor" value="{{$res_visitor}}" />
              <label for="datetime">Visitor</label>
            </div>
          </div>
        </div>
        <div class="row">
          <h5>Reserved At</h5>
          <div class="col">
            {{date( "D d-M-Y  H:m:s",strtotime($datetime))}}

          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Bill Order</h5>
        <h1 class="mb-4">Your <i class="fa fa-utensils text-primary me-2"></i>Bill Order</h1>

        <div class="row">
          <h5>Table</h5>
          <div class="col-lg-6">
            {{$res_table->table_name}}
          </div>
          <div class="col-lg-3">
            {{$res_table->table_category}}
          </div>
          <div class="col-lg-3 fw-bold">
            Rp. {{$res_table->table_price}}
          </div>
        </div>
        <hr>
        <div class="row">
          <h5>Product</h5>
          <div class="col-lg-6">
            {{$res_product->product_name}}
          </div>
          <div class="col-lg-3">
            {{$res_product->product_category}}
          </div>
          <div class="col-lg-3">
            <div class="row">
              <div class="col-lg-12 "> <small>Rp. {{$res_product->product_price}} X {{$res_visitor}}</small>
              </div>
              <div class="col-lg-12 fw-bold"> Rp. {{$res_product->product_price * $res_visitor}}
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
              <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">{{$total_bill}}</h1>
              <div class="ps-4">
                <h6 class="text-uppercase mb-0">Total Bill</h6>
              </div>
            </div>
          </div>
          <button id="pay-button" class="btn btn-primary">Pay!</button>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function() {
    // SnapToken acquired from previous step
    snap.pay('<?= $snapToken ?>', {
      // Optional
      onSuccess: function(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        document.getElementById('callback').submit();
        alert("sukses");

      },
      // Optional
      onPending: function(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        document.getElementById('callback').submit();
        alert("pending");
      },
      // Optional
      onError: function(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        document.getElementById('callback').submit();
        alert("error");
      }
    })
  };
</script>
<!-- Menu End -->

@endsection