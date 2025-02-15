<nav class="navbar navbar-vertical navbar-expand-lg">
    {{-- <style>
      .disabled {
          color: #ccc;
          pointer-events: none; /* Prevent click events */
          cursor: not-allowed;
      }
  </style> --}}
      <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
          <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
              <!-- parent pages-->
              <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-home" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-home">
                  <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="pie-chart"></span></span><span class="nav-link-text">Home</span><span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                  </div>
                </a>
                <div class="parent-wrapper label-1">
                  <ul class="nav collapse parent show" data-bs-parent="#navbarVerticalCollapse" id="nv-home">
                    <li class="collapsed-nav-item-title d-none">Home
                    </li>
                    <li class="nav-item"><a class="nav-link active" href="/products">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Products</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-item"><a class="nav-link active" href="/category">
                        <div class="d-flex align-items-center"><span class="nav-link-text">Category</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <!-- label-->
              <p class="navbar-vertical-label">Apps
              </p>
              <hr class="navbar-vertical-line" />
            <div class="nav-item-wrapper"><a class="nav-link label-1" href="/logout" role="button" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center" id="logout"><span class="nav-link-icon"><span data-feather="log-out"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Logout</span></span>
              </div>
             </a>
            </div>
          </div>
            
            </li>
          </ul>
        </div>
      </div>
      <div class="navbar-vertical-footer">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
      </div>
    </nav>
    {{-- <script>
      const link = document.getElementById('logout');
  
        link.addEventListener('click', function(event) {
            this.classList.add('disabled'); // Add disabled styling
            link.textContent = 'Loading...';
        });
    </script> --}}