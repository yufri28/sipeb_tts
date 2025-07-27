<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Master Data</h3>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4>Master Jenis Barang</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addJenisBarang">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-master-barang" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenis Barang</th>
                                        <th>Keterangan Tambahan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nama Barang</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($jenis_barang as $key => $jenis):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$jenis['nama_jenisbarang'];?></td>
                                        <td>
                                            <?php
                                                $text = $jenis['keterangan_tambahan']??'-';
                                                $shortText = strlen($text) > 20 ? substr($text, 0, 20) . '...' : $text;
                                            ?>
                                            <?php if (strlen($text) > 20): ?>
                                            <span data-bs-toggle="modal"
                                                data-bs-target="#modalKet<?=$jenis['id_jenisbarang'];?>"
                                                style="cursor:pointer; color:blue; text-decoration:underline;">
                                                <?=$shortText;?>
                                            </span>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalKet<?=$jenis['id_jenisbarang'];?>"
                                                tabindex="-1"
                                                aria-labelledby="modalKetLabel<?=$jenis['id_jenisbarang'];?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <!-- modal-lg untuk ukuran lebih besar -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalKetLabel<?=$jenis['id_jenisbarang'];?>">
                                                                Keterangan
                                                                Tambahan Jenis Barang</h5>
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
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$jenis['nama_jenisbarang'];?>"
                                                    data-id="<?=$jenis['id_jenisbarang'];?>"
                                                    data-ket="<?=$jenis['keterangan_tambahan'];?>"
                                                    data-bs-target="#editJenisBarang" title="Edit Data Barang"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Data Barang">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$jenis['nama_jenisbarang'];?>"
                                                    data-id="<?=$jenis['id_jenisbarang'];?>"
                                                    data-bs-target="#hapusJenisBarang" title="Hapus Data Barang"
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <h4>Klasifikasi</h4>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addKlasifikasi">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="tb-master-klasifikasi" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Klasifikasi</th>
                                        <th>Keterangan Tambahan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Klasifikasi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($klasifikasi as $key => $value):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$value['nama_klasifikasi'];?></td>
                                        <td>
                                            <?php
                                                $text = $value['keterangan_tambahan']??'-';
                                                $shortText = strlen($text) > 20 ? substr($text, 0, 20) . '...' : $text;
                                            ?>
                                            <?php if (strlen($text) > 20): ?>
                                            <span data-bs-toggle="modal"
                                                data-bs-target="#modalKet<?=$value['id_klasifikasi'];?>"
                                                style="cursor:pointer; color:blue; text-decoration:underline;">
                                                <?=$shortText;?>
                                            </span>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalKet<?=$value['id_klasifikasi'];?>"
                                                tabindex="-1"
                                                aria-labelledby="modalKetLabel<?=$value['id_klasifikasi'];?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <!-- modal-lg untuk ukuran lebih besar -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalKetLabel<?=$value['id_klasifikasi'];?>">
                                                                Keterangan
                                                                Tambahan Klasifikas</h5>
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
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_klasifikasi'];?>"
                                                    data-id="<?=$value['id_klasifikasi'];?>"
                                                    data-ket-kl="<?=$value['keterangan_tambahan'];?>"
                                                    data-bs-target="#editKlasifikasi" title="Edit Klasifikasi"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Klasifikasi">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_klasifikasi'];?>"
                                                    data-id="<?=$value['id_klasifikasi'];?>"
                                                    data-bs-target="#hapusKlasifikasi" title="Hapus Klasifikasi"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Klasifikasi">
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4>Master Satuan</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addSatuan">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-master-satuan" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satuan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nama Satuan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($satuan as $key => $value):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$value['nama_satuan'];?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_satuan'];?>"
                                                    data-id="<?=$value['id_satuan'];?>" data-bs-target="#editSatuan"
                                                    title="Edit Satuan" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Satuan">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_satuan'];?>"
                                                    data-id="<?=$value['id_satuan'];?>" data-bs-target="#hapusSatuan"
                                                    title="Hapus Satuan" class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Satuan">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <h4>Master Sumber</h4>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addSumber">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-master-sumber" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sumber</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Sumber</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($sumber as $key => $value):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$value['nama_sumber'];?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_sumber'];?>"
                                                    data-id="<?=$value['id_sumber'];?>" data-bs-target="#editSumber"
                                                    title="Edit Sumber" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Sumber">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_sumber'];?>"
                                                    data-id="<?=$value['id_sumber'];?>" data-bs-target="#hapusSumber"
                                                    title="Hapus Sumber" class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Sumber">
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4>Master Kondisi</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addKondisi">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-master-kondisi" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kondisi</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nama Kondisi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($kondisi as $key => $value):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$value['nama_kondisi'];?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_kondisi'];?>"
                                                    data-id="<?=$value['id_kondisi'];?>" data-bs-target="#editKondisi"
                                                    title="Edit Kondisi" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Kondisi">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$value['nama_kondisi'];?>"
                                                    data-id="<?=$value['id_kondisi'];?>" data-bs-target="#hapusKondisi"
                                                    title="Hapus Kondisi" class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Kondisi">
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
            <!-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <h4>Master Jenis Bencana</h4>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addJenisBencana">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-master-jenis-bencana" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Bencana</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Jenis Bencana</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($jenis_bencana as $key => $bencana):?>
                                    <tr>
                                        <td><?= $i++?>. </td>
                                        <td><?=$bencana['nama_bencana'];?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$bencana['nama_bencana'];?>"
                                                    data-id="<?=$bencana['id_jenis_bencana'];?>"
                                                    data-bs-target="#editJenisBencana" title="Edit Jenis Bencana"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Jenis Bencana">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-nama="<?=$bencana['nama_bencana'];?>"
                                                    data-id="<?=$bencana['id_jenis_bencana'];?>"
                                                    data-bs-target="#hapusJenisBencana" title="Hapus Jenis Bencana"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Jenis Bencana">
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
            </div> -->
        </div>
    </div>
</div>