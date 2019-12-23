<aside class="main-sidebar elevation-4" style="background-color:#222D32;">
  <a href="/home" class="brand-link">
    <img src="{{ asset('image/bullesyeLogo.png')}}" alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text  text-danger"  style=" text-decoration: underline;  font-style: italic;"><h2 >BULLSEYE</h2></span>
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
        <li class="nav-item">
          <router-link to="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt text-white "></i>
              <p class=" text-bold">
                      <label for="" class="text-white">Dashboard</label> 
              </p>
          </router-link>
        </li>

        <li class="nav-item has-treeview menu-close ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-users" aria-hidden="true" style="color:white"></i>
              <p>
              <label for="" class="text-white"> User Management</label> 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-4">
            <li class="nav-item">
                <router-link to="/user" class="nav-link">
              
                    <i class="fa fa-user-plus nav-icon  text-white" aria-hidden="true" ></i>
                    <p class=" text-bold">
                            <label for="" class="text-white">  User Information</label> 
                    </p>
                </router-link>
            </li>
        
           
              <li class="nav-item">
                <router-link to="/role" class="nav-link">
                  <i class="fa fa-user-tag nav-icon  text-white" aria-hidden="true" ></i>
                    <p class=" text-bold">
                            <label for="" class="text-white">  User Role</label> 
                      
                    </p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/branch" class="nav-link">
                   <i class="fas fa-store-alt nav-icon  text-white " ></i>
                    <p class=" text-bold">
                            <label for="" class="text-white"> Branch</label> 
                    </p>
                </router-link>
              </li>
            

            </ul>
          </li>

       

        <li class="nav-item">
            <router-link to="/addservice" class="nav-link">
             <i class="fa fa-cart-plus nav-icon text-white" aria-hidden="true"></i>
                <p class=" text-bold">
                        <label for="" class="text-white"> Add Service</label> 
                  
                </p>
            </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/customers" class="nav-link">
         <i class="fas fa-user-friends  nav-icon text-white"></i>
              <p class=" text-bold">
                      <label for="" class="text-white"> Customers</label> 
                
              </p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/newlaundry" class="nav-link">
            <i class="fas fa-tshirt nav-icon text-white"   aria-hidden="true" style="color:#669DB2"></i>
              <p class=" text-bold text-white">
                     Laundry
              </p>
          </router-link>
        </li>
          
        <li class="nav-item">
          <router-link to="/transaction" class="nav-link">
              <i class="fa fa-sticky-note nav-icon text-white" aria-hidden="true" ></i>
          {{-- <i class="fas fa-tshirt  nav-icon" ></i> --}}
              <p class=" text-bold">
                      <label for="" class="text-white">  Transaction</label> 
                
              </p>
          </router-link>
        </li>
      @else
      <li class="nav-item">
        <router-link to="/newlaundry" class="nav-link">
          <i class="fas fa-tshirt nav-icon text-white"   aria-hidden="true" style="color:#669DB2"></i>
            <p class=" text-bold text-white">
                   Laundry
            </p>
        </router-link>
      </li>
      @endif


        </ul>
      </nav>

    </div>

  </aside>
