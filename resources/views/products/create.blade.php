@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 p-2">
            <div class="col-sm-12">
                <h1 class="title text-dark"> 
                    <svg class="bi bi-ui-checks-grid" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z"/>
                    </svg> 
                    Products 
                </h1>
            </div>
        </div>
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
                            <div class="row">
                                <div class="col-12">
                                    @if(session('created'))
                                    <div class="alert alert-success">
                                        @foreach(session('created') as $success) {{ $success }}
                                        <br>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(session('errors'))
                                    <div class="alert alert-danger">
                                        @foreach(session('errors') as $error) {{ $error }}
                                        <br>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <form method="post" action="{{ route('products.store') }}">
                                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                                <div class="card-body" style="margin-bottom:1em;"> 
                                    <div class="form-group" style="margin-top:1em"> 
                                        <label>Product Name</label> 
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
                                        <input type="number" min="0" name="price" class="form-control" required>
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
                                        <input type="number" min="0" name="cost" class="form-control">
                                    </div>
                                    <div class="form-group" id="varians-input" style="margin-top:2em;"> 
                                        <label>Varians</label> 
                                        <button id="add-varian-input-create" class="btn btn-lg" style="float:right; margin-top: -0.5em">
                                            <svg class="bi bi-plus-square-fill" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                                            </svg>
                                        </button>
                                        <div id="error-add-varian-input-create"></div>
                                    </div>
                                    @csrf 
                                    <button onclick="return confirm('Save Product ?');" type="submit" class="btn btn-dark btn-block btn-lg" name="action" value="create">Add New Product</button>
                                </div>    
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form method="post" action="{{ route('products.store') }}">
                                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                                <div class="card-body" style="margin-bottom:2em;"> 
                                    <div class="form-group" style="margin-top:1em"> 
                                        <label>Product ID</label> 
                                        <input type="number" class="form-control" value="" name="product_id" id="edit-product-id" placeholder="Product Name" readonly>
                                    </div>
                                    <div class="form-group" style="margin-top:1em"> 
                                        <label>Product Name</label> 
                                        <input type="text" class="form-control" value="" name="name" id="edit-product-name" placeholder="Product Name" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Categories</label> 
                                        <select required name="category_id" id="edit-product-catId" class="form-control">
                                            <option value="">Select Categories</option> 
                                            @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}"> {{ $category->name }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Sell Price</label> 
                                        <input type="number" min="1" name="price" id="edit-product-price" class="form-control" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Description </label>
                                        <textarea class="form-control" name="description" id="edit-product-description" ></textarea>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Inventori </label> 
                                        <input type="number" min="0" name="product_left"  id="edit-product-inventory" class="form-control">
                                    </div>
                                    <div class="form-group"> 
                                        <label>Cost</label> 
                                        <input type="number" min="1" name="cost" id="edit-product-cost" class="form-control">
                                    </div>
                                    <div class="form-group"> 
                                        <label>Total Sold</label> 
                                        <input type="number" min="1" name="total_sold" id="edit-product-sold" class="form-control" readonly>
                                    </div>
                                    <div class="form-group" id="edit-product-varians" style="margin-top:2em;"> 
                                        <label>Varians</label> 
                                        <button id="add-varian-input-edit" class="btn btn-lg" style="float:right; margin-top: -0.5em">
                                            <svg class="bi bi-plus-square-fill" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                                            </svg>
                                        </button>
                                        <div id="error-add-varian-input-edit"></div>
                                    </div>
                                    @csrf 
                                    <button onclick="return confirm('Save Product Change ?');" type="submit" class="btn btn-dark btn-block btn-lg" name="action" value="edit">Edit Product</button>
                                    <!--button onclick="return confirm('Delete Product ?');" type="submit" class="btn btn-danger btn-block btn-lg" name="action" value="delete">Delete Product</button-->
                                </div>    
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="Search" id="product-search" class=form-control style="margin-bottom:2em;margin-left:1em;width:1000px">
                @foreach($products as $product)
                <div class="btn-product-data-container col-md-2 p-2 p-md-3 bg-dark rounded text-light text-center" style="height:183px;float:left;margin-left:1em;margin-bottom:1em;"> 
                    <h5 data-id="{{$product->category_id}}" data-name="{{$product->category->name}}" style="font-weight:bold;">{{ $product->name }}</h5>
                    @php
                        $varians=[];
                        foreach ($product->varians as $data_varian) {
                            array_push($varians, trim($data_varian->name));
                        }
                    @endphp
                    <h6 class="prod-card-varian" style="margin-top:1em">{{ $varians ? implode(" | ", $varians) : $product->description}}</h6>
                    <h6 class="prod-card-price" style="margin-top:1em;font-size:bold;bottom:0.3em;left:0;position:absolute;width:100%;border-top: 1px solid #fff;padding-top:0.3em">Rp {{ $product->price }},00</h6>
                    <div class="btn-product-data" style = "width:100%;height:100%;position:absolute;top:0;left:0;z-index:99;background-color:none;cursor:pointer"
                        data-id="{{$product->product_id}}" 
                        data-name="{{$product->name}}" 
                        data-price = "{{$product->price }}"
                        data-cost = "{{$product->cost }}"
                        data-description = "{{$product->description }}"
                        data-inventory = "{{$product->product_left }}" 
                        data-category_id = "{{$product->category_id }}" 
                        data-store_id = "{{$product->store_id }}" 
                        data-sold = "{{$product->total_sold }}" 
                        data-varians = "{{ json_encode($product->varians) }}"
                    > 
                    </div>
                </div>
                @endforeach
            </div>
            <script>
                const elementsProducts = document.querySelectorAll('.btn-product-data');
                const elementsProductsContainer = document.querySelectorAll('.btn-product-data-container');

                const searchProductInput = document.getElementById('product-search');
                searchProductInput.addEventListener('keyup', searchProduct);

                var addNewVarian = document.querySelector('#add-varian-input-create');
                addNewVarian.addEventListener('click', addVarianInputCreate);

                var addNewVarianEdit = document.querySelector('#add-varian-input-edit');
                addNewVarianEdit.addEventListener('click', addVarianInputEdit);

                elementsProducts.forEach(elementsProduct => {
                    elementsProduct.addEventListener('click', selectProductData);
                });

                function searchProduct(e){
                    e.preventDefault;
                    var keyword = e.target.value.trim().toLowerCase()

                    elementsProductsContainer.forEach(elementsProductCard => {
                        //get data
                        var dataset = elementsProductCard.querySelector('.btn-product-data').dataset;
                        var prodName = dataset.name.trim().toLowerCase();
                        var prodDesc = dataset.description.trim().toLowerCase();

                        if (prodName.indexOf(keyword) == -1 && prodDesc.indexOf(keyword) == -1) {
                            elementsProductCard.hidden = true;
                        }else{
                            elementsProductCard.hidden = false;
                        }
                    });

                }

                function selectProductData(e){
                    e.preventDefault();
                    $('#edit-prod-tab').trigger('click');

                    var dataElement = e.target.dataset;
                
                    $("#edit-product-id").val(dataElement.id);
                    $("#edit-product-name").val(dataElement.name);
                    $("#edit-product-catId").val(dataElement.category_id);
                    $("#edit-product-price").val(dataElement.price);
                    $("#edit-product-description").val(dataElement.description);
                    $("#edit-product-inventory").val(dataElement.inventory);
                    $("#edit-product-cost").val(dataElement.cost);
                    $("#edit-product-sold").val(dataElement.sold);

                    var varians = JSON.parse(dataElement.varians);

                    // empty varian container
                    $('.edit-prod-varian-container').remove();

                    varians.forEach((varian)=>{
                        var divVarians = document.getElementById("edit-product-varians");
                        
                        var divInput = document.createElement('div');
                        divInput.setAttribute('style','position:relative;')
                        divInput.setAttribute('class','edit-prod-varian-container')

                        var varianInput = document.createElement('input');
                        varianInput.setAttribute('type','text');
                        varianInput.setAttribute('name','varian[]');
                        varianInput.setAttribute('class','form-control edit-product-varian-name');
                        varianInput.setAttribute('style','padding-right: 40px; box-sizing: border-box');
                        varianInput.value = varian.name;

                        divInput.appendChild(varianInput);

                        var buttonRemoveStyle = 'position:absolute;right:0px;top:0.05em';
                        var buttonRemove = document.createElement('button')
                        buttonRemove.textContent = 'X';
                        buttonRemove.setAttribute('class','btn btn-danger');
                        buttonRemove.setAttribute('style', buttonRemoveStyle);
                        buttonRemove.addEventListener('click', removeVarianInput);
                        
                        divInput.appendChild(buttonRemove);
                        divVarians.appendChild(divInput);
                    });
                }

                function addVarianInputEdit(e){
                    e.preventDefault();

                    var inputElements = document.querySelectorAll(".edit-product-varian-name");
                    var allowedToAdd = true;

                    inputElements.forEach((input, index) => {
                        const value = input.value.trim();
                        
                        if (value === "") {
                            const errorDiv = document.getElementById('error-add-varian-input-edit');
                            errorDiv.setAttribute('class','alert alert-danger');
                            errorDiv.append('To add more varian all existing varian can`t be empty');

                            allowedToAdd = false
                        } 
                    });

                    if (allowedToAdd) {
                        var divVarians = document.getElementById("edit-product-varians");
                        
                        var divInput = document.createElement('div');
                        divInput.setAttribute('style','position:relative;')
                        divInput.setAttribute('class','edit-prod-varian-container')

                        var varianInput = document.createElement('input');
                        varianInput.setAttribute('type','text');
                        varianInput.setAttribute('name','varian[]');
                        varianInput.setAttribute('class','form-control edit-product-varian-name');
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
                            const errorDiv = document.getElementById('error-add-varian-input-edit');
                            errorDiv.textContent = "";
                            errorDiv.removeAttribute('class');
                        }, "3000");
                    }
                }

                function addVarianInputCreate(e){
                    e.preventDefault();

                    var inputElements = document.querySelectorAll(".new-product-varian");
                    var allowedToAdd = true;

                    inputElements.forEach((input, index) => {
                        const value = input.value.trim();
                        
                        if (value === "") {
                            const errorDiv = document.getElementById('error-add-varian-input-create');
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
                        varianInput.setAttribute('class','form-control new-product-varian');
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
                            const errorDiv = document.getElementById('error--create');
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