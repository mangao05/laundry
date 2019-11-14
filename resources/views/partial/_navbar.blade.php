<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
       {{--  <!-- Left navbar links -->  --}}
       <ul class="navbar-nav">
         <li class="nav-item">
           <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
           <a href="index3.html" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
           <a href="#" class="nav-link">Contact</a>
         </li>
       </ul>

    
       <ul class="navbar-nav ml-auto">
               <li class="nav-item dropdown">
                       <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           {{ Auth::user()->email }} <span class="caret"></span> 
                       </a>
                       
                       <div class="dropdown-menu dropdown-menu-right  " aria-labelledby="navbarDropdown">
                      
                           <a class="dropdown-item text-center p-0" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <img src="{{ asset('image/logout.png')}}"  alt="" class="elevation p-0" width="60%"  style="opacity: .8">
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                       </div>
                   </li>
       </ul>
</nav>




