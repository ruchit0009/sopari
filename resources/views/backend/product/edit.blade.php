@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.product.management') . ' | ' . trans('labels.backend.product.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.product.management') }}
        <small>{{ trans('labels.backend.product.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($product,['route' => ['admin.product.update',$product], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH','files'=>'true']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.product.edit') }}</h3>

            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.product.name'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name',null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.product.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('qty', trans('validation.attributes.backend.product.qty'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::number('qty',null, ['class' => 'form-control', 'min'=>0, 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.product.qty')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

               
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.product.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection


