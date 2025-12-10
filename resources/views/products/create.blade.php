@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container lead text-center">
        <h1 class="m-0 text-dark"> Products</h1> @if(session('created'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success"> Success Update</div>
            </div>
        </div> @endif
    </div>
</div>
<div class="content">
    <div class="container-fluid lead">
        <div class="row">
            <div class="col-md-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="create-newprod-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">New Product</button>
                        <button class="nav-link" id="edit-prod-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Product</button>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form method="post" action="{{ route('products.store') }}">
                                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                                <div class="card-body"> 
                                    @if($errors->any())
                                    <div class="alert alert-danger"> 
                                        @foreach($errors->all() as $error) - {{ $error }} 
                                        <br> 
                                        @endforeach
                                    </div> 
                                    @endif
                                    <div class="form-group"> 
                                        <label>Product</label> 
                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Product Name" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Categories</label> <select required name="category_id" class="form-control">
                                            <option value="">Select Categories</option> 
                                            @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}"> {{ $category->name }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Sell Price</label> 
                                        <input type="number" min="1" name="price" class="form-control" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Description </label>
                                        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Inventori </label> 
                                        <input type="number" min="0" name="product_left" class="form-control">
                                    </div>
                                    <div class="form-group"> 
                                        <label>Cost</label> 
                                        <input type="number" min="1" name="cost" class="form-control">
                                    </div>
                                    <div class="form-group" id="varians-input" style="margin-top:2em;"> 
                                        <label>Varians</label> 
                                        <button id="add-varian-input" class="btn btn-lg" style="float:right; margin-top: -0.5em">
                                            <svg class="bi bi-plus-square-fill" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                                            </svg>
                                        </button>
                                        <div id="error-add-varian-input"></div>
                                    </div>
                                    @csrf 
                                    <button onclick="return confirm('Save Product ?');" type="submit" class="btn btn-dark btn-block btn-lg">Save </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            test 1
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-8" style="margin-top:2em; padding-top:1em;">
                @foreach($products as $product)
                <div data-id="{{$category->category_id}}" data-name="{{$category->name}}" class="btn-category-data col-md-2 p-2 p-md-3 bg-dark rounded text-light text-center" style="cursor:pointer;height:172px;"> 
                    <h4 data-id="{{$category->category_id}}" data-name="{{$category->name}}" style="font-weight:bold;">{{ $product->name }}</h3>
                </div>
                @endforeach
            </div>
            <script>
                var addNewVarian = document.querySelector('#add-varian-input');
                addNewVarian.addEventListener('click', addVarianInput);

                function addVarianInput(e){
                    console.log('its here')
                    e.preventDefault();

                    var inputElements = document.querySelectorAll("input[name='varian[]']");
                    var allowedToAdd = true;

                    inputElements.forEach((input, index) => {
                        const value = input.value.trim();
                        
                        if (value === "") {
                            const errorDiv = document.getElementById('error-add-varian-input');
                            errorDiv.setAttribute('class','alert alert-danger');
                            errorDiv.append('To add more varian all existing varian can`t be empty');

                            allowedToAdd = false
                        } 
                    });

                    if (allowedToAdd) {
                        var divVarians = document.getElementById("varians-input");
                        
                        var divInput = document.createElement('div');
                        divInput.setAttribute('style','position:relative;')

                        var varianInput = document.createElement('input');
                        varianInput.setAttribute('type','text');
                        varianInput.setAttribute('name','varian[]');
                        varianInput.setAttribute('class','form-control');
                        varianInput.setAttribute('style','padding-right: 40px; box-sizing: border-box');

                        divInput.appendChild(varianInput);

                        var buttonRemoveStyle = 'position:absolute;right:0px;top:0.05em';
                        var buttonRemove = document.createElement('button')
                        buttonRemove.textContent = 'X';
                        buttonRemove.setAttribute('class','btn btn-danger');
                        buttonRemove.setAttribute('style', buttonRemoveStyle);
                        buttonRemove.addEventListener('click', removeVarianInput);


                        divInput.appendChild(buttonRemove);
                        divVarians.appendChild(divInput);
                    }else{
                        setTimeout(() => {
                            const errorDiv = document.getElementById('error-add-varian-input');
                            errorDiv.textContent = "";
                            errorDiv.removeAttribute('class');
                        }, "3000");
                    }
                }

                function removeVarianInput(e){
                    e.preventDefault();
                    e.target.parentElement.remove()
                }
            </script>
        </div>
    </div>
</div>
</div> @endsection