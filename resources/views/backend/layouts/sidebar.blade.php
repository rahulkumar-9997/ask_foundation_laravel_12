<!-- Sidebar -->
<div class="sidebar" id="sidebar">
   <!-- Logo -->
   <div class="sidebar-logo active">
      <a href="{{ route('dashboard') }}" class="logo logo-normal">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
      <a href="{{ route('dashboard') }}" class="logo logo-white">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
      <a href="{{ route('dashboard')}}" class="logo-small">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
   </div>
   <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li class="submenu-open">
               <ul>
                  <li class="active">
                     <a href="{{ route('dashboard') }}">
                        <i class="ti ti-layout-grid fs-16 me-2"></i>
                        <span>Dashboard</span>
                     </a>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-file fs-16 me-2"></i>
                        <span>Manage Banner</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('manage-banner.index') }}">Banner</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-award-filled fs-16 me-2"></i>
                        <span>Manage Milestones & Awards</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('manage-year.index') }}">Year</a></li>
                        <li><a href="{{ route('manage-award-category.index') }}">Category</a></li>
                        <li><a href="{{ route('manage-awards.index') }}">Add Milestones & Awards</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-news fs-16 me-2"></i>
                        <span>Manage News & Media</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li>
                        <a href="{{ route('manage-news-media-category.index') }}">
                           Add News and Media Category
                        </a>
                        </li>
                        <li>
                           <a href="{{ route('manage-news-media.index') }}">
                              Add News and Media
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-brand-apple-arcade fs-16 me-2"></i>
                        <span>Manage Pages</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('pages.index') }}">All Pages</a></li>
                        <li><a href="{{ route('pages.create') }}">Create Page</a></li>
                     </ul>
                  </li>

                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-layout-grid-add fs-16 me-2"></i>
                        <span>Manage Menus</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('menus.index') }}">All Menus</a></li>
                        <li><a href="{{ route('menus.create') }}">Create Menu</a></li>
                     </ul>
                  </li>

               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
<!-- /Sidebar -->