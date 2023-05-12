@extends('Layouts.admin-layout')

@section('title','Booking Page ')

@section('content')

<style type="text/css" media="print">
  .no-print {
    display: none;
  }
</style>

<div class="container-fluid ">
  <!--  Row 1 -->
  <div class="row">

    <div class="col-12 mt-2">
      <div class="card ">
        <div class="card-body">
          <h4 class="header-title">Data Table User</h4>
          <div class="row">
            <br>
          </div>
          <br><br>
          <div class="data-tables datatable-dark ">
            <table id="example" class="display">
              <thead class="text-capitalize ">
                <tr>
                  <th width="30px" class="text-center">No</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user as $data)
                <tr>
                  <th class="text-center">{{$loop->iteration}}</th>
                  <td>{{$data->name}}</td>

                  <td>{{$data->phone}}</td>
                  <td>{{$data->email}}</td>

                  <td> {{date( "D, d M Y - H:m:s",strtotime($data->created_at))}}</td>


                </tr>


                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>




  </div>


  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{$data->res_name_user}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> -->


  @endsection