<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Peminjaman Barang</h3>
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
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="no-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Peminjam</th>
                                        <th>Jumlah Barang</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Keperluan</th>
                                        <th>Status</th>
                                        <th>Pesan/Alasan</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($data_peminjaman as $key => $peminjaman) :?>
                                    <tr>
                                        <td><?=$i++;?>.</td>
                                        <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_pengajuan'])); ?></td>
                                        <td><?=$peminjaman['name'];?></td>
                                        <td><?=$peminjaman['jumlah_barang'];?></td>
                                        <td><?=date('d-m-Y', strtotime($peminjaman['tanggal_pinjam']));?>
                                        <td><?=date('d-m-Y', strtotime($peminjaman['tanggal_kembali']));?>
                                        <td><?=$peminjaman['nama_penanggungjawab'];?>
                                        <td><?=$peminjaman['no_hp'];?>
                                        <td><?=$peminjaman['alamat'];?>
                                        <td><?=$peminjaman['keperluan'];?>
                                        <td>
                                            <div
                                                class="text-center text-white rounded bg-<?=$peminjaman['status_diterima'] == 'tunggu'?'warning':($peminjaman['status_diterima'] == 'terima'?'success':'danger');?>">
                                                <?=$peminjaman['status_diterima'];?>
                                            </div>
                                        </td>
                                        <td class="text-wrap"><?=$peminjaman['pesan']??'-';?>
                                        <td>
                                            <div class="form-button-action">
                                                <button <?=$peminjaman['status_diterima'] != 'tunggu'?'hidden':''?>
                                                    type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-nama="<?=$peminjaman['name'];?>"
                                                    data-tanggal="<?=date('d-m-Y',strtotime($peminjaman['tanggal_pengajuan']));?>"
                                                    data-bs-target="#accModal" data-bs-toggle="modal"
                                                    title="Terima Peminjaman" class="btn btn-sm btn-primary me-1"
                                                    data-original-title="Terima Peminjaman">
                                                    <i class="fa fa-check"> Terima</i>
                                                </button>
                                                <button type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-target="#detailModal<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-toggle="modal" title="Detail Peminjaman"
                                                    class="btn btn-sm btn-info me-1"
                                                    data-original-title="Detail Peminjaman">
                                                    <i class="fa fa-eye"> Detail</i>
                                                </button>
                                                <button <?=$peminjaman['status_diterima'] != 'tunggu'?'hidden':''?>
                                                    type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-nama="<?=$peminjaman['name'];?>"
                                                    data-tanggal="<?=date('d-m-Y',strtotime($peminjaman['tanggal_pengajuan']));?>"
                                                    data-bs-target="#rejectModal" data-bs-toggle="modal"
                                                    title="Tolak Peminjaman" class="btn btn-sm btn-danger"
                                                    data-original-title="Tolak Peminjaman">
                                                    <i class="fa fa-times"> Tolak</i>
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