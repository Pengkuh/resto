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
          <h4 class="header-title">Data Table Reservation</h4>
          <div class="row mt-4 mb-4">
            <div class="col-5">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProduct">
                Add Product + </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/add-product" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                      <input type="text" class="form-control" name="product_name" value="" placeholder="Nama Product">
                      <br>
                      <input type="text" class="form-control" name="product_code" value="" placeholder="Kode Product">
                      <br>
                      <input type="text" class="form-control" name="product_price" value="" placeholder="Harga Product">
                      <br>
                      <input type="text" class="form-control" name="product_description" value="" placeholder="Deskripsi Product">
                      <br>
                      <select id="" class="form-control" name="product_category">
                        <option value="Dinner">Dinner</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Breakfast">Breakfast</option>

                        <hr>

                      </select>
                      <br>
                      <div class="row">
                        <div class="col-lg-12  ">
                          <div class=" col-lg-12 input-group mb-3">
                            <input type="file" class="form-control" id="gambar" multiple="" value="{{old('gambar')}}" name="gambar" accept="{{asset('storage/product/')}}">
                          </div>
                          <div class=" col-lg-12 mt-3 bg-danger" id="preview">
                            <h5></h5>
                            <img src="" id="output" class="col-lg-12 bg-success">
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <br>
          </div>
          <br><br>
          <div class="data-tables datatable-dark ">
            <table id="example" class="display">
              <thead class="text-capitalize ">
                <tr>
                  <th width="30px" class="text-center">No</th>
                  <th>Image</th>

                  <th>Name</th>
                  <th>Code</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Description</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product as $data)
                <tr>
                  <th class="text-center">{{$loop->iteration}}</th>
                  <td>
                    <img class="flex-shrink-0 img-fluid rounded" src="{{asset('storage/product/'.$data->product_image)}}" alt="" style="width: 80px;">
                  </td>

                  <td>{{$data->product_name}}</td>
                  <td>{{$data->product_code}}</td>
                  <td>{{$data->product_category}}</td>
                  <td>{{$data->product_price}}</td>
                  <td>{{$data->product_description}}</td>




                  <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                      More </button>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$data->product_name}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/update-product" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                          <input type="text" name="id" value="{{$data->id}}" hidden>

                          <input type="text" class="form-control" name="product_name" value="{{$data->product_name}}">
                          <br>
                          <input type="text" class="form-control" name="product_code" value="{{$data->product_code}}">
                          <br>
                          <input type="text" class="form-control" name="product_price" value="{{$data->product_price}}">
                          <br>
                          <input type="text" class="form-control" name="product_description" value="{{$data->product_description}}">
                          <br>
                          <select id="" class="form-control" name="product_category">
                            <option value="{{$data->product_category}}" selected>{{$data->product_category}}</option>
                            <hr>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="BreakFast">Breakfast</option>
                          </select>
                          <br>
                          <div class="row">
                            <div class="col-lg-12  ">
                              <div class=" col-lg-12 input-group mb-3">
                                <input type="file" class="form-control" id="gambar" multiple="" value="{{old('gambar')}}" name="gambar" accept="{{asset('storage/product/')}}">
                              </div>
                              <div class=" col-lg-12 mt-3 bg-danger" id="preview">
                                <h5></h5>
                                <img src="" id="output" class="col-lg-12 bg-success">
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update</button>
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

  <script>
    const output = document.querySelector("#output");
    const fileInput = document.querySelector("#gambar");


    const pre = document.querySelector('#preview');
    const list = document.createElement("img");
    const text = document.createTextNode("halooo");




    $i = 0;

    fileInput.addEventListener("change", () => {
      for (const file of fileInput.files) {
        var haom = URL.createObjectURL(fileInput.files[$i]);

        document.getElementById("preview").innerHTML +=
          "<img class='m-2' src='" + haom + "' width='100px'>  </img>";

        console.log([haom]);
        $i++;

      }
    });
  </script>


  @endsection