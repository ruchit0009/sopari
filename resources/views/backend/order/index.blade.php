@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.order.management'))

@section('after-styles')
{{ Html::style("css/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
    {{ trans('labels.backend.order.management') }}
    <small>{{ trans('labels.backend.order.list') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.order.list') }}</h3>
        
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="table-responsive">
            <table id="main-cat-table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Delivery Charge</th>
                        <th>Packing Charge</th>
                        <th>Final Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!--table-responsive-->
    </div><!-- /.box-body -->
</div><!--box-->


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
            url: '{{ route("admin.order.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false},
            },
            columnDefs: [
            {"searchable": false, "targets": [6]},
            {"sortable": false, "targets": [6]},
            ],
            columns: [
            {data: 'name', name: '{{config('access.customer_table')}}.name'},
            {data: 'qty', name: '{{config('access.order_table')}}.qty' },
            {data: 'grand_total', name: '{{config('access.order_table')}}.grand_total' },
            {data: 'delivery_charge', name: '{{config('access.order_table')}}.delivery_charge' },
            {data: 'packing', name: '{{config('access.order_table')}}.packing' },
            {data: 'final_amount', name: '{{config('access.order_table')}}.final_amount' },
            {data: 'id', name: 'action'},
            ],
//                order: [[0, "asc"]],
//                searchDelay: 500
    });
    });
</script>
@endsection
