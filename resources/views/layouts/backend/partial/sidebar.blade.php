<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CMS Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <a data-toggle="collapse" href="#collapseExample" aria-expanded="false">
      <div class="user p-3">
        <div class="avatar-sm float-left mr-2">
          <img style="width: 42px; height:42px" src="{{asset('backend/image/My photo.png')}}" alt="..." class="avatar-img rounded">
        </div>
        <div class="info" data-toggle="collapse" href="#collapseExample" aria-expanded="false">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="false">
            <span>Johny <br>
              <span class="small">Owner</span>
              <span class="caret"></span>
            </span>
          </a>
            <div class="clearfix"></div>
            <div class="in collapse" id="collapseExample" style="">
                <ul class="nav">
                    <li class="nav-item user-navItem">
                      <a class="nav-link nav-link-item pl-0" href="">Edit Profile</a>
                    </li>
                    <li class="nav-item user-navItem">
                      <a class="nav-link pl-0" href="">Change Password</a>
                    </li>
                    <form method="POST" id="logoutForm" action="{{ route('logout') }}" style="display: none;">
                      @csrf
                    </form>
                    <li class="nav-item user-navItem">
                      <a class="nav-link pl-0" href="javascript:void(0);" onclick="$('#logoutForm').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
      </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline ">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar search-input" type="search" placeholder="Search" aria-label="Search" style="padding-top: 20px;padding-bottom: 20px;">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item menu-open" >
                <a href="{{Route('app.dashboard')}}" class="nav-link {{Request::is('app/dashboard') ? 'active': ''}}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item mt-1 {{Request::is('app/post*') ? 'menu-is-opening menu-open': ''}}">
            <a href="#" class="nav-link {{Request::is('app/post*') ? 'active': ''}}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Post
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" style="{{Request::is('app/post/post*')?'background-color:rgba(4, 24, 87, 0.481);border-radius:5px':''}}">
                <a href="{{Route('app.post.post.index')}}" class="nav-link">
                  <i class="fa-solid fa-list"></i>
                  <p>Post List</p>
                </a>
              </li>
              <li class="nav-item" style="{{Request::is('app/post/category*')?'background-color:rgba(4, 24, 87, 0.481);border-radius:5px':''}}">
                <a href="{{Route('app.post.category.index')}}" class="nav-link">
                  <i class="fa-solid fa-list"></i>
                  <p>Category List</p>
                </a>
              </li>
              <li class="nav-item" style="{{Request::is('app/post/tag*')?'background-color:rgba(4, 24, 87, 0.481);border-radius:5px':''}}">
                <a href="{{Route('app.post.tag.index')}}" class="nav-link">
                  <i class="fa-solid fa-list"></i>
                  <p>Tag List</p>
                </a>
              </li>
            </ul>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>