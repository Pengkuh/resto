@extends('Layouts.admin-layout')

@section('title','Booking Page ')

@section('content')


@php
function rupiah($angka){

$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
return $hasil_rupiah;

}
@endphp

<div class="container-fluid">
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Hallo {{$admin->name}}</h5>
            </div>
            <div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <!-- Monthly Earnings -->
      <div class="card">
        <div class="card-body">
          <div class="row alig n-items-start">
            <div class="col-8">
              <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
              <h4 class="fw-semibold mb-3">{{rupiah($earn)}}</h4>

            </div>
            <div class="col-4">
              <div class="d-flex justify-content-end">
                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-currency-dollar fs-6"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>




  @endsection