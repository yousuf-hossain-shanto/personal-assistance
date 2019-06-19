@extends('layouts.app')

@section('page_title', 'Recurring Expenses')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Recurring Expenses
                        <button class="float-right btn btn-success btn-sm btn-new" data-toggle="modal"
                                data-target="#newModal">Add New
                        </button>
                    </div>
                    <div class="card-body">
                        @include('layouts.notify')

                        <table class="table table-stripped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expense->head->title }}</td>
                                    <td>{{ $expense->amount_interval }}</td>
                                    <td>{{ $expense->remarks }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-edit" data-id="{{ $expense->id }}"
                                                data-expense_head_id="{{ $expense->expense_head_id }}"
                                                data-days_count="{{ $expense->days_count }}"
                                                data-amount="{{ $expense->amount }}"
                                                data-remarks="{{ $expense->remarks }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-delete" data-id="{{ $expense->id }}">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Expense</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('expense-recurring.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Expense Head</label>
                            <select name="expense_head_id" class="form-control" required>
                                @foreach($heads as $head)
                                    <option value="{{ $head->id }}">{{ $head->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Interval</label>
                            <select name="days_count" class="form-control" required>
                                <option value="1">Per day</option>
                                <option value="30">Per month</option>
                                <option value="90">Per 1/4 year</option>
                                <option value="120">Per 1/3 year</option>
                                <option value="180">Per half year</option>
                                <option value="360">Per year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Amount</label>
                            <input type="text" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Remarks</label>
                            <textarea name="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Expense</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Expense Head</label>
                            <select name="expense_head_id" id="expense_head_id" class="form-control" required>
                                @foreach($heads as $head)
                                    <option value="{{ $head->id }}">{{ $head->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Interval</label>
                            <select name="days_count" id="days_count" class="form-control" required>
                                <option value="1">Per day</option>
                                <option value="30">Per month</option>
                                <option value="90">Per 1/4 year</option>
                                <option value="120">Per 1/3 year</option>
                                <option value="180">Per half year</option>
                                <option value="360">Per year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Expense</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure to delete this expense?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script>
        (function ($) {
            $(document).ready(function () {
                $(document).on('click', '.btn-edit', function (e) {
                    e.preventDefault();

                    var datas = [];
                    [].forEach.call(this.attributes, function (attr) {
                        if (/^data-/.test(attr.name)) {
                            var camelCaseName = attr.name.substr(5).replace(/-(.)/g, function ($0, $1) {
                                return $1.toUpperCase();
                            });
                            datas.push({
                                name: camelCaseName,
                                value: attr.value
                            });
                        }
                    });
                    datas.forEach(function (data) {
                        if (data.name == 'id') {
                            var url = '{{ url('expense-recurring') }}/' + data.value;
                            $('#edit-modal form').prop('action', url);
                        }
                        $('#' + data.name).val(data.value);
                    })

                    $('#edit-modal').modal('show');
                })
                $(document).on('click', '.btn-delete', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var url = '{{ url('expense-recurring') }}/' + id
                    $('#delete-modal form').prop('action', url);
                    $('#delete-modal').modal();
                })
            })
        })(jQuery)
    </script>
@endsection
