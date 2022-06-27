<li class="nav-item{{ is_current_path('admin-dashboard') ? ' active' : '' }}">
    <a href="{{ route('admin-dashboard') }}" class="nav-link">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item{{ is_current_path('admin-roles') ? ' active' : '' }}">
    <a href="{{ route('admin-roles') }}" class="nav-link">
        <i class="material-icons">verified_user</i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item{{ is_current_path('admin-users') ? ' active' : '' }}">
    <a href="{{ route('admin-users') }}" class="nav-link">
        <i class="material-icons">person_outline</i>
        <p>Users</p>
    </a>
</li>
