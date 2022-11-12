<?php $r = \Route::current()->getAction() ?>
<?php $route = (isset($r['as'])) ? $r['as'] : ''; ?>

<ul class="sidebar-menu">
    <li class="header">MENU</li>

    <li class="<?php echo ( starts_with($route, ADMIN.'.dash') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.dash') }}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="<?php echo ( starts_with($route, ADMIN.'.categories') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.categories.index') }}">
            <i class="fa fa-list"></i>
            <span>Voucher update</span>
        </a>
    </li>

    <li class="<?php echo ( starts_with($route, ADMIN.'.hangup') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.hangup.index') }}">
            <i class="fa fa-list"></i>
            <span>Hang up allocation</span>
        </a>
    </li>

    <li class="<?php echo ( starts_with($route, ADMIN.'.pcuser') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.pcuser.index') }}">
            <i class="fa fa-edit"></i>
            <span>Update pc user</span>
        </a>
    </li>

    <li class="<?php echo ( starts_with($route, ADMIN.'.trialbalance') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.trialbalance.index') }}">
            <i class="fa fa-balance-scale"></i>
            <span>Trial balance</span>
        </a>
    </li>


    @if (auth()->user()->hasRole('Superadmin|Admin'))
    <li class="<?php echo ( starts_with($route, ADMIN.'.users') ) ? "active" : '' ?>">
        <a href="{{ route(ADMIN.'.users.index') }}">
            <i class="fa fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    @endif

    @if (auth()->user()->hasRole('Superadmin'))
    <li class="treeview">
        <a href="#"><i class='fa fa-link'></i> <span>Tools</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Settings</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Backups</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Logs</a></li>
        </ul>
    </li>
    @endif
</ul>
