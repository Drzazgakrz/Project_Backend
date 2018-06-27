<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
             $products = Product::orderBy('id','desc')->get();
             if($products->count())
             {
                 return response()->json(['success'=>true,'data'=>$products],200);
             }
        }catch(\Exception $e)
        {
            return response()->json(['success'=>false],500);
        }
        return response()->json(['success'=>false],404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $good
     * @return void
     */
    public function edit(Product $good)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $good
     * @return void
     */
    public function update(Request $request, Product $good)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $good
     * @return void
     */
    public function destroy(Product $good)
    {
        //
    }
}
