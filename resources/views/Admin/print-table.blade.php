<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('assets/admin/src/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('assets/admin/src/assets/css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/admin/src/assets/css/print.css')}}" />


  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">



</head>

<body>


  <div class="decision m-auto d-flex align-items-center no-print">
    <div class="row m-auto no-print">
      <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <div class="body-wrapper">
      <!--  Header Start -->

      <!--  Header End -->



      <div class="container-fluid text-dark ">
        <!--  Row 1 -->
        <div class="row">


          <div class="col-12 mt-2">
            <div class=" ">
              <div class="card-body">
                <h4 class="header-title">Data Table Reservation {{$now}}</h4>
                <div class="row">
                  <br>
                </div>
                <br><br>
                <div class="row ">
                  <table id="" class="col-lg-12">
                    <thead class="text-capitalize ">
                      <tr>
                        <th width="30px" class="text-center">No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Visitor</th>
                        <th>Table Code</th>
                        <th>Cost</th>
                        <th>Status</th>
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
                          <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                            {{$data->res_status}}
                          </button>
                          @endif

                          @if ($data->res_status=="Finish")
                          <button type="button" class="btn ">
                            {{$data->res_status}}
                          </button>
                          @endif

                          @if ($data->res_status=="Paid")
                          <button type="button" class="btns" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                            {{$data->res_status}}
                          </button>
                          @endif

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