<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Bencana</h3>
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
                            <table id="no-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Bencana</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Bukti Lap. Pusdolops</th>
                                        <th>Bukti SK Tnggp Darurat</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($data_bencana as $key => $value):?>
                                    <tr>
                                        <td><?=$i++;?>.</td>
                                        <td><?=$value['nama_bencana'];?></td>
                                        <td><?= date('d/m/Y', strtotime($value['tanggal'])); ?></td>
                                        <td><?=$value['lokasi'];?></td>
                                        <td class="text-center">
                                            <a target="_blank"
                                                href="<?=base_url('uploads/bencana/'.$value['bukti_lap_pusdolops']);?>"
                                                class="btn btn-sm btn-secondary">
                                                Lihat
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a target="_blank"
                                                href="<?=base_url('uploads/bencana/'.$value['sk_tanggap_darurat']);?>"
                                                class="btn btn-sm btn-secondary">
                                                Lihat
                                            </a>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-target="#editModal" data-bs-toggle="modal"
                                                    data-id_bencana="<?=$value['id_bencana'];?>"
                                                    data-jenis_bencana_id="<?=$value['jenis_bencana_id'];?>"
                                                    data-tanggal="<?=$value['tanggal'];?>"
                                                    data-lokasi="<?=$value['lokasi'];?>" title="Edit Data Bencana"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Data Bencana">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-target="#deleteModal"
                                                    data-bs-toggle="modal" data-id_bencana="<?=$value['id_bencana'];?>"
                                                    data-jenis_bencana="<?=$value['nama_bencana'];?>"
                                                    data-tanggal="<?=$value['tanggal'];?>" title="Hapus Data Bencana"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Data Bencana">
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