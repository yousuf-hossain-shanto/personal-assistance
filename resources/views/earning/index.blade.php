@extends('layouts.app')

@section('page_title', 'Earnings')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Earnings
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
                                <th>Wallet</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($earnings as $earning)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($earning->wallet)->name }}</td>
                                    <td>{{ $earning->amount }} {{ config('app.currency') }}</td>
                                    <td>{{ $earning->date->format('d M Y') }}</td>
                                    <td>{{ $earning->remarks }}</td>
                                    <td>
                                        @if($earning->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($earning->status == 1)
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            <span class="badge badge-danger">Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($earning->status == 0)
                                        <button class="btn btn-warning btn-edit" data-id="{{ $earning->id }}"
                                                data-wallet_id="{{ $earning->wallet_id }}"
                                                data-date="{{ $earning->date->format('Y-m-d') }}"
                                                data-amount="{{ $earning->amount }}"
                                                data-remarks="{{ $earning->remarks }}"
                                                data-status="{{ $earning->status }}">
                                            Edit
                                        </button>
                                        @endif
                                        <button class="btn btn-danger btn-delete" data-id="{{ $earning->id }}">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $earnings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Earning</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('earning.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
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
                    <h4 class="modal-title">Edit Earning</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Wallet</label>
                            <select name="wallet_id" id="wallet_id" class="form-control">
                                <option value="">No Wallet</option>
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="0">Pending</option>
                                <option value="1">Paid</option>
                                <option value="2">Failed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
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
                    <h4 class="modal-title">Delete Earning</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure to delete this earning?</h3>
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
                            var url = '{{ url('earning') }}/' + data.value;
                            $('#edit-modal form').prop('action', url);
                        }
                        $('#' + data.name).val(data.value);
                    })

                    $('#edit-modal').modal('show');
                })
                $(document).on('click', '.btn-delete', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var url = '{{ url('earning') }}/' + id
                    $('#delete-modal form').prop('action', url);
                    $('#delete-modal').modal();
                })
            })
        })(jQuery)
    </script>
@endsection
