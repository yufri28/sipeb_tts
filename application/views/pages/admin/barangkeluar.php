<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Barang Keluar</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Datatables</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a class="btn btn-primary btn-round ms-auto"
                                    href="<?=base_url('barangkeluar/peminjaman');?>">
                                    <i class="fa fa-plus"></i>
                                    Peminjaman
                                </a>
                                <button class="btn btn-primary btn-round" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    <i class="fa fa-plus"></i>
                                    Bantuan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Barang</th>
                                        <th>Kategori</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Barang</th>
                                        <th>Kategori</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($data_barang_keluar as $key => $barang_keluar) :?>
                                    <tr>
                                        <td><?=$i++;?>.</td>
                                        <td><?= date('d-m-Y', strtotime($barang_keluar['tanggal'])); ?></td>
                                        <td><?=$barang_keluar['total_barang'];?></td>
                                        <td><?=ucfirst($barang_keluar['kategori']);?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <?php if($barang_keluar['kategori'] == 'bantuan'):?>
                                                <?php if($barang_keluar['id_serah_terima'] != null):?>
                                                <a href="<?=base_url('barangkeluar/detail_serah_terima/'.$barang_keluar['batch_id']);?>"
                                                    title="Detail BA Serah Terima" class="btn btn-sm btn-info me-1"
                                                    data-original-title="Detail BA Serah Terima">
                                                    <i class="fa fa-eye">
                                                        Detail
                                                    </i>
                                                </a>
                                                <?php else:?>
                                                <button type="button" data-batch_id="<?= $barang_keluar['batch_id']; ?>"
                                                    data-bs-target="#generateSerahTerima" data-bs-toggle="modal"
                                                    title="Generate Serah Terima" class="btn btn-sm btn-secondary me-1"
                                                    data-original-title="Generate Serah Terima">
                                                    <i class="fa fa-print">
                                                        Generate BA Serah Terima
                                                    </i>
                                                </button>
                                                <?php endif;?>
                                                <?php else:?>
                                                <a href="<?=base_url('barangkeluar/detail_peminjaman/'.$barang_keluar['batch_id']);?>"
                                                    title="Detail BA Serah Terima" class="btn btn-sm btn-info me-1"
                                                    data-original-title="Detail BA Serah Terima">
                                                    <i class="fa fa-eye">
                                                        Detail
                                                    </i>
                                                </a>
                                                <?php endif;?>
                                                <button type="button" data-batch_id="<?= $barang_keluar['batch_id']; ?>"
                                                    data-bs-target="#deleteModal" data-bs-toggle="modal"
                                                    title="Hapus Barang Keluar" class="btn btn-sm btn-danger"
                                                    data-original-title="Hapus Barang Keluar">
                                                    <i class="fa fa-times"> Hapus</i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>