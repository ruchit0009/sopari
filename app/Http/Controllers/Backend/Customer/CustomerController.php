<?php

namespace App\Http\Controllers\Backend\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Customer\CustomerModel;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Customer\StoreCustomerRequest;
use App\Http\Requests\Backend\Customer\UpdateCustomerRequest;
use App\Repositories\Backend\Customer\CustomerRepository;

class CustomerController extends Controller {

    public function __construct(CustomerRepository $cust) {
       
        $this->cust = $cust;
//        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    StoreCustomerRequest $request
    public function store(StoreCustomerRequest $request) {
        $storeCustomer = $this->cust->create($request->all());
        return redirect()->route('admin.customer.index')->withFlashSuccess('The customer was successfully created. ');
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
    public function edit(CustomerModel $customer) {
        return view('backend.customer.edit', ['cust' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */       

    public function update(CustomerModel $customer, UpdateCustomerRequest $request) {
        

        $this->cust->update($customer, $request->all());

        return redirect()->route('admin.customer.index')->withFlashSuccess('The customer was successfully updated. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerModel $customer) {
        $this->cust->delete($customer);
        return redirect()->route('admin.customer.index')->withFlashSuccess('The customer was successfully deleted. ');
    }

}
