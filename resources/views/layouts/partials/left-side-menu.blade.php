 <div class="sidebar">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color=" default | primary | info | success | warning | danger |"
    -->
    <div class="logo">
    <a href="/" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="/img/tino-full-logo.png" height="50">
      </div>
      <!-- <p>CT</p> -->
    </a>
    <a href="/" class="simple-text logo-normal">
      <div class="logo-image-big">
        <img src="/img/tino-full-logo.png" height="50">
      </div>
    </a>
    </div>
    <div class="sidebar-wrapper">
    <div class="user">
      <!-- <div class="photo">
        <img src="/img/faces/ayo-ogunseinde-2.jpg" />
      </div> -->

      <div class="info">
        {{-- <a  style="color:#FFFFFF !important" class="nav-link" >
          <span class="sidebar-mini"> MP </span>
          <span class="sidebar-normal"> My Profile </span>
        </a> --}}
        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
          <span class="ml-5">
            {{ Auth::user()?->full_name }}
            <b class="caret"></b>
          </span>
        </a>
        <div class="clearfix"></div>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li>
              <a href="/users/{{Auth::user()->slug}}/edit">
                <span class="sidebar-mini-icon">EP</span>
                <span class="sidebar-normal">Edit My Profile</span>
              </a>
            </li>
            <li @if(request()->is('change-password')) class="active" @endif>
              <a href="/change-password">
                <span class="sidebar-mini-icon">CP</span>
                <span class="sidebar-normal">Change Password</span>
              </a>
            </li>
            <li>
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                <span class="sidebar-mini-icon">LO</span>
                <span class="sidebar-normal">{{ __('Logout') }}</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
      <ul class="nav">
        <li @if(request()->is('dashboard/admin')) class="active" @endif>
          <a href="/home">
            <i class="nc-icon nc-chart-bar-32"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @if(Auth::user()->hasAnyRole(['Super Admin']))
          <li @if(str_contains(request()->route()->uri,'projects/')) class="active" @endif>
            <a data-toggle="collapse" href="#loans">
              <i class="nc-icon nc-bank"></i>
              <p>
                Projects <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="loans">
              <ul class="nav">
                <li @if(request()->is('projects/all')) class="active" @endif>
                  <a href="/projects/all">
                    <span class="sidebar-mini-icon">VAP</span>
                    <span class="sidebar-normal">View all Projects</span>
                  </a>
                </li>
                <li @if(request()->is('projects/create')) class="active" @endif>
                  <a href="/projects/create">
                    <span class="sidebar-mini-icon">CP</span>
                    <span class="sidebar-normal">Create Project</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li @if(str_contains(request()->route()->uri,'client/clients')||str_contains(request()->route()->uri,'client/client-notes') ) class="active" @endif>
            <a data-toggle="collapse" href="#clients">
              <i class="nc-icon nc-single-02"></i>
              <p>
                Clients <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="clients">
              <ul class="nav">
                <li @if(request()->is('client/clients')) class="active" @endif>
                  <a href="/client/clients">
                    <span class="sidebar-mini-icon">MC</span>
                    <span class="sidebar-normal">Manage Clients</span>
                  </a>
                </li>
                @can('create users')
                <li>
                  <a href="/client/clients/create">
                    <span class="sidebar-mini-icon">AC</span>
                    <span class="sidebar-normal">Add Client</span>
                  </a>
                </li>
                @endcan
              </ul>
            </div>
          </li>

          <li @if(str_contains(request()->route()->uri,'projects/processes')) class="active" @endif>
            <a data-toggle="collapse" href="#processes">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>
                Processes<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="processes">
              <ul class="nav">
                <li @if(request()->is('processes')) class="active" @endif>
                  <a href="/projects/processes">
                    <span class="sidebar-mini-icon">VAP</span>
                    <span class="sidebar-normal">View all Processes</span>
                  </a>
                </li>
                <li @if(request()->is('projects/create')) class="active" @endif>
                  <a href="/projects/processes/create">
                    <span class="sidebar-mini-icon">CP</span>
                    <span class="sidebar-normal">Create a Process</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li @if(str_contains(request()->route()->uri,'users')) class="active" @endif>
            <a data-toggle="collapse" href="#pagesExamples">
              <i class="nc-icon nc-badge"></i>
              <p>
                Tna team <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="pagesExamples">
              <ul class="nav">
                <li @if(request()->is('users')) class="active" @endif>
                  <a href="/users">
                    <span class="sidebar-mini-icon">MU</span>
                    <span class="sidebar-normal">Manage Users</span>
                  </a>
                </li>
                @can('create users')
                <li @if(request()->is('users/create')) class="active" @endif>
                  <a href="/users/create">
                    <span class="sidebar-mini-icon">AU</span>
                    <span class="sidebar-normal">Add User</span>
                  </a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
        @endif

        @if(Auth::user()->hasAnyRole(['Client']))
          <li @if(str_contains(request()->route()->uri,'projects/')) class="active" @endif>
            <a data-toggle="collapse" href="#loans">
              <i class="nc-icon nc-bank"></i>
              <p>
                Projects <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="loans">
              <ul class="nav">
                <li @if(request()->is('projects/client-projects')) class="active" @endif>
                  <a href="/projects/client-projects">
                    <span class="sidebar-mini-icon">VAP</span>
                    <span class="sidebar-normal">View all Projects</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif
      </ul>
    </div>
</div>