<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Kondisi</h3>
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
                        <a href="<?=base_url('stokbarang/cek_kondisi/'.$stok_id);?>" class="btn-link">Kembali
                            Ke Kondisi</a>
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
                                        <th style="width: 10%">Foto Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($kondisi as $key => $value) :?>
                                    <tr id="row_<?=$value['id_detail'];?>">
                                        <td><?=$i++?>.</td>
                                        <td><?=$value['kode'];?></td>
                                        <td><?=$value['nama_jenisbarang'];?></td>
                                        <td><?=$value['nama_kondisi'];?></td>
                                        <td>
                                            <a target="_blank"
                                                href="<?=base_url('uploads/detail_kondisi/'.$value['foto']);?>">
                                                <img src="<?= base_url('uploads/detail_kondisi/' . $value['foto']) ?>"
                                                    width="100" alt="Foto kondisi">
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" data-batch_id="<?= $value['id_detail']; ?>"
                                                data-bs-target="#editFotoModal<?= $value['id_detail']; ?>"
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
<div class="modal fade" id="editFotoModal<?= $value['id_detail']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?=base_url('stokbarang/editfotodetail');?>" enctype="multipart/form-data" method="post">
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
                                <input type="hidden" name="id_detail" value="<?= $value['id_detail']; ?>">
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