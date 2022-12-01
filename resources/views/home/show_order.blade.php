<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Razu - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

     <style>

        .center{
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }
        .th_deg{
            padding: 10px;
            background-color: skyblue;
            font-size: 20px;
            font-weight: bold;
        }
        table,td,th{
            border: 1px solid black;
        }
        .img_deg{
        height: 150px;
        width: 150px;
      }
     </style>
   </head>
   <body>

         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->
         @if (session()->has('message'))
         <div class="alert alert-success">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
             {{session()->get('message')}}
         </div>

         @endif

         <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Product Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Cancel Order</th>

                </tr>



                @foreach($order as $order )
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img class="img_deg" src="/product/{{$order->image}}"></td>
                    <td>
                        @if($order->delivery_status=='processing')
                        <a class="btn btn-danger" href="{{url('cancel_order',$order->id)}}" onclick="return confirm('Are you sure to cancel the order?') ">Cancel Order</a>

                    @else
                    <p style="color: blue">Not Allowed</p>

                    @endif
                    </td>
                </tr>

                @endforeach
            </table>
            </div>


      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By ">Razu</a><br>

            Distributed By <a href=" target="_blank">Razu</a>

         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
