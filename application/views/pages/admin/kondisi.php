<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kondisi</h3>
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
                        <a href="<?=base_url('stokbarang');?>" class="btn-link">Kembali Ke Stok Barang</a>|
                        <?php if (!$sudah_sync): ?>
                        <button type="button" data-batch_id="<?=$this->uri->segment(3, 0); ?>"
                            data-bs-target="#syncData" data-bs-toggle="modal" class="btn btn-sm btn-info">
                            <i class="fa fa-pen"></i> Sync Data
                        </button>
                        <marquee class="text-danger">Untuk lihat detail kondisi, silahkan klik tombol sync terlebih
                            dahulu!
                        </marquee>
                        <?php else: ?>
                        <button type="button" class="btn btn-sm btn-success" disabled>
                            <i class="fa fa-check"></i> Sudah Disinkronkan
                        </button>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="no-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Kondisi</th>
                                        <th>Stok Masuk</th>
                                        <th style="width: 10%">Stok Terkini</th>
                                        <th>Foto Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($kondisi as $key => $value) :?>
                                    <tr id="row_<?=$value['id_kondisi_terkini'];?>">
                                        <td><?=$i++?>.</td>
                                        <!-- BRG+klasifikasiID+sumberID+jenisbarangID+masterkondisiID -->
                                        <td>BRG<?=$value['klasifikasi_id'];?><?=$value['sumber_id'];?><?=$value['jenis_barang_id'];?><?=$value['kondisi_logpal_id'];?>
                                        </td>
                                        <td><?=$value['nama_jenisbarang'];?></td>
                                        <td><?=$value['nama_kondisi'];?></td>
                                        <td>
                                            <?= $value['stok_masuk'];?>
                                        </td>
                                        <td>
                                            <?= $value['stok_terkini'];?>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="<?=base_url('uploads/kondisi/'.$value['foto_kondisi']);?>">
                                                <img src="<?= base_url('uploads/kondisi/' . $value['foto_kondisi']) ?>"
                                                    width="100" alt="Foto kondisi">
                                            </a>
                                        </td>
                                        <td>
                                            <?php if($value['stok_masuk'] > 0 && $sudah_sync):?>
                                            <a href="<?=base_url('stokbarang/detail_kondisi/'.$value['id_kondisi_terkini']);?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"> Detail Kondisi</i>
                                            </a>
                                            <?php endif;?>
                                            <button type="button" data-batch_id="<?= $value['id_kondisi_terkini']; ?>"
                                                data-bs-target="#editFotoModal<?= $value['id_kondisi_terkini']; ?>"
                                                data-bs-toggle="modal" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-pen"> Edit Foto</i>
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
<?php foreach ($kondisi as $key => $value) :?>
<div class="modal fade" id="editFotoModal<?= $value['id_kondisi_terkini']; ?>" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?=base_url('stokbarang/editfoto');?>" enctype="multipart/form-data" method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Edit</span>
                        <span class="fw-light"> Foto </span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Foto Kondisi <small class="text-danger">*</small></label></label>
                                <input accept=".jpg, .png, .jpeg" required type="file" id="foto_kondisi"
                                    class="form-control" name="foto_kondisi" />
                                <input type="hidden" name="id_kondisi_terkini"
                                    value="<?= $value['id_kondisi_terkini']; ?>">
                            </div>
                            <small><i>File yang diizinkan adalah .jpg/.png/.jpeg</i></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<div class="modal fade" id="syncData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?=base_url('stokbarang/syncdata');?>" method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Sync</span>
                        <span class="fw-light"> Data </span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <input type="hidden" name="stok_id" value="<?=$this->uri->segment(3, 0); ?>">
                                <p>Sync Data dilakukan jika pada detail kondisi masih kosong. Anda ingin
                                    melakukan sinkronisasi data?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        Yes
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>