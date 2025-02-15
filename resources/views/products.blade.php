@extends('layout')
@section('content')
<div class="content">
    <nav class="mb-3" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#!">Entry</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
    

  <div class="mb-9">
    <div id="projectSummary" >
      <div class="row mb-4 gx-6 gy-3 align-items-center">
        <div class="col-auto">
          <h2 class="mb-0">Product<span class="fw-normal text-body-tertiary ms-3"></span></h2>
        </div>
        <div class="col-auto"><a class="btn btn-primary px-5" href="#" data-bs-toggle="modal" data-bs-target="#verticallyCentered"><i class="fa-solid fa-plus me-2"></i>Add Product</a></div>
      </div>
      <div class="row g-3 justify-content-between align-items-end mb-4">
        <div class="col-12 col-sm-auto">
          
        </div>
        <div class="col-12 col-sm-auto">
          <div class="d-flex align-items-center">
            <div class="search-box me-3">
              <form class="position-relative">
                <input class="form-control search-input search" type="search" placeholder="Search Product" aria-label="Search" oninput="searchProduct(this.value)" />
                <span class="fas fa-search search-box-icon"></span>

              </form>
            </div>
          </div>
        </div>
      </div>
      @if(session('status'))
      <div class="alert alert-outline-danger d-flex align-items-center" role="alert">
        <span class="fas fa-times-circle text-danger fs-5 me-3"></span>
        <p class="mb-0 flex-1">{{ session('status') }}</p>
      
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if(session('success'))
      <div class="alert alert-outline-success d-flex align-items-center" role="alert">
        <span class="fas fa-plus-circle text-success fs-5 me-3"></span>
        <p class="mb-0 flex-1">{{ session('success') }}</p>
      
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="modal fade" id="verticallyCentered" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="verticallyCenteredModalLabel">Add New Product</h5>
              <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              {{-- <form method="POST"> --}}
                @csrf
                <div class="mb-3">
                    <input type="file" id="file" class="form-control">
                </div>
                <div class="mb-3">
              
                  <label class="form-label" for="basic-form-name">Name</label>
              
                  <input class="form-control" id="name" name="name" type="text" placeholder="Name" />
                </div>
                <div class="mb-3">
              
                  <label class="form-label" for="basic-form-name">Category</label>
              
                  {{-- <input class="form-control" id="basic-form-name" name="contact" type="number" placeholder="Contact Number" /> --}}
                    <select class="form-select" id="category" name="category">
                        @foreach($category as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-form-name">Price</label>
                    <input class="form-control" id="price" name="price" type="number" placeholder="Price" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-form-name">Stock</label>
                    <input class="form-control" id="stock" name="stock" type="number" placeholder="Stock" />
                  </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-form-textarea">Description</label>
                  <textarea class="form-control" id="description" name="address" rows="3" placeholder="Address"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="addProduct" type="submit">Add</button>
              <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
            {{-- </form> --}}
          </div>
        </div>
      </div>
      <div class="table-responsive scrollbar">
        
        <table class="table fs-9 mb-0 border-top border-translucent">
          <thead>
            <tr>
              <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" >Products Image</th>
              <th class="sort" scope="col" data-sort="assignees">Product</th>
              <th class="sort" scope="col" data-sort="start">Category</th>
              <th class="sort" scope="col" data-sort="start">Price</th>
              <th class="sort" scope="col" data-sort="start" style="text-align: center;">Options</th>
            </tr>
          </thead>
          <tbody class="list" id="project-list-table-body">
           
          </tbody>
        </table>
        
      </div>
      <div class="d-flex flex-wrap align-items-center justify-content-between py-3 pe-0 fs-9 border-bottom border-translucent">
        <div class="d-flex">
          {{-- <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a> --}}
        </div>
        
      </div>
    </div>
  </div>
    @include('includes.footer')
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function deleteProduct(productId) {
            if(confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: `/api/deleteproduct/${productId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if(data.status == 'success') {
                            // getProducts();
                            alert('Product deleted successfully');
                            location.reload();
                        } else {
                            alert('Failed to delete product');
                        }
                    },
                    error: function(error) {
                        console.error('Error deleting product:', error);
                    }
                });
            }
        }

    function searchProduct(value) {
        $.ajax({
            url: `/api/searchProducts`,
            method: 'GET',
            data: { name: value },
            success: function(data) {
            if(data.status == 'success') {
                let productTableBody = $('#project-list-table-body');
                productTableBody.empty();
                data.products.forEach(function(product) {
                productTableBody.append(`
                    <tr>
                        <td><img src="images/${product.image}" alt="${product.name}" width="50"></td>
                                    <td>${product.name}</td>
                                    <td>${product.category.name}</td>
                                    <td>${product.price}</td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-sm btn-success edit-product" href="products/${product.id}">Edit</a>
                                        <button class="btn btn-sm btn-danger delete-product" onclick="deleteProduct(${product.id})">Delete</button>
                                    </td>
                    </tr>
                `);
                });
            } else {
                alert('No products found');
            }
            },
            error: function(error) {
            console.error('Error searching products:', error);
            }
        });
    }

    $(document).ready(function() {
        function getProducts() {
            $.ajax({
                url: '/api/getProducts',
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    if(data.status == 'success')
                    {
                        let productTableBody = $('#project-list-table-body');
                        productTableBody.empty();
                        data.products.forEach(function(product) {
                            console.log(product)
                            productTableBody.append(`
                                <tr>
                                    <td><img src="images/${product.image}" alt="${product.name}" width="50"></td>
                                    <td>${product.name}</td>
                                    <td>${product.category.name}</td>
                                    <td>${product.price}</td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-sm btn-primary edit-product" href="products-show/${product.id}">View</a>
                                        <a class="btn btn-sm btn-success edit-product" href="products/${product.id}">Edit</a>
                                        <button class="btn btn-sm btn-danger delete-product" onclick="deleteProduct(${product.id})">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                    
                },
                error: function(error) {
                    console.error('Error fetching products:', error);
                }
            });
        }

        $('#addProduct').on('click', function(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append('image', $('#file')[0].files[0]);
            formData.append('name', $('#name').val());
            formData.append('category', $('#category').val());
            formData.append('price', $('#price').val());
            formData.append('stock', $('#stock').val());
            formData.append('description', $('#description').val());

            $.ajax({
                url: '/api/addProducts',
                method: 'POST',
                data: formData,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                success: function(data) {
                    if(data.status == 'success') {
                        $('#verticallyCentered').modal('hide');
                        getProducts();
                        $('#file').val('');
                        $('#name').val('');
                        $('#category').val('');
                        $('#price').val('');
                        $('#stock').val('');
                        $('#description').val('');
                        alert('Product added successfully');
                    } else {
                        alert('Failed to add product');
                    }
                },
                error: function(error) {
                    console.error('Error adding product:', error);
                }
            });
        });

        getProducts();
    });
  </script>
@endsection