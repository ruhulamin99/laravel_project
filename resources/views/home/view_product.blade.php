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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->

         <section class="product_section layout_padding">
            <div class="container">
               <div class="heading_container heading_center">

                  <div style=" padding-bottom:30px;">
                    <form action="{{url('search_product')}}" method="GET">
                        @csrf
                      <input type="text" name="search" style="color: black" placeholder="Search for something">
                       <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>
               </div>
               <div class="row">
                @foreach($product as $products)
                  <div class="col-sm-6 col-md-4 col-lg-4">
                     <div class="box">
                        <div class="option_container">
                           <div class="options">

                              <a href="{{url('product_details',$products->id)}}" class="option1">
                              Product Details
                              </a>
                              <form action="{{url('add_cart',$products->id)}}" method="POST" >
                                @csrf
                               <div class="row">
                                <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width: 60px">
                                </div>
                                <div class="col-md-4">

                                    <input type="submit" value="Add To Cart">
                                </div>
                               </div>
                              </form>
                           </div>
                        </div>
                        <div class="img-box">
                           <img src="product/{{$products->image}}" alt="">
                        </div>
                        <div class="detail-box">
                           <h5>
                             {{$products->title}}
                           </h5 >
                           @if($products->discount_price!=null)
                           <h6 style="color:red">
                            ${{$products->discount_price}}
                           </h6>
                           <h6 style="text-decoration: line-through; color:blue;">
                            ${{$products->price}}
                           </h6>
                           @else
                           <h6 style="color:blue;">
                            ${{$products->price}}
                           </h6>

                           @endif
                        </div>
                     </div>
                  </div>
        @endforeach
        <span style="padding-top: 20px;">
        {!!$product->WithQueryString()->links('pagination::bootstrap-5')!!}
        </span>
            </div>
         </section>






      {{-- coment and reply start --}}


      <div style="text-align: center; padding-bottom:30px;">

        <h1 style="font-size: 30px; text-align: center; padding-top:20px; padding-bottom:20px;">Comments</h1>
        <form action="{{url('add_comment')}}" method="POST">

            @csrf
            <textarea style="height: 150px; width:600px ;" placeholder="Comment somthing here" name="comment"></textarea>
            <br>

            <input type="submit" class="btn btn-primary" value="Comment">
        </form>
</div>
        <div style="padding-left: 20%;">

            <h1 style="font-size: 20px;  padding-bottom:20px;">All Comments</h1>
            @foreach($comment as $comment)
            <div>

                <b>{{$comment->name}}</b>
                <p>{{$comment->comment}}</p>

                <a href="jacascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}" >Reply</a>

                {{-- @foreach($reply as $repl)
                @if($comment->id==$repl->user_id)

                <div style="padding-left: 3%; padding-bottom:10px; ">

                    <b>{{$repl->name}}</b>
                    <p>{{$repl->reply}}</p>

                   @endif


                </div>
                @endforeach
            </div> --}}


            @endforeach

            <div style="display: none"  class="replyDiv">

                {{-- <form action="{{url('add_reply',$comment->id)}}" method="POST">
                    @csrf --}}

                <input type="text" id="commentID" name="commentID"   >
                <textarea style="height: 100px; width:500px ;"name="reply" placeholder="write somthing here"></textarea>
                <br>
                {{-- <button type="submit" class="btn btn-primary">Reply</button> --}}
                <a href=" " class="btn btn-primary"  >Close</a>
                <a href="jacascript::void(0);" class="btn" onclick="reply_close(this)"  >Close</a>
            </form>
            </div>

</div>









      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By ">Razu</a><br>

            Distributed By <a href=" target="_blank">Razu</a>

         </p>
      </div>

<script type="text/javascript">

function reply(caller)
{


    $('.replyDiv').insertAfter($(caller));
    $('.replyDiv').show();
    document.getElementByID('commentID').value=$(caller).attr('data-Commentid');

}
function reply_close(caller)
{


    $('.replyDiv').hide();
}

</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>


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
