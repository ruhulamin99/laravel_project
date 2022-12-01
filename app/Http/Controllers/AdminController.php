<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{
    //

    public function view_catagory()
    {
        $data=catagory::all();
        return view('admin.catagory',compact('data'));
    }

    public function add_catagory(Request $request)
    {
        $data=new catagory;
        $data->catagory_name=$request->catagory;
        $data->save();
        return redirect()->back()->with('message','catagory added successfully');
    }
    public function delete_catagory($id)
    {
        $data=catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message','catagory deleted successfully');
    }

    public function view_product()
    {
       $catagory=catagory::all();
        return view('admin.product',compact('catagory'));
    }

    public function add_product(Request $request)
    {

        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        $product->catagory=$request->catagory;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
        $product->save();


        return redirect()->back()->with('message','product added successfully');
    }

    public function show_product()
    {


        $product=product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message','product Deleted successfully');
    }
    public function update_product($id)
    {
        $product=product::find($id);
        $catagory=catagory::all();
        return view('admin.update_product',compact('product','catagory'));
    }

    public function update_product_confirm(Request $request,$id)
    {

        $product=product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        $product->catagory=$request->catagory;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }

        $product->save();


        return redirect()->back()->with('message','product Updated successfully');
    }

    public function order()
    {

        $data=order::all();

        return view('admin.order',compact('data'));
    }
    public function delivered($id)
    {

        $order=order::find($id);

        $order->delivery_status="delivered";
        $order->payment_status='paid';
            $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {

        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));



        return $pdf->download('order_details.pdf');
    }
    public function searchdata(Request $request)
    {

        $searchtext=$request->search;
        $data=order::where('name','Like',"%$searchtext%")->orWhere('product_title','Like',"%$searchtext%")->orWhere('phone','Like',"%$searchtext%")->get();




        return view('admin.order',compact('data'));
    }

}
