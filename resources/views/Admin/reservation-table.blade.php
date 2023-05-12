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
          <h4 class="header-title">Data Table Reservation {{$now}}</h4>
          <div class="row">
            <div class="col"><a href="/print-table/{{$bill_date}}" class="btn btn-primary"> Print</a></div>
            <br>
          </div>
          <br><br>
          <div class="data-tables datatable-dark ">
            <table id="example" class="display">
              <thead class="text-capitalize ">
                <tr>
                  <th width="30px" class="text-center">No</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Visitor</th>
                  <th>Table Code</th>
                  <th>Cost</th>
                  <th>Status</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reservation as $data)
                <tr>
                  <th class="text-center">{{$loop->iteration}}</th>
                  <td>{{$data->res_name_user}}</td>
                  <td> {{date( "D, d M Y - H:m:s",strtotime($data->created_at))}}</td>

                  <td>{{$data->res_total_visitor}}</td>
                  <td>{{$data->res_table_name}}</td>
                  <td>Rp.{{$data->res_total}}</td>
                  <td>
                    @if ($data->res_status=="Arived")
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                      {{$data->res_status}}
                    </button>
                    @endif

                    @if ($data->res_status=="Finish")
                    <button type="button" class="btn btn-primary">
                      {{$data->res_status}}
                    </button>
                    @endif

                    @if ($data->res_status=="Paid")
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                      {{$data->res_status}}
                    </button>
                    @endif

                  </td>

                  <td>
                    <a class="dropdown-item" href="/reservation-detail/{{$data->res_id}}">Detail</a>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$data->res_name_user}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/update-reservation" method="post">
                        @csrf
                        <div class="modal-body">

                          {{$data->res_name_user}} <br>
                          {{date( "D, d M Y - H:m:s",strtotime($data->created_at))}} <br>

                          {{$data->res_total_visitor}} <br>
                          {{$data->res_table_name}} <br>
                          Rp.{{$data->res_total}}

                          <br>
                          <br>
                          <h6>Ubah Status</h6>
                          <input type="text" name="id" value="{{$data->res_id}}" hidden>

                          <select name="status" id="" class="form-control">
                            <option value="Arived">Arived</option>
                            <option value="Finish">Finish</option>

                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>




  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  </div>


  @endsection