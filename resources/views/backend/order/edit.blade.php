@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.order.management') . ' | ' . trans('labels.backend.order.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.order.management') }}
    <small>{{ trans('labels.backend.order.edit') }}</small>
</h1>
@endsection

@section('content')
{{ Form::model($order,['route' => ['admin.order.update',$order], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH','files'=>'true']) }}

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.order.edit') }}</h3>

    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            {{ Form::label('cust', trans('validation.attributes.backend.order.cust'), ['class' => 'col-lg-2 control-label required']) }}

            <div class="col-lg-10">
                {{ Form::select('customer_id', $customer,null, ['class' => 'form-control ',  'required' => 'required']) }}
            </div><!--col-lg-10-->
        </div><!--form control-->
        
         <hr>
        <center>
            <div class="form-group ">
                {{ Form::label('product', trans('validation.attributes.backend.order.product'), ['class' => ' control-label']) }}
            </div>
        </center>
        <div class="product-list">

            @php
            $timeIndex = 0;
            @endphp
            
             @if(!empty(old('product')[0]))
                    @foreach(old('product') as $key=>$d)
                    @php
                    $orderDetails['product'][$key] = $d;
                    @endphp 
                    @endforeach
                    @endif
            
            @if(!empty($orderDetails['product'][0]))
            @foreach($orderDetails['product'] as $key =>$pro)
            <div class="form-group ">
                
                {{ Form::hidden('product['.$key.'][id]', $pro['id'], ['class' => 'form-control id'.$timeIndex,  'required' => 'required','id'=>'poid']) }}
                {{ Form::label('product_id', trans('validation.attributes.backend.order.product'),
                     ['class' => 'col-lg-1 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::select('product['.$key.'][product_id]', $product,$pro['product_id'], ['class' => 'form-control prod product_id'.$timeIndex,  'required' => 'required','id'=>'product_id', 'placeholder' => trans('validation.attributes.backend.order.product')]) }}
                </div><!--col-lg-3-->

                {{ Form::label('qty', trans('validation.attributes.backend.order.qty'),
                     ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::number('product['.$key.'][qty]', $pro['qty'], ['class' => 'form-control qty'.$timeIndex, 'min'=>'1', 'required' => 'required','id'=>'qty', 'placeholder' => trans('validation.attributes.backend.order.qty')]) }}
                </div><!--col-lg-3-->
                {{ Form::label('price', trans('validation.attributes.backend.order.price'),
                     ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::number('product['.$key.'][price]',$pro['price'], ['class' => 'form-control price'.$timeIndex, 'min'=>'1', 'required' => 'required','id'=>'price', 'placeholder' => trans('validation.attributes.backend.order.price')]) }}
                </div><!--col-lg-3-->
                <div class="col-lg-1">

                    @if($timeIndex == 0)
                    {{ Form::button('+',['class = "avail_plus"']) }}
                    @else 
                    {{ Form::button('-',['class = "avail_minus"']) }}
                    @endif
                </div><!--col-lg-3-->
            </div><!--form control-->


            @php
            $timeIndex = $timeIndex + 1;
            @endphp

            @endforeach

            @else
            <div class="form-group ">
                {{ Form::label('product_id', trans('validation.attributes.backend.order.product'),
                     ['class' => 'col-lg-1 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::select('product[0][product_id]', $product,null, ['class' => 'form-control product_id'.$timeIndex,  'required' => 'required','id'=>'product_id', 'placeholder' => trans('validation.attributes.backend.order.product')]) }}
                </div><!--col-lg-3-->

                {{ Form::label('qty', trans('validation.attributes.backend.order.qty'),
                     ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::number('product[0][qty]', '', ['class' => 'form-control qty'.$timeIndex, 'min'=>'1', 'required' => 'required','id'=>'qty', 'placeholder' => trans('validation.attributes.backend.order.qty')]) }}
                </div><!--col-lg-3-->
                {{ Form::label('price', trans('validation.attributes.backend.order.price'),
                     ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-2">
                    {{ Form::number('product[0][price]', '', ['class' => 'form-control price'.$timeIndex, 'min'=>'1', 'required' => 'required','id'=>'price', 'placeholder' => trans('validation.attributes.backend.order.price')]) }}
                </div><!--col-lg-3-->
                <div class="col-lg-1">

                    {{ Form::button('+',['class = "avail_plus"']) }}
                </div><!--col-lg-3-->
            </div><!--form control-->
            @endif

        </div>
        
    </div><!-- /.box-body -->
</div><!--box-->

<div class="box box-info">
    <div class="box-body">
        <div class="pull-left">
            {{ link_to_route('admin.order.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
        </div><!--pull-left-->

        <div class="pull-right">
            {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
        </div><!--pull-right-->

        <div class="clearfix"></div>
    </div><!-- /.box-body -->
</div><!--box-->

{{ Form::close() }}




<div class="form-group product-clone" style="display: none">
     {{ Form::hidden('prod', '', ['class' => 'form-control ',  'required' => 'required','id'=>'poid']) }}
    {{ Form::label('product_id', trans('validation.attributes.backend.order.product'),
                     ['class' => 'col-lg-1 control-label required']) }}

    <div class="col-lg-2">
        {{ Form::select('prod', $product,null, ['class' => 'form-control prod ',  'required' => 'required','id'=>'product_id', 'placeholder' => trans('validation.attributes.backend.order.product')]) }}
    </div><!--col-lg-3-->

    {{ Form::label('qty', trans('validation.attributes.backend.order.qty'),
                     ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-2">
        {{ Form::number('prod', '', ['class' => 'form-control ', 'min'=>'1', 'required' => 'required','id'=>'qty', 'placeholder' => trans('validation.attributes.backend.order.qty')]) }}
    </div><!--col-lg-3-->
    {{ Form::label('price', trans('validation.attributes.backend.order.price'),
                     ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-2">
        {{ Form::number('prod', '', ['class' => 'form-control ', 'min'=>'1', 'required' => 'required','id'=>'price', 'placeholder' => trans('validation.attributes.backend.order.price')]) }}
    </div><!--col-lg-3-->
    <div class="col-lg-1">

        {{ Form::button('-',['class = "avail_minus"']) }}
    </div><!--col-lg-3-->
</div><!--form control-->

@endsection

@section('after-scripts')
{{ Html::script('js/backend/order.js') }}
@endsection

