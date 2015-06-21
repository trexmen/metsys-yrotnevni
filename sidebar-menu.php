<?php
if ($_SESSION['leveluser']=='admin'){
    echo"
    <li>
        <a href='?module=home'>
            <i class='fa fa-dashboard'></i> <span>Dashboard</span>
        </a>
    </li>
    <li class='treeview'>
        <a href='#'>
            <i class='fa fa-table'></i>
            <span>Data Master</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class='treeview-menu'>
            <li><a href='?module=data-barang'><i class='fa fa-angle-double-right'></i> Data Barang</a></li>
            <li><a href='?module=data-kategori'><i class='fa fa-angle-double-right'></i> Data Kategori</a></li>
            <li><a href='?module=data-satuan'><i class='fa fa-angle-double-right'></i> Data Satuan</a></li>
            <li><a href='?module=data-supplier'><i class='fa fa-angle-double-right'></i> Data Supplier</a></li>
            <li><a href='?module=data-kendaraan'><i class='fa fa-angle-double-right'></i> Data Kendaraan</a></li>
            <li><a href='?module=data-driver'><i class='fa fa-angle-double-right'></i> Data Driver</a></li>
            <li><a href='?module=data-jabatan'><i class='fa fa-angle-double-right'></i> Data Jabatan</a></li>
            <li><a href='?module=data-pelanggan'><i class='fa fa-angle-double-right'></i> Data Pelanggan</a></li>

        </ul>
    </li>
    <li class='treeview'>
        <a href='#'>
            <i class='fa fa-shopping-cart'></i>
            <span>Data Transaksi</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class='treeview-menu'>
            <li><a href='?module=transaksi-penjualan'><i class='fa fa-angle-double-right'></i>Transaksi Penjualan</a></li>
            <li><a href='?module=request-pembelian'><i class='fa fa-angle-double-right'></i>Request Pembelian</a></li>
            <li><a href='?module=data-penjualan'><i class='fa fa-angle-double-right'></i> Data Penjualan</a></li>
            <li><a href='?module=data-purchasing'><i class='fa fa-angle-double-right'></i> Data Purchasing</a></li>
        </ul>
    </li>
    <li>
        <a href='?module=data-pengiriman'>
            <i class='fa fa-truck'></i> <span>Data Pengiriman</span>
        </a>
    </li>       
    <li class='treeview'>
        <a href='?module=manajemen-user'>
            <i class='fa fa-users'></i>
            <span>Manajemen User</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class='treeview-menu'>
            <li><a href='?module=manajemen-user'><i class='fa fa-angle-double-right'></i> Data User</a></li>
        </ul>
    </li>
    <li class='treeview'>
        <a href='#'>
            <i class='fa fa-book'></i>
            <span>Laporan</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class='treeview-menu'>
            <li><a href='?module=data-penjualan'><i class='fa fa-angle-double-right'></i> Laporan Penjualan</a></li>
            <li><a href='?module=data-purchasing'><i class='fa fa-angle-double-right'></i> Laporan Purchasing</a></li>
        </ul>
    </li>
    ";
}
elseif($_SESSION['leveluser']=='user'){
    echo"


    ";
}
?>

<!-- <li class='active'>
    <a href='index.html'>
        <i class='fa fa-dashboard'></i> <span>Dashboard</span>
    </a>
</li>
<li>
    <a href='pages/widgets.html'>
        <i class='fa fa-th'></i> <span>Widgets</span> <small class='badge pull-right bg-green'>new</small>
    </a>
</li>
<li class='treeview'>
    <a href='#'>
        <i class='fa fa-bar-chart-o'></i>
        <span>Charts</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <li><a href='pages/charts/morris.html'><i class='fa fa-angle-double-right'></i> Morris</a></li>
        <li><a href='pages/charts/flot.html'><i class='fa fa-angle-double-right'></i> Flot</a></li>
        <li><a href='pages/charts/inline.html'><i class='fa fa-angle-double-right'></i> Inline charts</a></li>
    </ul>
</li>
<li class='treeview'>
    <a href='#'>
        <i class='fa fa-laptop'></i>
        <span>UI Elements</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <li><a href='pages/UI/general.html'><i class='fa fa-angle-double-right'></i> General</a></li>
        <li><a href='pages/UI/icons.html'><i class='fa fa-angle-double-right'></i> Icons</a></li>
        <li><a href='pages/UI/buttons.html'><i class='fa fa-angle-double-right'></i> Buttons</a></li>
        <li><a href='pages/UI/sliders.html'><i class='fa fa-angle-double-right'></i> Sliders</a></li>
        <li><a href='pages/UI/timeline.html'><i class='fa fa-angle-double-right'></i> Timeline</a></li>
    </ul>
</li>
<li class='treeview'>
    <a href='#'>
        <i class='fa fa-edit'></i> <span>Forms</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <li><a href='pages/forms/general.html'><i class='fa fa-angle-double-right'></i> General Elements</a></li>
        <li><a href='pages/forms/advanced.html'><i class='fa fa-angle-double-right'></i> Advanced Elements</a></li>
        <li><a href='pages/forms/editors.html'><i class='fa fa-angle-double-right'></i> Editors</a></li>
    </ul>
</li>
<li class='treeview'>
    <a href='#'>
        <i class='fa fa-table'></i> <span>Tables</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <li><a href='pages/tables/simple.html'><i class='fa fa-angle-double-right'></i> Simple tables</a></li>
        <li><a href='pages/tables/data.html'><i class='fa fa-angle-double-right'></i> Data tables</a></li>
    </ul>
</li>
<li>
    <a href='pages/calendar.html'>
        <i class='fa fa-calendar'></i> <span>Calendar</span>
        <small class='badge pull-right bg-red'>3</small>
    </a>
</li>
<li>
    <a href='pages/mailbox.html'>
        <i class='fa fa-envelope'></i> <span>Mailbox</span>
        <small class='badge pull-right bg-yellow'>12</small>
    </a>
</li>
<li class='treeview'>
    <a href='#'>
        <i class='fa fa-folder'></i> <span>Examples</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <li><a href='pages/examples/invoice.html'><i class='fa fa-angle-double-right'></i> Invoice</a></li>
        <li><a href='pages/examples/login.html'><i class='fa fa-angle-double-right'></i> Login</a></li>
        <li><a href='pages/examples/register.html'><i class='fa fa-angle-double-right'></i> Register</a></li>
        <li><a href='pages/examples/lockscreen.html'><i class='fa fa-angle-double-right'></i> Lockscreen</a></li>
        <li><a href='pages/examples/404.html'><i class='fa fa-angle-double-right'></i> 404 Error</a></li>
        <li><a href='pages/examples/500.html'><i class='fa fa-angle-double-right'></i> 500 Error</a></li>
        <li><a href='pages/examples/blank.html'><i class='fa fa-angle-double-right'></i> Blank Page</a></li>
    </ul>
</li> -->