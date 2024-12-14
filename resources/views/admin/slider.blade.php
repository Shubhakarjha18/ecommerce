<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">{{ auth()->user()->email }}</h1>
          <p>Web Designer</p>
        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
              <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
              <li><a href="{{ route('categories.index')  }}"> <i class="icon-grid"></i>Categories </a></li>
              <li><a href="{{route('admin.orders.index')}}"> <i class="fa fa-user"></i>Orders </a></li>
             
              <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="{{ route('products.create')  }}">Create Products</a></li>
                  <li><a href="{{ route('products.index')}}">View Products</a></li>
                  
                </ul>
              </li>
              
      
    </nav>