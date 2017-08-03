<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class ProductTableController extends Controller {

    /**
     * @var JobRepository
     */
    protected $product;

    /**
     * @param JobRepository $jobs
     */
    public function __construct(ProductRepository $product) {
        $this->product = $product;
    }

    /**
     * @param ManageJobRequest $request
     *
     * @return mixed
     */
    public function __invoke() {
        return Datatables::of($this->product->getForDataTable())
                        ->escapeColumns(['name','qty'])
                      
                       
                        ->editColumn('id', function ($product) {
                             if (Auth::user()->roles->pluck('id')[0] == 1) {
                                return $product->action_buttons;
                            } else {
                                return '<b>--</b>';
                            }
                        })
                        ->withTrashed()
                        ->make(true);
    }

}
