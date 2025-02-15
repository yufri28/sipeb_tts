 <!-- Modal -->
 <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangmasuk/add');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Add</span>
                         <span class="fw-light"> Barang Masuk </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal Masuk <small class="text-danger">*</small></label></label>
                                 <input required type="date" class="form-control" placeholder="Tanggal barang masuk"
                                     name="tanggal_masuk" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Barang <small class="text-danger">*</small></label>
                                 <select required name="jenis_barang_id" class="form-control">
                                     <option value="">-- Pilih Jenis Barang --</option>
                                     <?php foreach ($jenis_barang as $key => $value):?>
                                     <option value="<?=$value['id_jenisbarang'];?>">
                                         <?=$value['nama_jenisbarang'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Klasifikasi <small class="text-danger">*</small></label></label>
                                 <select required name="klasifikasi_id" class="form-control">
                                     <option value="">-- Pilih Klasifikasi --</option>
                                     <?php foreach ($klasifikasi as $key => $value):?>
                                     <option value="<?=$value['id_klasifikasi'];?>">
                                         <?=$value['nama_klasifikasi'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Satuan <small class="text-danger">*</small></label></label>
                                 <select required name="satuan_id" class="form-control">
                                     <option value="">-- Pilih Satuan --</option>
                                     <?php foreach ($satuan as $key => $value):?>
                                     <option value="<?=$value['id_satuan'];?>">
                                         <?=$value['nama_satuan'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Sumber <small class="text-danger">*</small></label></label>
                                 <select required name="sumber_id" class="form-control">
                                     <option value="">-- Pilih Sumber --</option>
                                     <?php foreach ($sumber as $key => $value):?>
                                     <option value="<?=$value['id_sumber'];?>">
                                         <?=$value['nama_sumber'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jumlah <small class="text-danger">*</small></label></label>
                                 <input required type="number" id="totalJumlah" class="form-control"
                                     placeholder="Jumlah barang masuk" name="jumlah" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tahun <small class="text-danger">*</small></label></label>
                                 <input required type="text" class="form-control" placeholder="Tahun perolehan"
                                     name="tahun" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Keterangan Tambahan</label>
                                 <textarea class="form-control" name="keterangan_tambahan"></textarea>
                             </div>
                             <small class="text-danger"><i>Keterangan Tambahan boleh
                                     dikosongkan!</i></small>
                         </div>
                     </div>
                     <hr>
                     <div class="row">
                         <h5>Data Kondisi</h5>
                         <div class="col-sm-12">
                             <?php foreach ($kondisi as $key => $value) :?>
                             <div class="form-group form-group-default">
                                 <label>Jumlah Kondisi <?=$value['nama_kondisi'];?><small
                                         class="text-danger">*</small></label>
                                 <input required type="number" class="form-control kondisi"
                                     placeholder="Jumlah <?=$value['nama_kondisi'];?>"
                                     name="<?=$value['id_kondisi'];?>" />
                             </div>
                             <?php endforeach;?>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div id="errorMessage" class="text-danger" style="display: none;">
                             Jumlah barang masuk tidak sesuai dengan total jumlah barang
                             perkondisi.
                             Mohon periksa kembali.
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="stok_id" value="<?=generate_uuid();?>">
                     <button type="submit" class="btn btn-primary" id="submitBtn">
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

 <!-- <script>
// Function untuk menghitung total kondisi
function hitungTotalKondisi() {
    let totalKondisi = 0;
    document.querySelectorAll('.kondisi').forEach(input => {
        totalKondisi += parseInt(input.value) || 0;
    });
    return totalKondisi;
}

// Function untuk validasi dan menampilkan pesan kesalahan
function validateInput() {
    const totalJumlah = parseInt(document.getElementById('totalJumlah').value) || 0;
    const totalKondisi = hitungTotalKondisi();

    if (totalKondisi > totalJumlah) {
        document.getElementById('errorMessage').style.display = 'block'; // Tampilkan pesan error
        document.getElementById('submitBtn').disabled = true;
    } else {
        document.getElementById('errorMessage').style.display = 'none'; // Sembunyikan pesan error
        document.getElementById('submitBtn').disabled = false;
    }
}

// Event listener untuk input kondisi
document.querySelectorAll('.kondisi').forEach(input => {
    input.addEventListener('input', validateInput);
});

// Event listener untuk input jumlah barang masuk
document.getElementById('totalJumlah').addEventListener('input', validateInput);
 </script> -->

 <!-- Modal Edit -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangmasuk/update');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Edit</span>
                         <span class="fw-light"> Barang Masuk </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal Masuk <small class="text-danger">*</small></label></label>
                                 <input required type="date" class="form-control" placeholder="Tanggal barang masuk"
                                     name="tanggal_masuk" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Barang <small class="text-danger">*</small></label>
                                 <select required name="jenis_barang_id" class="form-control">
                                     <option value="">-- Pilih Jenis Barang --</option>
                                     <?php foreach ($jenis_barang as $key => $value):?>
                                     <option value="<?=$value['id_jenisbarang'];?>">
                                         <?=$value['nama_jenisbarang'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Klasifikasi <small class="text-danger">*</small></label></label>
                                 <select required name="klasifikasi_id" class="form-control">
                                     <option value="">-- Pilih Klasifikasi --</option>
                                     <?php foreach ($klasifikasi as $key => $value):?>
                                     <option value="<?=$value['id_klasifikasi'];?>">
                                         <?=$value['nama_klasifikasi'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Satuan <small class="text-danger">*</small></label></label>
                                 <select required name="satuan_id" class="form-control">
                                     <option value="">-- Pilih Satuan --</option>
                                     <?php foreach ($satuan as $key => $value):?>
                                     <option value="<?=$value['id_satuan'];?>">
                                         <?=$value['nama_satuan'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Sumber <small class="text-danger">*</small></label></label>
                                 <select required name="sumber_id" class="form-control">
                                     <option value="">-- Pilih Sumber --</option>
                                     <?php foreach ($sumber as $key => $value):?>
                                     <option value="<?=$value['id_sumber'];?>">
                                         <?=$value['nama_sumber'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jumlah <small class="text-danger">*</small></label></label>
                                 <input required type="number" id="totalJumlah" class="form-control"
                                     placeholder="Jumlah barang masuk" name="jumlah" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tahun <small class="text-danger">*</small></label></label>
                                 <input required type="text" class="form-control" placeholder="Tahun perolehan"
                                     name="tahun" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Keterangan Tambahan</label>
                                 <textarea class="form-control" name="keterangan_tambahan"></textarea>
                             </div>
                             <small class="text-danger"><i>Keterangan Tambahan boleh
                                     dikosongkan!</i></small>
                         </div>
                     </div>
                     <hr>
                     <div class="row">
                         <h5>Data Kondisi</h5>
                         <div class="col-sm-12">
                             <?php foreach ($kondisi as $key => $value) :?>
                             <div class="form-group form-group-default">
                                 <label>Jumlah Kondisi <?=$value['nama_kondisi'];?><small
                                         class="text-danger">*</small></label>
                                 <input required type="number" class="form-control kondisi"
                                     placeholder="Jumlah <?=$value['nama_kondisi'];?>"
                                     name="<?=$value['id_kondisi'];?>" />
                             </div>
                             <?php endforeach;?>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div id="errorMessage" class="text-danger" style="display: none;">
                             Jumlah barang masuk tidak sesuai dengan total jumlah barang
                             perkondisi.
                             Mohon periksa kembali.
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="stok_id" value="<?=generate_uuid();?>">
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

 <script>
document.querySelectorAll('[data-bs-target="#editModal"]').forEach(button => {
    button.addEventListener('click', function() {
        // Ambil data dari atribut data-*
        const id = this.getAttribute('data-id');
        const tanggal_masuk = this.getAttribute('data-tanggal');
        const jenis_barang_id = this.getAttribute('data-jenis');
        const klasifikasi_id = this.getAttribute('data-klasifikasi');
        const satuan_id = this.getAttribute('data-satuan');
        const sumber_id = this.getAttribute('data-sumber');
        const jumlah = this.getAttribute('data-jumlah');
        const tahun = this.getAttribute('data-tahun');
        const keterangan = this.getAttribute('data-keterangan');

        // Isi form modal dengan data yang diambil
        document.querySelector('#editModal input[name="stok_id"]').value = id;
        document.querySelector('#editModal input[name="tanggal_masuk"]').value = tanggal_masuk;
        document.querySelector('#editModal select[name="jenis_barang_id"]').value = jenis_barang_id;
        document.querySelector('#editModal select[name="klasifikasi_id"]').value = klasifikasi_id;
        document.querySelector('#editModal select[name="satuan_id"]').value = satuan_id;
        document.querySelector('#editModal select[name="sumber_id"]').value = sumber_id;
        document.querySelector('#editModal input[name="jumlah"]').value = jumlah;
        document.querySelector('#editModal input[name="tahun"]').value = tahun;
        document.querySelector('#editModal textarea[name="keterangan_tambahan"]').value = keterangan;


        $.ajax({
            url: '<?=base_url("stokbarang/get_data_kondisi_by_id/")?>' +
                id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Reset semua input kondisi
                    $('.kondisi').val('');
                    // Isi input kondisi berdasarkan response
                    $.each(response.kondisi, function(index,
                        kondisi) {
                        $('input[name="' + kondisi.kondisi_logpal_id + '"]').val(
                            kondisi.jumlah);
                    });
                } else {
                    alert('Gagal mengambil data kondisi.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
 </script>

 <script>
// Function untuk menghitung total kondisi
function hitungTotalKondisi(modalId) {
    let totalKondisi = 0;
    document.querySelectorAll(`#${modalId} .kondisi`).forEach(input => {
        totalKondisi += parseInt(input.value) || 0;
    });
    return totalKondisi;
}

// Function untuk validasi dan menampilkan pesan kesalahan
function validateInput(modalId) {
    const totalJumlah = parseInt(document.querySelector(`#${modalId} #totalJumlah`).value) || 0;
    const totalKondisi = hitungTotalKondisi(modalId);

    if (totalKondisi > totalJumlah) {
        document.querySelector(`#${modalId} #errorMessage`).style.display = 'block'; // Tampilkan pesan error
        document.querySelector(`#${modalId} #submitBtn`).disabled = true; // Disable tombol submit
    } else {
        document.querySelector(`#${modalId} #errorMessage`).style.display = 'none'; // Sembunyikan pesan error
        document.querySelector(`#${modalId} #submitBtn`).disabled = false; // Enable tombol submit
    }
}

// Function untuk menambahkan event listener
function attachEventListeners(modalId) {
    // Event listener untuk input kondisi
    document.querySelectorAll(`#${modalId} .kondisi`).forEach(input => {
        input.addEventListener('input', function() {
            validateInput(modalId);
        });
    });

    // Event listener untuk input jumlah barang masuk
    document.querySelector(`#${modalId} #totalJumlah`).addEventListener('input', function() {
        validateInput(modalId);
    });
}

// Ketika modal Tambah atau Edit dibuka, attach event listener
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function() {
        const modalId = this.getAttribute('data-bs-target').replace('#', '');
        attachEventListeners(modalId);
    });
});
 </script>


 <!-- Modal Hapus -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangmasuk/delete');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold">Hapus</span>
                         <span class="fw-light">Barang Masuk</span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <p>Anda yakin ingin menghapus <strong id="namaBarang"></strong> yang masuk pada tanggal
                                 <strong id="tanggalMasuk"></strong>?
                             </p>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="stok_id" id="stok_id">
                     <button type="submit" class="btn btn-primary">Delete</button>
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Script untuk Mengisi Data ke Modal -->
 <script>
document.addEventListener('DOMContentLoaded', function() {
    // Ketika tombol hapus diklik
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Tombol yang memicu modal
        var stokId = button.getAttribute('data-id'); // Ambil data stok_id
        var namaBarang = button.getAttribute('data-nama'); // Ambil data nama barang
        var tanggalMasuk = button.getAttribute('data-tanggal'); // Ambil data tanggal masuk

        // Masukkan data ke elemen modal
        var modalNamaBarang = document.getElementById('namaBarang');
        var modalTanggalMasuk = document.getElementById('tanggalMasuk');
        var modalStokId = document.getElementById('stok_id');

        modalNamaBarang.textContent = namaBarang;
        modalTanggalMasuk.textContent = tanggalMasuk;
        modalStokId.value = stokId; // Set hidden input dengan stok_id
    });
});
 </script>