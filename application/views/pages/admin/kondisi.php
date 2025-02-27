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
                        <a href="<?=base_url('stokbarang');?>" class="btn-link">Kembali Ke Stok Barang</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="no-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Barang</th>
                                        <th>Kondisi</th>
                                        <th>Stok Masuk</th>
                                        <th style="width: 10%">Stok Terkini</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($kondisi as $key => $value) :?>
                                    <tr id="row_<?=$value['id_kondisi_terkini'];?>">
                                        <td><?=$i++?>.</td>
                                        <td><?=$value['nama_jenisbarang'];?></td>
                                        <td><?=$value['nama_kondisi'];?></td>
                                        <td>
                                            <?= $value['stok_masuk'];?>
                                        <td>
                                            <?= $value['stok_terkini'];?>
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