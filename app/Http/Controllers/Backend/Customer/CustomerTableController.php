<?php

namespace App\Http\Controllers\Backend\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Customer\CustomerRepository;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class CustomerTableController extends Controller {

    /**
     * @var JobRepository
     */
    protected $cust;

    /**
     * @param JobRepository $jobs
     */
    public function __construct(CustomerRepository $customer) {
        $this->cust = $customer;
    }

    /**
     * @param ManageJobRequest $request
     *
     * @return mixed
     */
    public function __invoke() {
        return Datatables::of($this->cust->getForDataTable())
                        ->escapeColumns(['name'])
                      
                        ->addColumn('debit_payment', function ($cust) {
                            return $cust->order_payment - $cust->credit_payment;
                        })
                        ->editColumn('id', function ($cust) {
                             if (Auth::user()->roles->pluck('id')[0] == 1) {
                                return $cust->action_buttons;
                            } else {
                                return '<b>--</b>';
                            }
                        })
                        ->withTrashed()
                        ->make(true);
    }

}
