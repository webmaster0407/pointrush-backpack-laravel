<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<li class="nav-title">Admin workspace</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Tracks</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('track') }}"><i class="nav-icon la la-list"></i>  <span>Tracks</span></a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('points') }}'><i class='nav-icon la la-hand-o-right'></i> Points</a></li>
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-optin-monster"></i><span>All Claims</span></a></li>
<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-question"></i><span>Help</span></a></li>

<li class="nav-title">User & Hints</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Admin</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-user"></i>  <span>User</span></a></li>
      <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-poo"></i>  <span>Hints</span></a></li>
    </ul>
</li>

<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('article') }}'><i class='nav-icon la la-question'></i> Articles</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-question'></i> Tags</a></li> -->