<nav id="sidebar" class="bg-dark navbar-dark">
    <a href="/" class="nav-link text-white"><h2 class="p-3">
        <i class="fa-solid fa-square-rss"></i> Projects</h2>
    </a>
    <ul class="nav flex-column">
        <!-- link dashboard -->
        <li class="nav-item">
          <a class="nav-link text-white {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i>Dasboard</a>
        </li>
        <!-- link projects -->
        <li class="nav-item">
          <a class="nav-link  text-white {{Route::currentRouteName() == 'admin.projects.index' ? 'active' : ''}}" href="{{route('admin.projects.index')}}"> <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>Projects</a>
        </li>
        <!-- link categories -->
        <li class="nav-item">
          <a class="nav-link  text-white {{Route::currentRouteName() == 'admin.categories.index' ? 'active' : ''}}" href="{{route('admin.categories.index')}}"> <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>Categories</a>
        </li>

      </ul>
    </nav>
