<?php

namespace App\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Traits\Attribute\CustomerAttribute;
use App\Models\Common\Traits\Observer\CommonObserver;

class CustomerModel extends Model {

    use SoftDeletes,
        CommonObserver,
        CustomerAttribute;

    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
      protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = config('access.customer_table');
    }


}
