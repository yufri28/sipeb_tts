<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Stok Barang</h3>
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

                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Tahun</th>
                                        <th>Sumber</th>
                                        <th style="width: 10%">Kondisi</th>
                                        <!-- <th style="width: 10%">Action</th> -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Tahun</th>
                                        <th>Sumber</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php foreach ($stok as $key => $value):?>
                                    <tr>
                                        <td><?=$i++?>.</td>
                                        <td><?=$value['nama_jenisbarang'];?></td>
                                        <td><?=$value['jumlah'];?></td>
                                        <td><?=$value['nama_satuan'];?></td>
                                        <td><?=$value['tahun'];?></td>
                                        <td><?=$value['nama_sumber'];?></td>
                                        <td>
                                            <a href="<?=base_url("stokbarang/cek_kondisi/".$value['id_stok']);?>"
                                                title="Cek Kondisi Stok" class="btn btn-primary btn-sm"
                                                data-original-title="Cek Kondisi Stok">Cek Kondisi</i>
                                            </a>
                                        </td>
                                        <!-- <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip" title="Edit Data Barang"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Data Barang">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title="Hapus Data Barang"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Hapus Data Barang">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td> -->
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