@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.product.management'))

@section('after-styles')
{{ Html::style("css/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
    {{ trans('labels.backend.product.management') }}
    <small>{{ trans('labels.backend.product.list') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.product.list') }}</h3>
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add Product Quantity</button>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="table-responsive">
            <table id="main-cat-table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!--table-responsive-->
    </div><!-- /.box-body -->
</div><!--box-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close remove" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Quantity</h4>
            </div>
            <div class="modal-body popup_input_text">
                 {{ Form::open(['route' => 'admin.product.add-qty','role' => 'form', 'method' => 'post']) }}
            
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product<span class="req">*</span></label>
                         {{Form::select('product',$product,'',['class'=>'form-control','required' => 'required'])}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantity<span class="req">*</span></label>
                        <input type="number" min="1" class="form-control" required="required" name="qty">
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default remove" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Quantity</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
{{ Html::script("js/datatables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

<script>
    $(function () {


    $('#main-cat-table').DataTable({
    dom: 'lfrtip',
            processing: false,
            serverSide: true,
            autoWidth: false,
            ajax: {
            url: '{{ route("admin.product.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false},
            },
            columnDefs: [
            {"searchable": false, "targets": [2]},
            {"sortable": false, "targets": [2]},
            ],
            columns: [
            {data: 'name', name: '{{config('access.product_table')}}.name'},
            {data: 'qty', name: '{{config('access.product_table')}}.qty', },
            {data: 'id', name: 'action'},
            ],
//                order: [[0, "asc"]],
//                searchDelay: 500
    });
    });
</script>
@endsection
