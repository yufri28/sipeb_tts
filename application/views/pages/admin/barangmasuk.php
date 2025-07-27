<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Barang Masuk</h3>
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
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select-mas" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tahun</th>
                                        <th>Sumber</th>
                                        <th>Masuk Stok</th>
                                        <th>Keterangan Tambahan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tahun</th>
                                        <th>Sumber</th>
                                        <!-- <th>Masuk Stok</th> -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($barang_masuk as $key => $value):?>
                                    <tr>
                                        <td><?=$i++?>.</td>
                                        <td><?= date('d-m-Y', strtotime($value['tanggal_masuk'])); ?></td>
                                        <td>BRG<?=$value['klasifikasi_id'];?><?=$value['sumber_id'];?><?=$value['id_jenisbarang'];?>
                                        </td>
                                        <td><?=$value['nama_jenisbarang'];?></td>
                                        <td><?=$value['jumlah'];?></td>
                                        <td><?=$value['tahun'];?></td>
                                        <td><?=$value['nama_sumber'];?></td>
                                        <?php if($value['masuk_stok'] == 'belum'):?>
                                        <td class="text-center">
                                            <button type="button" data-bs-target="#masukStok" data-bs-toggle="modal"
                                                data-id="<?=$value['id_stok'];?>" class="btn btn-sm btn-primary">
                                                Masuk Stok
                                            </button>
                                        </td>
                                        <?php else:?>
                                        <td>
                                            <i class="fa fs-4 fa-check text-success" aria-hidden="true"></i>
                                        </td>
                                        <?php endif;?>
                                        <td>
                                            <?php
                                                $text = $value['keterangan_tambahan'] ??'-';
                                                $shortText = strlen($text) > 20 ? substr($text, 0, 20) . '...' : $text;
                                            ?>
                                            <?php if (strlen($text) > 20): ?>
                                            <span data-bs-toggle="modal"
                                                data-bs-target="#modalKet<?=$value['id_stok'];?>"
                                                style="cursor:pointer; color:blue; text-decoration:underline;">
                                                <?=$shortText;?>
                                            </span>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalKet<?=$value['id_stok'];?>" tabindex="-1"
                                                aria-labelledby="modalKetLabel<?=$value['id_stok'];?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <!-- modal-lg untuk ukuran lebih besar -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalKetLabel<?=$value['id_stok'];?>">Keterangan
                                                                Tambahan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-wrap"
                                                                style="word-wrap: break-word; white-space: pre-wrap;">
                                                                <?=nl2br(htmlspecialchars($text));?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <?=$text;?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <?php if($value['masuk_stok'] == 'belum'):?>
                                                <button type="button" data-bs-target="#editModal" data-bs-toggle="modal"
                                                    title="Edit Data Barang" class="btn btn-link btn-primary btn-lg"
                                                    data-id="<?=$value['id_stok'];?>"
                                                    data-tanggal="<?= date('Y-m-d', strtotime($value['tanggal_masuk'])); ?>"
                                                    data-jenis="<?=$value['jenis_barang_id'];?>"
                                                    data-klasifikasi="<?=$value['klasifikasi_id'];?>"
                                                    data-satuan="<?=$value['satuan_id'];?>"
                                                    data-sumber="<?=$value['sumber_id'];?>"
                                                    data-jumlah="<?=$value['jumlah'];?>"
                                                    data-tahun="<?=$value['tahun'];?>"
                                                    data-keterangan="<?=$value['keterangan_tambahan'];?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif;?>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-id="<?=$value['id_stok'];?>"
                                                    data-nama="<?=$value['nama_jenisbarang'];?>"
                                                    data-tanggal="<?= date('d-m-Y', strtotime($value['tanggal_masuk'])); ?>"
                                                    data-bs-target="#deleteModal" title="Hapus Data Barang"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Data Barang">
                                                    <i class="fa fa-times"></i>
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