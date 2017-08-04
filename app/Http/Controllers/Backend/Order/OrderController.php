<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Order\OrderModel;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Repositories\Backend\Order\OrderRepository;

class OrderController extends Controller {

    public function __construct(OrderRepository $order) {
       
        $this->order = $order;
//        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       
        return view('backend.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $product = $this->order->getProduct();
       $customer = $this->order->getCustomer();
        return view('backend.order.create',['product'=>$product,'customer'=>$customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    StoreOrderRequest $request
    public function store(StoreOrderRequest $request) {
        $storeOrder = $this->order->create($request->all());
        return redirect()->route('admin.order.index')->withFlashSuccess('The order was successfully created. ');
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
    public function edit(OrderModel $order) {
        $orderDetails['product'] = $this->order->orderDetails($order->id);
        $product = $this->order->getProduct();
       $customer = $this->order->getCustomer();
        return view('backend.order.edit', ['order' => $order, 'orderDetails' => $orderDetails,'product'=>$product,'customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */       

    public function update(OrderModel $order, UpdateOrderRequest $request) {
        

        $this->order->update($order, $request->all());

        return redirect()->route('admin.order.index')->withFlashSuccess('The order was successfully updated. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderModel $order) {
        $this->order->delete($order);
        return redirect()->route('admin.order.index')->withFlashSuccess('The order was successfully deleted. ');
    }
    
    /**
     * 
     * @param OrderModel $orderId
     */
   public function orderRecover(OrderModel $order){
       print_r($order);exit;
   }

}
