<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Product\ProductModel;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Http\Requests\Backend\Product\StoreProductQuantityRequest;
use App\Repositories\Backend\Product\ProductRepository;

class ProductController extends Controller {

    public function __construct(ProductRepository $product) {
       
        $this->product = $product;
//        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       $product = $this->product->getProduct();
        return view('backend.product.index',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    StoreProductRequest $request
    public function store(StoreProductRequest $request) {
        $storeProduct = $this->product->create($request->all());
        return redirect()->route('admin.product.index')->withFlashSuccess('The product was successfully created. ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $product) {
        return view('backend.product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */       

    public function update(ProductModel $product, UpdateProductRequest $request) {
        

        $this->product->update($product, $request->all());

        return redirect()->route('admin.product.index')->withFlashSuccess('The product was successfully updated. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $product) {
        $this->product->delete($product);
        return redirect()->route('admin.product.index')->withFlashSuccess('The product was successfully deleted. ');
    }
    
    /**
     * 
     * @param \App\Http\Controllers\Backend\Product\StoreProductQuantityRequest $request
     */
     
    public function addQuantity(StoreProductQuantityRequest $request){
       $name = $this->product->addQuantity($request->all());
        return redirect()->route('admin.product.index')->withFlashSuccess('The '. $name.' product quantity was successfully added. ');
    }

}
