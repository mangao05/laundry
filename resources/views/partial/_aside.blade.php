<aside class="main-sidebar elevation-4" style="background-image:url('image/login_bg1.png'); background-size: cover;   height: auto; ">
    <a href="home" class="brand-link">
      {{-- <img src="{{ asset('image/clothes-line.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
           <img src="{{ asset('image/naotechIcon.png')}}"  alt="" class="elevation" width="100%"  style="opacity: .8">

    </a>


    <div class="sidebar text-dark">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('image/login_icon.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-success font-weight-bold letter-spacing"> {{ Auth::user()->user_type }} </a>
        </div>
      </div>


      <nav class="mt-2 letter-spacing">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    @if( Auth::user()->user_type =='Administrator')
        <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-4">
            <li class="nav-item">
                <router-link to="/user" class="nav-link">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <p class=" text-bold">
                        User Information
                    </p>
                </router-link>
            </li>

              <li class="nav-item">
                <router-link to="/role" class="nav-link">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p class=" text-bold">
                        User Role
                    </p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/branch" class="nav-link">
                   <i class="fas fa-store-alt "></i>
                    <p class=" text-bold">
                       Branch
                    </p>
                </router-link>
              </li>

            </ul>
          </li>

        <li class="nav-item">
            <router-link to="/addservice" class="nav-link">
             <i class="fa fa-cart-plus nav-icon" aria-hidden="true"></i>
                <p class=" text-bold">
                    Add Service
                </p>
            </router-link>
        </li>

        {{-- <li class="nav-item">
            <router-link to="/developer" class="nav-link">
                <i class="fa fa-user-plus nav-icon" aria-hidden="true"></i>
                <p class=" text-bold">
                Developer
                </p>
            </router-link>
        </li> --}}

        <li class="nav-item">
            <router-link to="/laundry" class="nav-link">
            <i class="fas fa-tshirt  nav-icon"></i>
                <p class=" text-bold">
                    Laundry
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/transaction" class="nav-link">
            <i class="fas fa-tshirt  nav-icon"></i>
                <p class=" text-bold">
                    Transaction
                </p>
            </router-link>
        </li>
    @else
        <li class="nav-item">
            <router-link to="/transaction" class="nav-link">
                <i class="fa fa-user-plus nav-icon" aria-hidden="true"></i>
            <router-link to="/laundry" class="nav-link">
            <i class="fas fa-tshirt  nav-icon"></i>
                <p class=" text-bold">
                Transactions
                    Laundry
                </p>
            </router-link>
        </li>
    @endif


        {{--  <li class="nav-item ">
            <a href="/barcode" class="nav-link ">
                <i class="fa fa-barcode nav-icon  text-success" aria-hidden="true"></i>
                <p class=" text-bold">
                        Generate Barcode
                </p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="/water" class="nav-link">
                <i class="fa fa-tint nav-icon  text-primary " aria-hidden="true"></i>
                <p class=" text-bold">
                    Water Service
                </p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="/laundry" class="nav-link">
               <i class="fas fa-tshirt  nav-icon  "></i>
                <p class=" text-bold">
                    Laundry
                </p>
            </a>
        </li>

        <li class="nav-item ">
                <a href="/add-laundry" class="nav-link">
              <i class="fa fa-cart-plus nav-icon" aria-hidden="true"></i>
                    <p class=" text-bold">
                       Add Service
                    </p>
                </a>
        </li>  --}}


        </ul>
      </nav>

    </div>

  </aside>
