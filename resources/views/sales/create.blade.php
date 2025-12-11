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
        <div class="row">
            <div class="col-md-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="create-newsale-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">New Transaction</button>
                        <button class="nav-link" id="edit-sale-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Transaction</button>
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
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            
                        </div>
                    </div>
                </nav>
                <div class="card card-dark">
                    <div class="card-body">
                        <div id="js-requests-messages"></div> 
                        @if($errors->any())
                        <div class="alert alert-danger"> 
                            @foreach($errors->all() as $error) - {{ $error }} 
                                <br> 
                            @endforeach
                        </div> 
                        @endif
                        <form method="post" action="#" id="createSaleForm">
                            <div class="form-group"> 
                                <label for="rfc">Notes</label> 
                                <textarea id="sales_notes" name="notes" class= "form-control" placeholder="Put transaction notes here" style= "resize: none; line-height: 0.75;"></textarea>
                            </div>
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Set</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTable"></tbody>
                                </table>
                            </div>
                            <div class="form-group text-right">
                                <h5>TOTAL Rp.<span id="cartTotal" class="text-bold">0</span></h5>
                            </div> @csrf <button type="submit" class="btn btn-dark btn-block btn-lg">Transaction </button> <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                        </form>
                    </div>
                </div>
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
        </div>
    </div>
</div> 
<script>
    const elementsProductsContainer = document.querySelectorAll('.btn-product-data-container');

    const searchProductInput = document.getElementById('product-search');
    searchProductInput.addEventListener('keyup', searchProduct);

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
</script>@endsection