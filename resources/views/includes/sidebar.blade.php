 <!-- Left Panel -->
 <aside id="left-panel" class="left-panel">
     <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
             <ul class="nav navbar-nav">
                 <li class="active">
                     <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                 </li>
                 <li class="menu-title">Category</li><!-- /.menu-title -->
                 <li>
                    <a href="{{ route('category.index') }}"> <i class="menu-icon fa fa-list"></i>Lihat Category</a>
                </li>
                 {{-- <li class="">
                     <a href="{{ route('category.create') }}"> <i class="menu-icon fa fa-plus"></i>Tambah Category</a>
                 </li> --}}

                 <li class="menu-title">Products</li><!-- /.menu-title -->
                 <li>
                    <a href="{{ route('product.index') }}"> <i class="menu-icon fa fa-list"></i>Lihat Products</a>
                </li>

                 <li class="menu-title">Transaksi</li><!-- /.menu-title -->
                 <li class="">
                     <a href="#"> <i class="menu-icon fa fa-list"></i>Lihat Transaksi</a>
                 </li>
             </ul>
         </div><!-- /.navbar-collapse -->
     </nav>
 </aside>
 <!-- /#left-panel -->