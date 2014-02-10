!-- Start: Sidebar -->
  <aside id="sidebar">
    <div id="sidebar-search">
      <form role="search">
        <input type="text" class="search-bar form-control" placeholder="{{ trans('menu.search')}}">
        <i class="fa fa-search field-icon-right"></i>
        <button type="submit" class="btn btn-default hidden"></button>
      </form>
      <div class="sidebar-toggle"> <i class="fa fa-bars"></i> </div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li> <a href="{{ URL::to('/') }}"><span class="glyphicons glyphicons-star"></span><span class="sidebar-title">{{ trans('menu.dashboard') }}</span></a> </li>
       @if(Perm::Instance()->CanRead('ticket'))
        <li> <a href="{{ URL::to('/tickets') }}"><span class="glyphicons glyphicons-sort"></span><span class="sidebar-title">{{ trans('menu.tickets') }}</span></a> </li>
       @endif
        @if(Perm::Instance()->CanRead('admin'))
        <li> <a class="accordion-toggle" href="#resources"><span class="glyphicons glyphicons-settings"></span><span class="sidebar-title">{{ trans('menu.admtools') }}</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
            <li><a href="customizer.html"><span class="glyphicons glyphicons-edit"></span> Theme Customizer</a></li>
            <li><a href="skin-demo.html"><span class="glyphicons glyphicons-magic"></span> Demo Style Switcher </a></li>
            <li><a href="documentation/index.html"><span class="glyphicons glyphicons-book"></span> Documentation </a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </aside>
  <!-- End: Sidebar --> 