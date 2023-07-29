<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProducts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="bi bi-people"></i>  Manage Books
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownProducts">
            

            <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{route('category.index')}}">
              <i class="bi bi-arrow-right"></i> Manage Category
            </a>
            </li>

            <li class="{{ request()->routeIs('author.index') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{route('author.index')}}">
              <i class="bi bi-arrow-right"></i> Manage Author
            </a>
            </li>
          

            <li class="{{ request()->routeIs('books.index') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{route('books.index')}}">
              <i class="bi bi-arrow-right"></i> Manage Books
            </a>
            </li>
          


          </ul>
        </li>
     




      </ul>

      <ul class="navbar-nav ms-auto">

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProducts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="bi bi-person-bounding-box"></i> Hello  {{Auth::guard('admin')->user()->name}}

          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownProducts">
            <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
              <a class="dropdown-item" href="{{route('profile')}}">
              <i class="bi bi-arrow-right"></i> Profiles
            </a>
          </li>
             <li class="{{ request()->routeIs('update.details') ? 'active' : '' }}">
              <a class="dropdown-item" href="{{route('update.details')}}">
                <i class="bi bi-arrow-right"></i> Profiles Update
              </a>
            </li>

            <li class="{{ request()->routeIs('update.password') ? 'active' : '' }}">
              <a class="dropdown-item" href="{{route('update.password')}}">
              <i class="bi bi-arrow-right"></i> Password Change
            </a>
           </li>

            <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="bi bi-arrow-right"></i> Logout</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-right"></i> Delete Account</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
