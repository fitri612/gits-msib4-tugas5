 <!-- Left Panel -->
 <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenus">
                <li>
                    <a href="{{ route('cart.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <h3 class="menu-title pl-3">Category</h3><!-- /.menu-title -->
                <li>
                   <a href="{{ route('category.index') }}"> <i class="menu-icon fa fa-list"></i>Lihat Category</a>
               </li>
                <h3 class="menu-title pl-3">Products</h3><!-- /.menu-title -->
                <li>
                   <a href="{{ route('product.index') }}"> <i class="menu-icon fa fa-list"></i>Lihat Products</a>
               </li>

                <h3 class="menu-title pl-3">Transaksi</h3><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('cart.index') }}"> <i class="menu-icon fa fa-list"></i>Transaksi</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
<script>
var menuItems = document.querySelectorAll('#navMenus li');

for (var i = 0; i < menuItems.length; i++) {
  if (menuItems[i].querySelector('a').href === window.location.href) {
    menuItems[i].classList.add('active');
  }
}
</script>
