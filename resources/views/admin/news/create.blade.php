@extends('layouts.admin')

@section('title', 'Create News')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create News</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></li>
                            <li class="breadcrumb-item active">Create News</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        @include('admin.includes.messages')
        <section class="content">
            <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                    id="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desciption" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label">Status</label>
                            <div class="col-md-10">
                                <div class="form-check">
                                    <input name="status" id="status" class="form-check-input" type="checkbox"
                                        value="published" @if (old('status')) checked @endif>
                                    <label class="form-check-label" for="status">Publik</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <input onchange="readURL(this, 'image');" name="image" type="file"
                                    accept="image/gif, image/jpeg, image/png" id="image">
                                <div class="invalid-feedback" id="image_error"></div>
                                <div id="image-display">
                                    <img id="blah-image" src="{{ asset('no-image.jpg') }}" alt="Mengambil Foto ..."
                                        class="mt-2" style="height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('after-scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
