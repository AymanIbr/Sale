 <!-- Sidebar -->
 <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
             <img src="{{ asset('admin_assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                 alt="User Image">
         </div>
         <div class="info">
             <a href="#" class="d-block">{{ Auth::user()->name }}</a>
         </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
                 <a href="{{ route('admin.adminPanelSetting.index') }}" class="nav-link">
                     <p>
                         الضبط العام
                     </p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('treasuries.index') }}" class="nav-link">
                     <p>
                         بيانات الخزن
                     </p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('sales_material_types.index') }}" class="nav-link">
                     <p>
                         بيانات فئات الفواتير
                     </p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('stores.index') }}" class="nav-link">
                     <p>
                         بيانات المخازن
                     </p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('uoms.index') }}" class="nav-link">
                     <p>
                         بيانات الوحدات
                     </p>
                 </a>
             </li>
         </ul>
     </nav>
     <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
