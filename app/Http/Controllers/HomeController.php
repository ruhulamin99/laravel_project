<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
class HomeController extends Controller
{
    //
    public function index()
    {
        $product=product::paginate(3);
        $comment=comment::all();
        $reply=reply::all();
        return view('home.userpage',compact('product','comment','reply'));

    }


    public function redirect()
    {
       $usertype=Auth::user()->usertype;
       if($usertype=='1')
       {
        $total_product=product::all()->count();
        $total_order=order::all()->count();
        $total_customer=user::all()->count();
        $order=order::all();
        $total_revenue=0;
        foreach($order as $order)
        {
            $total_revenue=$total_revenue+$order->price;
        }

        $total_delivered=order::where('delivery_status','=','delivered')->get()->count();
        $total_processing=order::where('delivery_status','=','processing')->get()->count();
        return view('admin.home',compact('total_product','total_order','total_customer','total_revenue','total_delivered','total_processing'));
       }
       else
       {
        $product=product::paginate(3);
        $comment=comment::all();
        $reply=reply::all();
        return view('home.userpage',compact('product','comment','reply'));
       }
    }
    public function product_details($id)
    {

        $product=product::find($id);
        return view('home.product_details',compact('product'));

    }
    public function add_cart(Request $request,$id)
    {

    if(Auth::id())
    {
        $user=Auth::user();
        $userid=$user->id;
        $product=product::find($id);
        $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
     if($product_exist_id)
     {
        $cart=cart::find($product_exist_id)->first();
        $quantity=$cart->quantity;
        $cart->quantity=$quantity+$request->quantity;
        if($product->discount_price!=null)
        {
            $price=$cart->price;
            $cart->price=$product->discount_price*$request->quantity+$price;
        }
        else
        {
            $price=$cart->price;
            $cart->price=$product->price*$request->quantity+$price;
        }
        $cart->save();
        return redirect()->back();
     }
     else
     {
        $cart=new cart;
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->phone=$user->phone;
        $cart->address=$user->address;
        $cart->user_id=$user->id;
        $cart->product_title=$product->title;
        if($product->discount_price!=null)
        {
            $cart->price=$product->discount_price*$request->quantity;
        }
        else
        {
            $cart->price=$product->price*$request->quantity;
        }

        $cart->image=$product->image;
        $cart->product_id=$product->id;
        $cart->quantity=$request->quantity;
        $cart->save();
        return redirect()->back()->with('message','cart Updated successfully');
     }




    }
    else
    {

        return redirect('login');
    }


    }

    public function show_cart()
    {
        if(Auth::id())
        {

            $id=Auth::user()->id;
        $cart=cart::where('user_id','=',$id)->get();

        return view('home.show_cart',compact('cart'));

        }
        else
    {

        return redirect('login');
    }

    }

    public function remove_cart($id)
    {

        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','product remove successfully');
    }
    public function cash_order()
    {

        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }

        return redirect()->back()->with('message','We have received your order.We will connect with soon');
    }

    public function show_order()
    {
        if(Auth::id())
        {

            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();

        return view('home.show_order',compact('order'));

        }
        else
    {

        return redirect('login');
    }

    }

    public function cancel_order($id)
    {

        $order=order::find($id);
        $order->delivery_status='You Canceled the Order';
        $order->save();
        return redirect()->back()->with('message','Cancel Order successfully');
    }

    public function add_comment(Request $request)
    {

        if(Auth::id())
        {

            $comment=new comment;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;
            $comment->save();

            return redirect()->back();

        }
        else
    {

        return redirect('login');
    }
    }

    public function add_reply(Request $request,$id)
    {
           $idd=$id;
        if(Auth::id())
        {

            $reply=new reply;
            $reply->name=Auth::user()->name;
            $reply->reply=$request->reply;
            $reply->user_id=$idd;

            $reply->save();

            return redirect()->back();

        }
        else
    {

        return redirect('login');
    }
    }

    public function searchdata(Request $request)
    {

        $comment=comment::all();
        $reply=reply::all();
        $searchtext=$request->search;
        $product=product::where('title','Like',"%$searchtext%")->orWhere('description','Like',"%$searchtext%")->orWhere('catagory','Like',"%$searchtext%")->paginate(6);




        return view('home.userpage',compact('product','comment','reply'));
    }

    public function view_product()
    {
        $product=product::paginate(3);
        $comment=comment::all();
        $reply=reply::all();

        return view('home.view_product',compact('product','comment','reply'));

    }

    public function search_product(Request $request)
    {

        $comment=comment::all();
        $reply=reply::all();
        $searchtext=$request->search;
        $product=product::where('title','Like',"%$searchtext%")->orWhere('description','Like',"%$searchtext%")->orWhere('catagory','Like',"%$searchtext%")->paginate(6);




        return view('home.view_product',compact('product','comment','reply'));

}
}
