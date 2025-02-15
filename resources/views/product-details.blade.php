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
    <div id="projectSummary" data-list='{"valueNames":["projectName","assignees","start","deadline","task","projectprogress","status","action"],"page":6,"pagination":true}'>
      <div class="row mb-4 gx-6 gy-3 align-items-center">
        <div class="col-auto">
          <h2 class="mb-0">Product<span class="fw-normal text-body-tertiary ms-3"></span></h2>
        </div>
    </div>
      <div class="row g-3 justify-content-between align-items-end mb-4">
        <div class="col-12 col-sm-auto">
          
        </div>
        <div class="col-12 col-sm-auto">
          <div class="d-flex align-items-center">
            <div class="search-box me-3">
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
                
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="addProduct" type="submit">Add</button>
              <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
            {{-- </form> --}}
          </div>
        </div>
      </div>
      <div class="mb-3">
        <img id="images" class="img-fluid mb-3" style="height: 300px" alt="">
    </div>
    <div class="mb-3">
        <label class="form-label" for="basic-form-id">Product ID</label>
        <input class="form-control" id="productId" name="productId" type="text" placeholder="Product ID" readonly />
       
    </div>
    <div class="mb-3">
        
      <label class="form-label" for="basic-form-name">Name</label>
  
      <input class="form-control" id="name" name="name" type="text"/>
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
      <div class="d-flex flex-wrap align-items-center justify-content-between py-3 pe-0 fs-9 border-bottom border-translucent">
        <div class="d-flex">
          {{-- <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a> --}}
        </div>
      </div>
      <div class="modal-footer">
        {{-- <button class="btn btn-primary" id="updateProduct" type="submit">Update</button> --}}
        {{-- <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button> --}}
      </div>
    </div>
  </div>
    @include('includes.footer')
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/getproducts/' + {{ $id }},
            method: 'GET',
            success: function(data) {
                console.log(data)
                $('#image').text(data.products.image);
                $('#images').attr('src', '../images/' + data.products.image);
                $('#productId').val(data.products.id);
                $('#name').val(data.products.name);
                $('#category').val(data.products.category_id);
                $('#price').val(data.products.price);
                $('#stock').val(data.products.stock);
                $('#description').val(data.products.description);
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('#updateProduct').click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('image', $('#file')[0].files[0]);
            formData.append('name', $('#name').val());
            formData.append('category', $('#category').val());
            formData.append('price', $('#price').val());
            formData.append('stock', $('#stock').val());
            formData.append('description', $('#description').val());

            $.ajax({
            url: '/api/updateproduct/' + {{ $id }},
            method: 'POST',
            data: formData,
            processData: false,
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            contentType: false,
            success: function(response) {
                if(response.status == 'success') {
                alert('Product updated successfully');
                location.reload();
                } else {
                alert('Failed to update product');
                }
            },
            error: function(error) {
                console.log(error);
                alert('An error occurred');
            }
            });
        });
    });
  </script>
@endsection