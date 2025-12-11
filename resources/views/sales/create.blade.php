@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 p-2">
            <div class="col-sm-12">
                <h1 class="title text-dark"> 
                    <svg class="bi bi-cart3" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg> Transaction 
                </h1>
            </div>
        </div> 
    </div>
</div>
<div class="content">
    <div class="container-fluid lead">
        <div class="row" style="background-color:#fff;">
            <div class="col-md-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="create-newsale-tab" data-bs-toggle="tab" data-bs-target="#nav-new-sale" type="button" role="tab" aria-controls="nav-home" aria-selected="true">New Transaction</button>
                        <button class="nav-link" id="edit-sale-tab" data-bs-toggle="tab" data-bs-target="#nav-edit-sale" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Transaction</button>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-new-sale" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-12" style="margin-bottom:1em">
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
                                <form method="post" action="{{ route('sales.store') }}" id="createSaleForm">
                                    <div class="form-group"> 
                                        <label for="sales_notes">Notes</label> 
                                        <textarea id="sales_notes" name="notes" class= "form-control" placeholder="Put transaction notes here" style= "resize: none; line-height: 0.75;"></textarea>
                                        <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" value="" name="total" id="sale-total">
                                        <input type="hidden" value="{{ $store->store_id }}" name="store_id" id="sale-store-id">
                                    </div>
                                    <div class="form-group">
                                        <table class="table" style="font-size:18px;">
                                            <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cartTable"></tbody>
                                        </table>
                                    </div>
                                    <div class="form-group text-right">
                                        <h5>TOTAL Rp.<span id="cartTotal" class="text-bold">0</span></h5>
                                    </div> @csrf 
                                    <button type="submit" class="btn btn-dark btn-block btn-lg">Transaction</button> 
                                    
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-edit-sale" role="tabpanel" aria-labelledby="nav-profile-tab">
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-8" style="background-color:#f5f5f5;">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="show-product-tab" data-bs-toggle="tab" data-bs-target="#nav-show-products" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Products</button>
                        <button class="nav-link" id="show-sale-tab" data-bs-toggle="tab" data-bs-target="#nav-show-sale" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Today Sales</button>
                        <button class="nav-link" id="show-sale-tab" data-bs-toggle="tab" data-bs-target="#nav-show-report" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Today`s Report</button>
                    </div>
                    <div class="tab-content" id="nav-tabContentRight" style="padding-top:1em">
                        <div class="tab-pane fade show active" id="nav-show-products" role="tabpanel" aria-labelledby="nav-products-tab">
                            <input type="text" placeholder="Search" id="product-search" class=form-control style="margin-top:1em;margin-bottom:2em;margin-left:1em;width:1000px">
                            <div style="width:100%;overflow-y:auto;height:590px">
                                @foreach($products as $product)
                                <div class="btn-product-data-container col-md-2 p-2 p-md-3 bg-dark rounded text-light text-center" style="height:183px;float:left;margin-left:1em;margin-bottom:1em;"> 
                                    <h5 style="font-weight:bold;">{{ $product->name }}</h5>
                                    @php
                                        $varians=[];
                                        foreach ($product->varians as $data_varian) {
                                            array_push($varians, trim($data_varian->name));
                                        }
                                    @endphp
                                    <h6 class="prod-card-varian" style="margin-top:1em">{{ $varians ? implode(" | ", $varians) : "-"}}</h6>
                                    <h6 class="prod-card-price" style="margin-top:1em;font-size:bold;bottom:0.3em;left:0;position:absolute;width:100%;border-top: 1px solid #fff;padding-top:0.3em">Rp {{ $product->price }},-</h6>
                                    <div class="btn-product-data" style = "width:100%;height:100%;position:absolute;top:0;left:0;z-index:10;background-color:none;cursor:pointer"
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
                        </div>
                        <div class="tab-pane fade" id="nav-show-sale" role="tabpanel" aria-labelledby="nav-show-sale">
                            test
                        </div>
                        <div class="tab-pane fade" id="nav-show-report" role="tabpanel" aria-labelledby="nav-show-report">
                            Report
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div> 

<!-- Add Product Modal -->
<!-- Button trigger modal -->
<button id="add-product-modal-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-product-modal" style="display:none">
  Add product to charts
</button>

<!-- Modal -->
<div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-product-modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="add-product-desc" style="justify-content:center;padding-bottom:1em;border-bottom:var(--bs-modal-header-border-width) solid var(--bs-modal-header-border-color);">
            <div id="add-product-desc"></div>
        </div>
        <div class="row" id="add-product-amount" style="justify-content: center;">
            <label style="text-align:center;">Quantity:</label>
            <div class="input-group quantity-field" style="width: 200px;">
                <button id="product-modal-amount-subs" class="btn btn-danger button-minus" type="button">-</button>
                <input id="add-product-modal-amount" type="number" class="form-control text-center" value="1" min="1" max="100" name="quantity-input">
                <button id="product-modal-amount-add" class="btn btn-dark button-plus" type="button">+</button>
            </div>
        </div>
        <div class="row" id="add-product-varian" style="justify-content: center;">
            <label style="text-align:center;">Varian:</label>
            <div id="product-varian-container" style="justify-content:center;width:auto;">
                <input type="radio" class="btn-check" name="prod-varian-radio" id="option5" autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="option5">Es</label>

                <input type="radio" class="btn-check" name="prod-varian-radio" id="option6" autocomplete="off">
                <label class="btn btn-outline-dark" for="option6">Anget</label>

                <input type="radio" class="btn-check" name="prod-varian-radio" id="option8" autocomplete="off">
                <label class="btn btn-outline-dark" for="option8">Biasa</label>                  
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-dark" id="save-product-modal-button">Add Product</button>
      </div>
    </div>
  </div>
</div>
<script>
    const elementsProductsContainer = document.querySelectorAll('.btn-product-data-container');
    const elementsProducts = document.querySelectorAll('.btn-product-data');
    const modalQtySubs = document.querySelector('#product-modal-amount-subs');
    const modalQtyAdd = document.querySelector('#product-modal-amount-add');
    const searchProductInput = document.getElementById('product-search');
    const addProdToCartButton = document.getElementById('save-product-modal-button');

    modalQtySubs.addEventListener('click', subsModalQty)
    modalQtyAdd.addEventListener('click', addModalQty);;
    searchProductInput.addEventListener('keyup', searchProduct);
    addProdToCartButton.addEventListener('click',addProductModalToCart);
                                        
    elementsProducts.forEach(elementsProduct => {
        elementsProduct.addEventListener('click', selectProductData);
    });                                       
    
    function subsModalQty(e) {
        var currentVal = parseInt($('#add-product-modal-amount').val());
        
        if (currentVal > 1) { 
            var nextVal = currentVal - 1;
            $('#add-product-modal-amount').val(nextVal);
            if (nextVal == 1) { 
                modalQtySubs.setAttribute('disabled',true); 
            }
        }
        
    }

    function addModalQty(e) {
        var currentVal = parseInt($('#add-product-modal-amount').val());
        $('#add-product-modal-amount').val(currentVal+1); 
        modalQtySubs.removeAttribute('disabled');
    }

    function selectProductData(e){
        e.preventDefault();
        
        var product = e.target.dataset;
        var varians = JSON.parse(product.varians);

        $('#add-product-modal-title').html(product.name);
        $('#add-product-modal-amount').val(1);
        modalQtySubs.setAttribute('disabled',true);
        $('#add-product-desc').html(product.description); 

        $('#product-varian-container').empty();
        varians.forEach((varian,index)=>{
            // <input type="radio" class="btn-check" name="prod-varian-radio" id="option5" autocomplete="off" checked>
            //     <label class="btn btn-outline-dark" for="option5">Es</label>
            var inputElement = document.createElement('input');
            inputElement.setAttribute('type','radio');
            inputElement.setAttribute('class','btn-check');
            inputElement.setAttribute('name','prod-varian-radio');
            inputElement.setAttribute('id','option'+(index+1));
            inputElement.setAttribute('autocomplete','off');
            inputElement.value = varian.name;
            if (index == 0){ inputElement.setAttribute('checked',true); }

            $('#product-varian-container').append(inputElement);

            var labelElement = document.createElement('label');
            labelElement.setAttribute('class','btn btn-outline-dark');
            labelElement.setAttribute('for','option'+(index+1));
            labelElement.setAttribute('style','margin:1px');
            labelElement.textContent = varian.name;
            
            $('#product-varian-container').append(labelElement);
            $('#save-product-modal-button').data('product',JSON.stringify(product));
        });
        $('#add-product-modal-button').click();
    }

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

    function addProductModalToCart(){
        var product = JSON.parse($('#save-product-modal-button').data('product'));
        var selectedVar = $('#product-varian-container input:radio:checked').val();
        var quantity = parseInt($('#add-product-modal-amount').val());
        var totalProdOnCart = $(".cart-row-prod").length;
        var totalPrice = quantity * parseInt(product.price);

        var rowId = "cart_row_"+product.product_id+"_"+selectedVar;

        if ($("#"+rowId).length == 0){
            var newElementRow = document.createElement('tr');
            newElementRow.setAttribute('id',rowId);
            newElementRow.setAttribute('class','cart-row-prod');

            $('#cartTable').append(newElementRow);
            //Quantity to show
            var newElementQty = document.createElement('td');
            newElementQty.textContent = quantity;
            
            //Product to show
            var newElementProd = document.createElement('td');
            newElementProd.innerHTML = product.name+"<br>("+selectedVar+")";

            //Price to show
            var newElementPrice = document.createElement('td');
            newElementPrice.textContent = "Rp. "+product.price+",-";

            //Price to show
            var newElementTotal = document.createElement('td');
            newElementTotal.textContent = "Rp. "+totalPrice+",-";

            newElementRow.appendChild(newElementQty);
            newElementRow.appendChild(newElementProd);
            newElementRow.appendChild(newElementPrice);
            newElementRow.appendChild(newElementTotal);

            
        }
    }
</script>@endsection