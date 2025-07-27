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
                    <div class="card-header">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <div class="btn btn-sm text-white p-1 mt-2 rounded bg-warning">
                                    verifikasi
                                </div> : <small><i>Menunggu verifikasi data oleh admin</i></small>
                            </div>
                            <div class="me-2">
                                <div class="btn btn-sm text-white p-1 mt-2 rounded bg-secondary">
                                    tunggu
                                </div> : <small><i>Menunggu persetujuan</i></small>
                            </div>
                            <div class="me-2">
                                <div class="btn btn-sm text-white p-1 mt-2 rounded bg-success">
                                    terima
                                </div> : <small><i>Pengajuan peminjaman diterima</i></small>
                            </div>
                            <div class="me-2">
                                <div class="btn btn-sm text-white p-1 mt-2 rounded bg-danger">
                                    tolak
                                </div> : <small><i>Pengajuan peminjaman ditolak</i></small>
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
                                        <th>Jenis Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Keperluan</th>
                                        <th>Status</th>
                                        <th>Pesan/Alasan</th>
                                        <th>Foto KTP</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($data_peminjaman as $key => $peminjaman) :?>
                                    <tr>
                                        <td><?=$i++;?>.</td>
                                        <td><?= date('d-m-Y', strtotime($peminjaman['tanggal_pengajuan'])); ?></td>
                                        <td><?=$peminjaman['nama_jenisbarang'];?></td>
                                        <td><?=$peminjaman['jumlah_barang'];?></td>
                                        <td><?=date('d-m-Y', strtotime($peminjaman['tanggal_pinjam']));?>
                                        <td><?=date('d-m-Y', strtotime($peminjaman['tanggal_kembali']));?>
                                        <td><?=$peminjaman['nama_penanggungjawab'];?>
                                        <td><?=$peminjaman['no_hp'];?>
                                        <td><?=$peminjaman['alamat'];?>
                                        <td><?=$peminjaman['keperluan'];?>
                                        <td>
                                            <a target="_blank"
                                                href="<?=base_url('uploads/peminjaman/'.$peminjaman['foto_ktp']);?>">
                                                <img src="<?= base_url('uploads/peminjaman/' . $peminjaman['foto_ktp']) ?>"
                                                    width="100" alt="Foto KTP">
                                            </a>
                                        </td>
                                        <td>
                                            <?php if (!empty($peminjaman['status_diterima'])): ?>
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
                                            <div class="text-center text-white p-1 rounded bg-<?= $bg; ?>">
                                                <?= ucfirst($status); ?>
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-wrap"><?=$peminjaman['pesan']??'-';?>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-target="#detailModal<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-toggle="modal" title="Detail Barang Pinjam"
                                                    class="btn btn-sm btn-info me-1"
                                                    data-original-title="Detail Barang Pinjam">
                                                    <i class="fa fa-eye"> Detail</i>
                                                </button>
                                                <button type="button"
                                                    <?=$peminjaman['status_diterima'] != 'verifikasi'?'hidden':''?>
                                                    data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-target="#deleteModal" data-bs-toggle="modal"
                                                    title="Hapus Barang Pinjam" class="btn btn-sm btn-danger"
                                                    data-original-title="Hapus Barang Pinjam">
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