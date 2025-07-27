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
                    <div class="container">
                        <div class="d-block">
                            <label>Keterangan: </label>
                            <div class="me-2">
                                verifikasi: <small><i>Menunggu verifikasi data oleh admin</i></small>
                            </div>
                            <div class="me-2">
                                tunggu : <small><i>Menunggu persetujuan</i></small>
                            </div>
                            <div class="me-2">
                                terima : <small><i>Pengajuan peminjaman diterima</i></small>
                            </div>
                            <div class="me-2">
                                tolak : <small><i>Pengajuan peminjaman ditolak</i></small>
                            </div>
                        </div>
                    </div>
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
                                    <?php if($peminjaman['status_diterima'] != 'verifikasi'):?>
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
                                            <?php
                                                $status = strtolower($peminjaman['status_diterima']);
                                                switch ($status) {
                                                    case 'verifikasi':
                                                        $bg = 'warning';
                                                        break;
                                                    case 'tunggu':
                                                        $bg = 'secondary';
                                                        break;
                                                    case 'terima':
                                                        $bg = 'success';
                                                        break;
                                                    case 'tolak':
                                                        $bg = 'danger';
                                                        break;
                                                    default:
                                                        $bg = 'dark'; // fallback warna jika status tidak dikenal
                                                }
                                            ?>

                                            <?= ucfirst($status); ?>
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
                                    <?php endif;?>
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