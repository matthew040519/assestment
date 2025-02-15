@extends('layout')
@section('content')
<div class="content">
    <nav class="mb-3" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#!">Entry</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </nav>
    

  <div class="mb-9">
    <div id="projectSummary" >
      <div class="row mb-4 gx-6 gy-3 align-items-center">
        <div class="col-auto">
          <h2 class="mb-0">Category<span class="fw-normal text-body-tertiary ms-3"></span></h2>
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
      <div class="table-responsive scrollbar">
        
        <table class="table fs-9 mb-0 border-top border-translucent">
          <thead>
            <tr>
              <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" >ID</th>
              <th class="sort" scope="col" data-sort="assignees">Name</th>
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

    $(document).ready(function() {
        function getCategory() {
            $.ajax({
                url: '/api/getCategory',
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    if(data.status == 'success')
                    {
                        let productTableBody = $('#project-list-table-body');
                        productTableBody.empty();
                        data.category.forEach(function(product) {
                            console.log(product)
                            productTableBody.append(`
                                <tr>
                                    <td>${product.id}</td>
                                    <td>${product.name}</td>
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

        getCategory();
    });
  </script>
@endsection