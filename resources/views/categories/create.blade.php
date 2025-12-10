@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 p-2">
            <div class="col-sm-12">
                <h1 class="title text-dark"> 
                    <svg class="bi bi-ui-checks-grid" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z"/>
                    </svg> 
                    Categories 
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
                        <button class="nav-link active" id="create-newcat-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">New Category</button>
                        <button class="nav-link" id="edit-cat-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Category</button>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            
                            <div class="row" style="margin-top:2em;">
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
                            <form method="post" action="{{ route('categories.store') }}">
                                <input type="hidden" id="new-cat-user-id" value="{{ Auth::user()->id }}">
                                <div class="card-body">
                                    
                                    <div class="form-group" style="margin-top:1em">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" id="newcategory-name-input" name="name" placeholder="Insert categories name"  value="{{ old('name') ?? '' }}" required>
                                    </div>
                                    @csrf

                                    <button style="margin-top:1em" id="submit-new-category" onclick='return confirm("Save this categories ??")' type="submit" class="btn btn-dark btn-block btn-lg" value="create" name="action">
                                        Create New Category
                                    </button>
                                </div>    
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form method="post" action="{{ route('categories.store') }}">
                                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                                
                                <div class="card-body">
                                    <div class="form-group" style="margin-top:1em">
                                        <label>Category ID</label>
                                        <input style="width:100%;" type="number" id="category-id-input" name="category_id" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" id="category-name-input" name="name" placeholder="Insert categories name"  value="{{ old('name') ?? '' }}" required>
                                    </div>
                                    @csrf

                                    <button style="margin-top:1em" id="submit-edit-category" onclick='return confirm("Save this categories ??")' type="submit" class="btn btn-dark btn-block btn-lg" value="edit" name="action">
                                        Edit Category
                                    </button>
                                    <button style="margin-top:1em" id="submit-edit-category" onclick='return confirm("Save this categories ??")' type="submit" class="btn btn-danger btn-block btn-lg" value="delete" name="action">
                                        Delete Category
                                    </button>
                                </div>    
                            </form>
                        </div>
                    </div>
                </nav>
                
            </div>
            <div class="col-md-8" style="margin-top:2em; padding-top:1em;">
                @foreach($categories as $category)
                <div data-id="{{$category->category_id}}" data-name="{{$category->name}}" class="btn-category-data col-md-2 p-2 p-md-3 bg-dark rounded text-light text-center" style="cursor:pointer;height:172px;"> 
                    <h4 data-id="{{$category->category_id}}" data-name="{{$category->name}}" style="font-weight:bold;">{{ $category->name }}</h3>
                </div>
                @endforeach
            </div>
        </div>
        
        <script>
            const saveButtonText = "Create New Category";
            const editButtonText = "Edit New Category";

            const elementsCategory = document.querySelectorAll('.btn-category-data');
            const elementsCatId = document.querySelector('#category-id-input');
            const elementsCatName = document.querySelector('#category-name-input');
            
            const submitButton = document.querySelector('#submit-category');

            // const elementsRadioEdit = document.querySelector('#editCategoryAction');
            // const elementsRadioCreate = document.querySelector('#newCategoryAction');
            
            // elementsRadioCreate.addEventListener('change', goToCreateNewMode);
            
            elementsCategory.forEach(elementsCategory => {
                elementsCategory.addEventListener('click', selectCategoryData);
            });

            function selectCategoryData(e){
                e.preventDefault();
                $('#edit-cat-tab').trigger('click');

                var dataElement = e.target.dataset;
                
                elementsCatId.value = dataElement.id;
                elementsCatName.value = dataElement.name;

                
            }

        </script>
    </div>
</div>@endsection