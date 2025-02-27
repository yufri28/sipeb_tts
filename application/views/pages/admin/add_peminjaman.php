<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Peminjaman</h3>
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
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h3 class="fw-bold mb-3">Tambah Peminjaman</h3>
                    </div>
                    <form action="<?=base_url('barangkeluar/add_peminjaman');?>" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Jenis Barang <small class="text-danger">*</small></label>
                                        <select name="id_kondisi_terkini[]" style="width: 100%" required
                                            class="form-control" data-control="select2" id="id_kondisi_terkini"
                                            multiple>
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
                                        <div id="formatError" style="color: red; display: none;">Input hanya boleh angka
                                            dan
                                            koma!</div>
                                        <small><i>Isi jumlah sesuai urutan pada inputan jenis barang, dan dipisah dengan
                                                koma
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
                                        <label>Nama Penanggung Jawab <small
                                                class="text-danger">*</small></label></label>
                                        <input required type="text" id="nama_penanggungjawab" class="form-control"
                                            placeholder="Nama Penanggung Jawab" name="nama_penanggungjawab" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>No HP Penanggung Jawab <small
                                                class="text-danger">*</small></label></label>
                                        <input required type="number" id="no_hp" class="form-control"
                                            placeholder="No HP Penanggung Jawab" name="no_hp" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Alamat Penggunaan Barang <small
                                                class="text-danger">*</small></label></label>
                                        <textarea required name="alamat" class="form-control" id="alamat"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Keperluan <small class="text-danger">*</small></label></label>
                                        <textarea required name="keperluan" class="form-control"
                                            id="keperluan"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer d-flex border-0 justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>