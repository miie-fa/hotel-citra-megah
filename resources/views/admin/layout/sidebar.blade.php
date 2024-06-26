<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="fas fa-bed menu-icon"></i>
                <span class="menu-title">Room Section</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/room') ? 'show' : '' }}" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/amenity') ? 'active' : '' }}"><a class="nav-link" href="{{ route('amenity.index') }}">Amenities</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('room.index') }}">Bed Type</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('room.index') }}">Rooms</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/post') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('post.index') }}">
                <i class="fas fa-paste menu-icon"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#room" aria-expanded="false" aria-controls="room">
                <i class="fas fa-bed menu-icon"></i>
                <span class="menu-title">Room Section</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/room') ? 'show' : '' }}" id="room">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/amenity') ? 'active' : '' }}"><a class="nav-link" href="{{ route('amenity.index') }}">Amenities</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('room.index') }}">Bed Type</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('room.index') }}">Rooms</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="">
                <i class="fas fa-code menu-icon"></i>
                <span class="menu-title">Pages</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/order') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="fas fa-cart-plus menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-image menu-icon"></i>
                <span class="menu-title">Photo Gallery</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/user') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-users-gear menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <i class="fas fa-gear menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/settings') ? 'show' : '' }}" id="settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/settings') ? 'active' : '' }}"><a class="nav-link" href="">Web Settings</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::is('admin/settings') ? 'active' : '' }}"><a class="nav-link" href="{{ route('settings.guest_index') }}">Guest Room</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
