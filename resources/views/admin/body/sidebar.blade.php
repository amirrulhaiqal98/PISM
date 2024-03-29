<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        PISM<span>DEV</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">PISM</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">JENIS KELAB</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
                @if(Auth::user()->can('club.retrieve'))
                <li class="nav-item">
                  <a href="{{route('all.type')}}" class="nav-link">ALL KELAB</a>
                </li>
              @endif
              @if(Auth::user()->can('club.create'))
              <li class="nav-item">
                <a href="{{route('add.type')}}" class="nav-link">ADD KELAB</a>
              </li>
              @endif
              @if(Auth::user()->can('club.update'))
              <li class="nav-item">
                <a href="{{route('add.type')}}" class="nav-link">EDIT KELAB</a>
              </li>
              @endif
              @if(Auth::user()->can('club.delete'))
              <li class="nav-item">
                <a href="{{route('add.type')}}" class="nav-link">DELETE KELAB</a>
              </li>
              @endif
            </ul>
          </div>
        </li>

        <li class="nav-item nav-category">Role & Permission</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Role & Permission</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">

              <li class="nav-item">
                <a href="{{route('all.permission')}}" class="nav-link">All Permission</a>
              </li>

              <li class="nav-item">
                <a href="{{route('all.roles')}}" class="nav-link">All Roles</a>
              </li>

              <li class="nav-item">
                <a href="{{route('add.roles.permission')}}" class="nav-link">Role in Permission</a>
              </li>

              <li class="nav-item">
                <a href="{{route('all.roles.permission')}}" class="nav-link">All Role in Permission</a>
              </li>

            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false" aria-controls="admin">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Manage Admin User</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="admin">
            <ul class="nav sub-menu">

              <li class="nav-item">
                <a href="{{route('all.admin')}}" class="nav-link">All Admin</a>
              </li>

              <li class="nav-item">
                <a href="{{route('add.admin')}}" class="nav-link">Add Admin</a>
              </li>

            </ul>
          </div>
        </li>

        <li class="nav-item nav-category">APPLICATIONS</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#applications" role="button" aria-expanded="false" aria-controls="applications">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Application</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="applications">
            <ul class="nav sub-menu">

              <li class="nav-item">
                <a href="{{route('all.application')}}" class="nav-link">All Application</a>
              </li>

              <li class="nav-item">
                <a href="{{route('add.application')}}" class="nav-link">Add Application</a>
              </li>

            </ul>
          </div>
        </li>
     
        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="#" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  {{-- <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item" href="../demo1/dashboard.html">
          <img src="../assets/images/screenshots/light.jpg" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item active" href="../demo2/dashboard.html">
          <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
        </a>
      </div>
    </div>
  </nav> --}}