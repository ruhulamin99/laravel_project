<!DOCTYPE html>
<html lang="en">
  <head>


    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .font_size{

            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 50px;
        }

        .center{
            border: 2px solid white;
            width: 100%;
            margin: auto;

            text-align: center;
        }
        .th_deg{
            background-color: skyblue;
        }
        .img-box{
            width:150px;
            height: 150px;
        }
        .th_deg{
            padding: 10px;
        }
    </style>

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="font_size">All Orders</h1>
               <div style="padding-left:370px; padding-bottom:30px;">
                <form action="{{url('searchdata')}}" method="GET">
                    @csrf
                  <input type="text" name="search" style="color: black" placeholder="Search for something">
                   <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>
                <table class="center">
                    <tr class="th_color">
                        <th class="th_deg" >Name</th>
                        <th class="th_deg">Email</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Address</th>
                        <th class="th_deg">Phone</th>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Payment Status</th>
                        <th class="th_deg">Delivery Status</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Delivered</th>
                        <th class="th_deg">Print</th>
                    </tr>
                    @foreach($data as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->quantity}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->product_title}}</td>

                        <td>{{$data->price}}</td>
                        <td>{{$data->payment_status}}</td>
                        <td>{{$data->delivery_status}}</td>
                        <td><img class="img-box" src="product/{{$data->image}}" alt=""></td>
                        <td>
                            @if($data->delivery_status=='processing')
                                <a href="{{url('delivered',$data->id)}}" onclick="return confirm('Are you sure this product delivered?')" class="btn btn-primary" >Delivered</a>

                            @else
                                <p style="color:green ">Delivered</p>

                            @endif

                        </td>
                        <td>
                            <a href="{{url('print_pdf',$data->id)}}" class="btn btn-secondary">Print PDF</a>
                        </td>

                    </tr>
                    @endforeach
                </div>
            </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
