<?php

namespace App\Http\Requests\Backend\Order;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreOrderRequest.
 */
class StoreOrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasRole(1);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
                    'customer_id' => 'required',
        ];
        
        foreach ($this->request->get('product') as $key => $val) {
            $rules['product.'.$key.'.product_id'] = 'required';
            $rules['product.'.$key.'.qty'] = 'required|numeric';
            $rules['product.'.$key.'.price'] = 'required|numeric';
        }
        
         return $rules;
    }
}
