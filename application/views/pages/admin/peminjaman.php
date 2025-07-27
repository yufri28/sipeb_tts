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
                            <table id="multi-filter-select-pem" class="display nowrap table table-striped table-hover">
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
                                        <th>Foto KTP</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
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
                                    </tr>
                                </tfoot>
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

                                            <?= ucfirst($status);?>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="<?=base_url('uploads/peminjaman/'.$peminjaman['foto_ktp']);?>">
                                                <img src="<?= base_url('uploads/peminjaman/' . $peminjaman['foto_ktp']) ?>"
                                                    width="100" alt="Foto KTP">
                                            </a>
                                        </td>
                                        <td>
                                            <button <?=$peminjaman['status_diterima'] != 'verifikasi'?'hidden':''?>
                                                type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                data-nama="<?=$peminjaman['name'];?>"
                                                data-tanggal="<?=date('d-m-Y',strtotime($peminjaman['tanggal_pengajuan']));?>"
                                                data-bs-target="#accModal" data-bs-toggle="modal"
                                                title="Terima Peminjaman" class="btn btn-sm btn-primary me-1"
                                                data-original-title="Terima Peminjaman">
                                                <i class="fa fa-check"> Valid</i>
                                            </button>
                                            <div class="form-button-action">
                                                <button type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-target="#detailModal<?= $peminjaman['batch_id']; ?>"
                                                    data-bs-toggle="modal" title="Detail Barang Pinjam"
                                                    class="btn btn-sm btn-info me-1"
                                                    data-original-title="Detail Barang Pinjam">
                                                    <i class="fa fa-eye"> Detail</i>
                                                </button>
                                            </div>
                                            <button <?=$peminjaman['status_diterima'] != 'verifikasi'?'hidden':''?>
                                                type="button" data-batch_id="<?= $peminjaman['batch_id']; ?>"
                                                data-nama="<?=$peminjaman['name'];?>"
                                                data-tanggal="<?=date('d-m-Y',strtotime($peminjaman['tanggal_pengajuan']));?>"
                                                data-bs-target="#rejectModal" data-bs-toggle="modal"
                                                title="Tolak Peminjaman" class="btn btn-sm btn-danger"
                                                data-original-title="Tolak Peminjaman">
                                                <i class="fa fa-times"> Tolak</i>
                                            </button>
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

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?=base_url('peminjaman/add');?>" enctype="multipart/form-data" method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Add</span>
                        <span class="fw-light"> Peminjaman </span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jenis Barang <small class="text-danger">*</small></label>
                                <select name="id_kondisi_terkini[]" style="width: 100%" required class="form-control"
                                    data-control="select2" id="id_kondisi_terkini" multiple>
                                    <?php foreach ($data_stok_barang as $key => $value): ?>
                                    <option value="<?= $value['id_kondisi_terkini']; ?>"
                                        data-stok="<?= $value['stok_terkini']; ?>"
                                        <?= $value['stok_terkini'] <= 0 ? 'disabled' : ''; ?>>
                                        <?= $value['nama_jenisbarang']; ?> - <?= $value['tahun']; ?> -
                                        <?= $value['nama_kondisi']; ?> - Stok: <?= $value['stok_terkini']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jumlah <small class="text-danger">*</small></label>
                                <input required type="text" id="totalJumlah" class="form-control"
                                    placeholder="Jumlah barang (pisahkan dengan koma)" name="jumlah" />
                                <div id="stokError" style="color: red; display: none;">Stok tidak cukup!</div>
                                <div id="formatError" style="color: red; display: none;">Input hanya boleh angka dan
                                    koma!</div>
                                <small><i>Isi jumlah sesuai urutan pada inputan jenis barang, dan dipisah dengan koma
                                        tanpa spasi.
                                        Contoh 1,2,3</i></small>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Tanggal Peminjaman <small class="text-danger">*</small></label></label>
                                <input required type="date" class="form-control" name="tanggal_pinjam" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Tanggal Pengembalian <small class="text-danger">*</small></label></label>
                                <input required type="date" class="form-control" name="tanggal_kembali" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama Penanggung Jawab <small class="text-danger">*</small></label></label>
                                <input required type="text" id="nama_penanggungjawab" class="form-control"
                                    placeholder="Nama Penanggung Jawab" name="nama_penanggungjawab" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>No HP Penanggung Jawab <small class="text-danger">*</small></label></label>
                                <input required type="number" id="no_hp" class="form-control"
                                    placeholder="No HP Penanggung Jawab" name="no_hp" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Alamat Penggunaan Barang <small class="text-danger">*</small></label></label>
                                <textarea required name="alamat" class="form-control" id="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Keperluan <small class="text-danger">*</small></label></label>
                                <textarea required name="keperluan" class="form-control" id="keperluan"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Foto KTP <small class="text-danger">*</small></label></label>
                                <input accept=".jpg, .png, .jpeg" required type="file" id="foto_ktp"
                                    class="form-control" name="foto_ktp" />
                            </div>
                            <small><i>File yang diizinkan adalah .jpg/.png/.jpeg</i></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                        Add
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>