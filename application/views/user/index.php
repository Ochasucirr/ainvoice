<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

    <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs text-primary text-uppercase mb-1" style="font-weight: bold;">Agen eFishery</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_agen;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs text-success text-uppercase mb-1" style="font-weight: bold;">Data Agen Kosong</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_agenko;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-times fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs text-success text-uppercase mb-1" style="font-weight: bold;">Data Penjualan Tidak Valid</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_noagen;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-times fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tasks Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs text-info text-uppercase mb-1" style="font-weight: bold;">Invoice yang sudah dikerjakan</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $num_invoice;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
    
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

            