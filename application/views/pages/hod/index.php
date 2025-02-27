<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
        </div>
        <div class="row d-flex">
            <a class="col-md-6" href="<?=base_url('hodaccess/peminjaman');?>">
                <div class="card card-warning card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Peminjaman Menunggu Konfirmasi
                                <?php if($peminjaman_tunggu['jumlah'] > 0):?>
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1 class="text-center"><?= $peminjaman_tunggu['jumlah']; ?></h1>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-md-6">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Peminjaman Yang Diterima</div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1 class="text-center"><?= $peminjaman_diterima['jumlah'];?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-secondary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Peminjaman Yang Ditolak</div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1 class="text-center"><?= $peminjaman_ditolak['jumlah'];?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTable(type) {
    const barangMasukTable = document.getElementById('barangMasukTable');
    const barangKeluarTable = document.getElementById('barangKeluarTable');

    if (type === 'masuk') {
        barangMasukTable.style.display = 'block';
        barangKeluarTable.style.display = 'none';
    } else {
        barangMasukTable.style.display = 'none';
        barangKeluarTable.style.display = 'block';
    }
}
</script>