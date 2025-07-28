<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Stok Barang Terkini</p>
                                    <h4 class="card-title"><?= $jumlah_stok_terkini['total_stok_terkini'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-fire"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Bencana</p>
                                    <h4 class="card-title"><?= $jumlah_bencana ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Barang Masuk</p>
                                    <h4 class="card-title"><?= $jumlah_masuk_perbulan['barang_masuk_bulan_ini']??0 ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Barang Keluar</p>
                                    <h4 class="card-title"><?= $jumlah_keluar_perbulan['barang_keluar_bulan_ini']??0 ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Barang Masuk Bulan Ini</div>
                            </div>
                            <div class="card-category"><?= date('F Y') ?></div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1 class="text-center"><?= $barang_masuk_bulan_ini??0 ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Barang Keluar Bulan Ini</div>
                            </div>
                            <div class="card-category"><?= date('F Y') ?></div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1 class="text-center"><?= $barang_keluar_bulan_ini??0 ?></h1>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card card-warning card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Bencana Bulan Ini</div>
                            </div>
                            <div class="card-category"><?= date('F Y') ?></div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1 class="text-center"><?= $bencana_bulan_ini; ?></h1>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Peminjaman</div>
                            </div>
                        </div>

                        <!-- Table for Diterima -->
                        <div class="card-body mt-2 mb-4">
                            <div class="table-responsive">
                                <table id="barangMasuk" class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nama Peminjam</th>
                                            <th scope="col" class="text-center">No HP</th>
                                            <th scope="col" class="text-end">Tanggal Pengajuan</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($peminjaman_diterima)): ?>
                                        <?php foreach($peminjaman_diterima as $row): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php if($row['nama_pihak_pertama'] == null):?>
                                                <div class="spinner-grow text-dark" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <?php endif;?>
                                                <?= $row['nama_penanggungjawab']; ?>
                                            </th>
                                            <td class="text-center"><?= $row['no_hp']; ?></td>
                                            <td class="text-end"><?= $row['tanggal_pengajuan']; ?></td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Selengkapnya
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?=base_url('barangkeluar/detail_peminjaman/'.$row['batch_id']);?>">
                                                                Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item"
                                                                data-batch_id="<?= $row['batch_id']; ?>"
                                                                data-bs-target="#konfirmasiSelesai"
                                                                data-bs-toggle="modal" title="Tandai selesai">
                                                                Tandai Selesai
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data barang masuk</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Statistik Barang Masuk/Keluar</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" onclick="showTable('masuk')">Barang
                                                Masuk</a>
                                            <a class="dropdown-item" href="#" onclick="showTable('keluar')">Barang
                                                Keluar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table for Barang Masuk -->
                        <div class="card-body mt-2 mb-4" id="barangMasukTable">
                            <div class="table-responsive">
                                <h4>Barang Masuk</h4>
                                <table id="barangMasuk" class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col" class="text-center">Bulan</th>
                                            <th scope="col" class="text-end">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($statistik_barang_masuk)): ?>
                                        <?php foreach($statistik_barang_masuk as $row): ?>
                                        <tr>
                                            <th scope="row"><?= $row['nama_jenisbarang']; ?></th>
                                            <td class="text-center"><?= $row['bulan']; ?></td>
                                            <td class="text-end"><?= $row['jumlah']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data barang masuk</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Table for Barang Keluar (initially hidden) -->
                        <div class="card-body mt-3 mb-4" id="barangKeluarTable" style="display: none;">
                            <div class="table-responsive">
                                <h4>Barang Keluar</h4>
                                <table id="barangKeluar" class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col" class="text-center">Bulan</th>
                                            <th scope="col" class="text-end">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($statistik_barang_keluar)): ?>
                                        <?php foreach($statistik_barang_keluar as $row): ?>
                                        <tr>
                                            <th scope="row"><?= $row['nama_jenisbarang']; ?></th>
                                            <td class="text-center"><?= $row['bulan']; ?></td>
                                            <td class="text-end"><?= $row['total_barang']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data barang keluar</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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