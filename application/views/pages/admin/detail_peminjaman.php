<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Peminjaman</h3>
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
                        <?php if($data_peminjaman['nama_pihak_pertama'] == NULL):?>
                        <marquee>
                            <p class="text-danger"><i>Serah terima tidak dapat dicetak karena data belum lengkap.
                                    Silahkan lengkapi Nama Pihak Pertama, Jabatan Pihak Pertama, Nama Kepala Pelaksana,
                                    Jabatan Kepala Pelaksana dan NIP Kepala
                                    Pelaksana dengan klik tombol Ubah!</i></p>
                        </marquee>
                        <?php endif;?>
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a class="btn-link me-auto" href="<?=base_url('barangkeluar')?>">
                                    Kembali ke Barang Keluar
                                </a>
                                <?php if($data_peminjaman['status_peminjaman'] != 'selesai'):?>
                                <button type="button" class="btn btn-success btn-round"
                                    data-batch_id="<?= $data_peminjaman['batch_id']; ?>"
                                    data-bs-target="#konfirmasiSelesai" data-bs-toggle="modal" title="Tandai selesai">
                                    <i class="fa fa-check"></i> Tandai Selesai
                                </button>
                                <?php endif;?>
                                <button type="button" data-bs-target="#ubahSerahTerima" data-bs-toggle="modal"
                                    class="btn btn-info btn-round">
                                    <i class="fa fa-edit"></i>
                                    Ubah
                                </button>
                                <?php if($data_peminjaman['nama_pihak_pertama'] != NULL):?>
                                <a class="btn btn-primary btn-round"
                                    href="<?=base_url('barangkeluar/cetak_serah_terima_peminjaman/'.$data_peminjaman['batch_id'])?>">
                                    <i class="fa fa-print"></i>
                                    Cetak
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tanggal Peminjaman</h5>
                                        <p class="card-text">
                                            <?= date('d-m-Y', strtotime($data_peminjaman['tanggal_pinjam'])); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nama Pihak Pertama</h5>
                                        <p class="card-text"><?=$data_peminjaman['nama_pihak_pertama'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jabatan Pihak Pertama</h5>
                                        <p class="card-text"><?=$data_peminjaman['jabatan_pihak_pertama'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nama Pihak Kedua</h5>
                                        <p class="card-text"><?=$data_peminjaman['nama_penanggungjawab'];?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">No HP</h5>
                                        <p class="card-text"><?=$data_peminjaman['no_hp'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nama Kepala Pelaksana</h5>
                                        <p class="card-text"><?=$data_peminjaman['kepala_pelaksana'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jabatan Kepala Pelaksana</h5>
                                        <p class="card-text"><?=$data_peminjaman['jabatan_pelaksana'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">NIP Kepala Pelaksana</h5>
                                        <p class="card-text"><?=$data_peminjaman['nip_pelaksana'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="foto-kondisi-peminjaman d-flex flex-wrap gap-2">
                                <?php if (!empty($foto_lama)): ?>
                                <?php foreach ($foto_lama as $foto): ?>
                                <div class="position-relative m-1">
                                    <a href="<?= base_url('uploads/fkp/'.$foto['fkp']); ?>" target="_blank">
                                        <img src="<?= base_url('uploads/fkp/'.$foto['fkp']); ?>" alt="Foto Lama"
                                            width="120" height="120"
                                            style="object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                                    </a>
                                    <!-- Tombol hapus -->
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                        onclick="hapusFotoLama(<?= $foto['id_fkp']; ?>, this)">
                                        ×
                                    </button>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <small class="text-muted">Belum ada foto.</small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="multi-filter-select-kel" class="display nowrap table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>JENIS BANTUAN</th>
                                        <th>VOLUME</th>
                                        <th>SATUAN</th>
                                        <th>SUMBER</th>
                                        <th style="width: 5%">KONDISI</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>JENIS BANTUAN</th>
                                        <th>VOLUME</th>
                                        <th>SATUAN</th>
                                        <th>SUMBER</th>
                                        <th>KONDISI</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_barang_keluar as $key => $barang_keluar) : ?>
                                    <tr>
                                        <td><?= $i++; ?>.</td>
                                        <td><?= $barang_keluar['nama_jenisbarang']; ?></td>
                                        <td><?= $barang_keluar['jumlah']; ?></td>
                                        <td><?= $barang_keluar['nama_satuan']; ?></td>
                                        <td><?= $barang_keluar['nama_sumber']; ?></td>
                                        <td><?= $barang_keluar['nama_kondisi']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate -->
<!-- Modal Ubah Serah Terima -->
<div class="modal fade" id="ubahSerahTerima" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('barangkeluar/update_peminjaman'); ?>" enctype="multipart/form-data"
                method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Ubah </span>
                        <span class="fw-light"> Detail Peminjaman </span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Form Input -->
                        <!-- ... (semua input yang sudah kamu punya tetap di sini) ... -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Tanggal Peminjaman <small
                                        class="text-danger">*</small></label></label> <input required type="date"
                                    value="<?=$data_peminjaman['tanggal_pinjam'];?>" class="form-control"
                                    name="tanggal_pinjam" /> </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Nama Pihak Pertama <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    id="nama_pihak_pertama" value="<?=$data_peminjaman['nama_pihak_pertama'];?>"
                                    class="form-control" placeholder="Nama Pihak Pertama" name="nama_pihak_pertama" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Jabatan Pihak Pertama <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    class="form-control" value="<?=$data_peminjaman['jabatan_pihak_pertama'];?>"
                                    placeholder="Jabatan Pihak Pertama" name="jabatan_pihak_pertama" /> </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Nama Pihak Kedua <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    id="nama_pihak_kedua" class="form-control" placeholder="Nama Pihak Kedua"
                                    value="<?=$data_peminjaman['nama_penanggungjawab'];?>" name="nama_pihak_kedua" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>No HP <small
                                        class="text-danger">*</small></label></label> <textarea name="no_hp" id="no_hp"
                                    required class="form-control"><?=$data_peminjaman['no_hp'];?></textarea> </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Nama Kepala Pelaksana <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    id="kepala_pelaksana" class="form-control" placeholder="Nama Kepala Pelaksana"
                                    value="<?=$data_peminjaman['kepala_pelaksana'];?>" name="kepala_pelaksana" /> </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>Jabatan Pelaksana <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    id="jabatan_pelaksana" class="form-control" placeholder="Jabatan Pelaksana"
                                    value="<?=$data_peminjaman['jabatan_pelaksana'];?>" name="jabatan_pelaksana" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default"> <label>NIP Pelaksana <small
                                        class="text-danger">*</small></label></label> <input required type="text"
                                    id="nip_pelaksana" class="form-control" placeholder="NIP Pelaksana"
                                    value="<?=$data_peminjaman['nip_pelaksana'];?>" name="nip_pelaksana" /> </div>
                        </div>
                        <!-- Upload Foto Baru -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Upload Foto <small class="text-danger">*</small></label>
                                <input type="file" name="foto[]" id="foto" class="form-control" multiple
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- Preview Foto Baru -->
                        <div class="col-sm-12 mt-2">
                            <div id="preview_foto_baru" class="d-flex flex-wrap gap-2"></div>
                        </div>

                        <!-- Preview Foto Lama -->
                        <div class="col-sm-12 mt-2">
                            <div id="preview_foto_lama" class="d-flex flex-wrap gap-2">
                                <?php if (!empty($foto_lama)): ?>
                                <?php foreach ($foto_lama as $foto): ?>
                                <div class="position-relative m-1">
                                    <img src="<?= base_url('uploads/fkp/'.$foto['fkp']); ?>" alt="Foto Lama" width="100"
                                        height="100" style="object-fit:cover;border-radius:8px;">
                                    <!-- Tombol hapus foto lama -->
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                        onclick="hapusFotoLama(<?= $foto['id_fkp']; ?>, this)">
                                        ×
                                    </button>
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <input type="hidden" name="batch_id" value="<?= $data_peminjaman['batch_id']; ?>">
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Preview Foto Baru & Hapus Foto Lama -->
<script>
document.getElementById('foto').addEventListener('change', function(event) {
    let preview = document.getElementById('preview_foto_baru');
    preview.innerHTML = ""; // reset preview foto baru
    let files = event.target.files;

    Array.from(files).forEach((file, index) => {
        let reader = new FileReader();
        reader.onload = function(e) {
            let wrapper = document.createElement('div');
            wrapper.style.position = 'relative';
            wrapper.style.display = 'inline-block';
            wrapper.style.margin = '5px';

            let img = document.createElement('img');
            img.src = e.target.result;
            img.width = 100;
            img.height = 100;
            img.style.objectFit = 'cover';
            img.classList.add('rounded');

            let btn = document.createElement('button');
            btn.innerHTML = '×';
            btn.type = 'button';
            btn.style.position = 'absolute';
            btn.style.top = '0';
            btn.style.right = '0';
            btn.style.background = 'red';
            btn.style.color = 'white';
            btn.style.border = 'none';
            btn.style.cursor = 'pointer';
            btn.onclick = function() {
                let dt = new DataTransfer();
                Array.from(files).forEach((f, i) => {
                    if (i !== index) dt.items.add(f);
                });
                document.getElementById('foto').files = dt.files;
                wrapper.remove();
            };

            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            preview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });
});

function hapusFotoLama(id_fkp, btn) {
    if (!confirm('Yakin hapus foto ini?')) return;
    fetch('<?= base_url("barangkeluar/hapus_foto_peminjaman/"); ?>' + id_fkp, {
            method: 'POST'
        }).then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                btn.parentElement.remove();
            } else {
                alert('Gagal hapus foto.');
            }
        });
}
</script>


<script>
let selectedFiles = [];

document.getElementById('foto').addEventListener('change', function(e) {
    selectedFiles = [...selectedFiles, ...e.target.files];
    updatePreview();
    this.value = ''; // reset input agar bisa pilih file yang sama lagi
});

function updatePreview() {
    let preview = document.getElementById('preview_foto');
    preview.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        if (!file.type.startsWith('image/')) return;

        let reader = new FileReader();
        reader.onload = function(evt) {
            let wrapper = document.createElement('div');
            wrapper.style.position = 'relative';
            wrapper.style.display = 'inline-block';

            let img = document.createElement('img');
            img.src = evt.target.result;
            img.classList.add('img-thumbnail');
            img.style.width = '120px';
            img.style.height = '120px';
            img.style.objectFit = 'cover';

            let btnRemove = document.createElement('button');
            btnRemove.innerHTML = '❌';
            btnRemove.type = 'button';
            btnRemove.style.position = 'absolute';
            btnRemove.style.top = '2px';
            btnRemove.style.right = '2px';
            btnRemove.style.background = 'rgba(0,0,0,0.5)';
            btnRemove.style.color = '#fff';
            btnRemove.style.border = 'none';
            btnRemove.style.borderRadius = '50%';
            btnRemove.style.width = '24px';
            btnRemove.style.height = '24px';
            btnRemove.style.cursor = 'pointer';

            btnRemove.addEventListener('click', function() {
                selectedFiles.splice(index, 1);
                updatePreview();
            });

            wrapper.appendChild(img);
            wrapper.appendChild(btnRemove);
            preview.appendChild(wrapper);
        }
        reader.readAsDataURL(file);
    });

    // update hidden input agar semua file ikut terkirim
    let hiddenInput = document.getElementById('foto_hidden');
    let dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    hiddenInput.files = dataTransfer.files;
}
</script>