@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.customer.management'))

@section('after-styles')
{{ Html::style("css/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
    {{ trans('labels.backend.customer.management') }}
    <small>{{ trans('labels.backend.customer.list') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.customer.list') }}</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="table-responsive">
            <table id="main-cat-table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Payment</th>
                        <th>Credit Payment</th>
                        <th>Debit Payment</th>
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
            url: '{{ route("admin.customer.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false},
            },
            columnDefs: [
            {"searchable": false, "targets": [1,2,3, 4]},
            {"sortable": false, "targets": [0,1,2,3,4]},
            ],
            columns: [
            {data: 'name', name: '{{config('access.customer_table')}}.name'},
            {data: 'order_payment', name: '{{config('access.customer_table')}}.order_payment', },
            {data: 'credit_payment', name: '{{config('access.customer_table')}}.credit_payment'},
            {data: 'debit_payment', name: 'debit_payment'},
            {data: 'id', name: 'action'},
            ],
//                order: [[0, "asc"]],
//                searchDelay: 500
    });
    });
</script>
@endsection
