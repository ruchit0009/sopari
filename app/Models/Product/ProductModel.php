<?php

namespace App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\Attribute\ProductAttribute;
use App\Models\Common\Traits\Observer\CommonObserver;

class ProductModel extends Model {

    use SoftDeletes,
        CommonObserver,
        ProductAttribute;

    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','qty'];
    
      protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = config('access.product_table');
    }


}
