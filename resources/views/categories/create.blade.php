@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container text-center lead">
        <h1 class="m-0 text-dark" x-text="cc"></h1>@if(session('created'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">Success create new categories</div>
            </div>
        </div>@endif
    </div>
</div>
<div class="content">
    <div class="container-fluid lead">
        <div class="row">
            <div class="col-12 col-md-3 p-3 p-md-4" style="box-shadow: 5px 0 10px rgba(0, 0, 0, 0.3);">
                <form method="post" action="{{ route('categories.store') }}">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error) - {{ $error }}
                            <br>@endforeach
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name" x-text="cn"></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Insert categories name" required>
                        </div>@csrf
                        <button onclick='return confirm("Save this categories ??")' type="submit" x-text="sv" class="btn btn-dark btn-block btn-lg">Save</button>
                </form>
            </div>
            <div class="col-12 col-md-6 p-3 p-md-6">
                
            </div>
        </div>
    </div>
</div>@endsection