@extends('layouts.admin')

@section('title', 'News')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>News</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">News</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        @include('admin.includes.messages')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tb_data" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </section>
    </div>
@endsection

@push('after-scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js">
    </script>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#tb_data').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.news.datatable') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        className: "text-center",
                        orderable: false
                    },
                    {
                        data: "id",
                        render: function(data, type, row, meta) {
                            var img = `<img src="` + row.image + `" width="200"/>`;
                            return img;
                        },
                        className: "text-center",
                        orderable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: "id",
                        render: function(data, type, row, meta) {
                            var btn = ``;
                            btn +=
                                `<a class="ml-1 btn btn-warning" href="{{ route('admin.news.index') }}/` +
                                row.id + `/edit" title="Edit"><i class="fas fa-edit"></i></a>`;
                            btn += `
                                 <form method="POST" name="delete-item" action="{{ route('admin.news.index') }}/` + row
                                .id + `/destroy" class="d-inline">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-danger">
                                          <i class="fas fa-trash"></i>
                                       </button>
                                 </form>`;
                            return btn;
                        },
                        className: "text-center",
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endpush
