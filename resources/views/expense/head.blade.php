@extends('layouts.app')

@section('page_title', 'Expense Head')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Expense Heads
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
                                <th>Desc</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($heads as $head)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $head->title }}</td>
                                    <td>{{ $head->desc_excerpt }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-edit" data-id="{{ $head->id }}" data-title="{{ $head->title }}" data-description="{{ $head->description }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-delete" data-id="{{ $head->id }}">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $heads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Expense Head</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('expense-head.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
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
                    <h4 class="modal-title">Edit Head</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
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
                    <h4 class="modal-title">Delete Head</h4>
                    <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure to delete this expense head?</h3>
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
                    [].forEach.call(this.attributes, function(attr) {
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
                            var url = '{{ url('expense-head') }}/' + data.value;
                            $('#edit-modal form').prop('action', url);
                        }
                        $('#' + data.name).val(data.value);
                    })

                    $('#edit-modal').modal('show');
                })
                $(document).on('click', '.btn-delete', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var url = '{{ url('expense-head') }}/' + id
                    $('#delete-modal form').prop('action', url);
                    $('#delete-modal').modal();
                })
            })
        })(jQuery)
    </script>
@endsection
