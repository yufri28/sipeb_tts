 <!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangkeluar/add');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Add</span>
                         <span class="fw-light"> Barang Keluar </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal Keluar <small class="text-danger">*</small></label></label>
                                 <input required type="date" class="form-control" placeholder="Tanggal barang keluar"
                                     name="tanggal_keluar" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Barang <small class="text-danger">*</small></label>
                                 <select name="id_kondisi_terkini[]" style="width: 100%" required class="form-control"
                                     data-control="select2" id="id_kondisi_terkini" multiple>
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
                                 <div id="formatError" style="color: red; display: none;">Input hanya boleh angka dan
                                     koma!</div>
                                 <small><i>Isi jumlah sesuai urutan pada inputan jenis barang, dan dipisah dengan koma
                                         tanpa spasi.
                                         Contoh 1,2,3</i></small>
                             </div>
                         </div>
                         <!-- <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Barang <small class="text-danger">*</small></label>
                                 <select name="id_kondisi_terkini" style="width: 100%" required class="form-control"
                                     data-control="select2" id="id_kondisi_terkini">
                                     <?php foreach ($data_stok_barang as $key => $value): ?>
                                     <option value="<?= $value['id_kondisi_terkini']; ?>"
                                         data-stok="<?= $value['stok_terkini']; ?>"
                                         <?= $value['stok_terkini'] <= 0 ? 'disabled' : ''; ?>>
                                         <?= $value['nama_jenisbarang']; ?> - <?= $value['tahun']; ?> -
                                         <?= $value['nama_kondisi']; ?> - <?= $value['stok_terkini']; ?>
                                     </option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jumlah <small class="text-danger">*</small></label>
                                 <input required type="number" id="totalJumlah" class="form-control"
                                     placeholder="Jumlah barang" name="jumlah" />
                                 <div id="stokError" style="color: red; display: none;">Stok tidak cukup!</div>
                             </div>
                         </div> -->
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
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
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const selectJenisBarang = document.getElementById('id_kondisi_terkini');
    const inputJumlah = document.getElementById('totalJumlah');
    const stokError = document.getElementById('stokError');
    const formatError = document.getElementById('formatError');
    const submitBtn = $('#submitBtn'); // Mengambil tombol submit

    // Fungsi untuk memvalidasi input hanya angka dan koma
    function validateFormat() {
        const jumlahValues = inputJumlah.value;
        const isValid = /^[0-9,]*$/.test(jumlahValues); // Cek apakah hanya angka dan koma

        if (!isValid) {
            formatError.style.display = 'block';
            submitBtn.prop('disabled', true); // Menonaktifkan tombol
            inputJumlah.setCustomValidity('Format tidak valid! Hanya angka dan koma yang diperbolehkan.');
        } else {
            submitBtn.prop('disabled', false);
            formatError.style.display = 'none';
            inputJumlah.setCustomValidity(''); // Reset validasi format
        }
        validateJumlah(); // Lanjutkan ke validasi stok
    }

    // Fungsi untuk memvalidasi jumlah terhadap stok dan memastikan tidak ada 0
    function validateJumlah() {
        const jumlahValues = inputJumlah.value.split(',').map(Number); // Array input jumlah
        const selectedOptions = Array.from(selectJenisBarang.selectedOptions); // Pilihan jenis barang
        let errorMessage = ''; // Pesan error jika ada
        var submitBtn = $('#submitBtn');

        // Jika jumlah inputan tidak sesuai dengan pilihan jenis barang
        if (jumlahValues.length !== selectedOptions.length) {
            errorMessage = 'Jumlah barang harus sesuai dengan jumlah barang yang dipilih!';
        } else {
            // Validasi setiap jumlah terhadap stok dan memastikan tidak ada angka 0
            selectedOptions.forEach((option, index) => {
                const stok = parseInt(option.getAttribute('data-stok')) || 0;
                const jumlah = jumlahValues[index] || 0;

                // Jika jumlah 0 atau lebih dari stok
                if (jumlah <= 0) {
                    errorMessage = `Jumlah untuk barang ${option.textContent.trim()} tidak boleh 0!`;
                } else if (jumlah > stok) {
                    errorMessage = `Stok tidak cukup untuk barang ${option.textContent.trim()}!`;
                }
            });
        }

        // Tampilkan atau sembunyikan pesan error stok
        if (errorMessage) {
            submitBtn.prop('disabled', true);
            stokError.textContent = errorMessage;
            stokError.style.display = 'block';
            inputJumlah.setCustomValidity(errorMessage);
        } else {
            submitBtn.prop('disabled', false);
            stokError.style.display = 'none';
            inputJumlah.setCustomValidity(''); // Reset validasi stok
        }
    }

    // Menjalankan validasi format setiap kali input jumlah berubah
    inputJumlah.addEventListener('input', validateFormat);

    // Menjalankan validasi stok ketika pilihan jenis barang berubah
    selectJenisBarang.addEventListener('change', validateFormat);
});
 </script>

 <script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('.multiple-numbers').select2({
        placeholder: "Masukkan angka...",
        multiple: true,
        allowClear: true
    });


    // Fungsi untuk menambahkan input duplikat
    function addDuplicateValue(inputValue) {
        // Cek apakah input adalah angka
        if (/^\d+$/.test(inputValue)) {
            // Tambahkan option baru ke select
            var newOption = new Option(inputValue, inputValue, true, true);
            $('.multiple-numbers').append(newOption).trigger('change');
        }
    }

    // Tangkap input dari Select2 dengan menekan tombol Enter atau koma
    $('.multiple-numbers').on('select2-selecting', function(e) {
        var inputValue = e.object.text;
        addDuplicateValue(inputValue);
        e.preventDefault(); // Cegah penambahan bawaan Select2
    });

    // Tangkap input manual dari pengguna
    $('.multiple-numbers').on('change', function(e) {
        var inputValue = $(this).select2('val').slice(-1)[0]; // Ambil nilai terakhir
        addDuplicateValue(inputValue);
    });
});
 </script>

 <script>
$(document).ready(function() {
    $('#addModal').on('shown.bs.modal', () => {
        var select2Element = $('[data-control="select2"]');

        // Reset pilihan saat modal ditampilkan untuk memastikan tidak ada pilihan otomatis
        select2Element.val([]).trigger('change');

        select2Element.select2({
            dropdownParent: $('#addModal'),
            placeholder: "-- Pilih Jenis Barang --",
            multiple: true,
            allowClear: true
        });
    });
});
 </script>

 <!-- Modal Hapus -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangkeluar/delete');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Hapus</span>
                         <span class="fw-light"> Barang Keluar </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <p>Data ini akan terhapus. Jika ingin mengembalikan stok silahkan pilih "Ya".</p>
                                 <strong>Apakah anda ingin mengembalikan stok?</strong>
                                 <div class="konfirmasi">
                                     <label><input required type="radio" name="kembalikan_stok" value="ya"> Ya</label>
                                     <label><input required type="radio" name="kembalikan_stok" value="tidak">
                                         Tidak</label>
                                 </div>
                                 <input type="hidden" name="batch_id" id="batch_id">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary">
                         Delete
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
$(document).ready(function() {
    // Saat modal 'deleteModal' ditampilkan
    $('#deleteModal').on('show.bs.modal', function(event) {
        // Ambil data dari tombol yang memicu modal
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var batchId = button.data('batch_id');

        // Isi input form 'batch_id' dengan data yang diambil
        $('#deleteModal input[name="batch_id"]').val(batchId);
    });
});
 </script>


 <!-- Modal Generate -->
 <div class="modal fade" id="generateSerahTerima" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangkeluar/generate_serah_terima');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Generate </span>
                         <span class="fw-light"> Serah Terima </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal Serah Terima <small class="text-danger">*</small></label></label>
                                 <input required type="date" class="form-control" name="tanggal_serah_terima" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Nama Pihak Pertama <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nama_pihak_pertama" class="form-control"
                                     placeholder="Nama Pihak Pertama" name="nama_pihak_pertama" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jabatan Pihak Pertama <small class="text-danger">*</small></label></label>
                                 <input required type="text" class="form-control" placeholder="Jabatan Pihak Pertama"
                                     name="jabatan_pihak_pertama" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Nama Pihak Kedua <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nama_pihak_kedua" class="form-control"
                                     placeholder="Nama Pihak Kedua" name="nama_pihak_kedua" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Alamat Pihak Kedua <small class="text-danger">*</small></label></label>
                                 <textarea name="alamat_pihak_kedua" id="alamat_pihak_kedua" required
                                     class="form-control"></textarea>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Nama Desa <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nama_desa" class="form-control" placeholder="Nama Desa"
                                     name="nama_desa" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Nama Kepala Desa <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nama_kades" class="form-control"
                                     placeholder="Nama Kepala Desa" name="nama_kades" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Nama Kepala Pelaksana <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="kepala_pelaksana" class="form-control"
                                     placeholder="Nama Kepala Pelaksana" name="kepala_pelaksana" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jabatan Pelaksana <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="jabatan_pelaksana" class="form-control"
                                     placeholder="Jabatan Pelaksana" name="jabatan_pelaksana" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>NIP Pelaksana <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nip_pelaksana" class="form-control"
                                     placeholder="NIP Pelaksana" name="nip_pelaksana" />
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="batch_id" id="batch_id_generate">
                     <button type="submit" class="btn btn-primary">
                         Generate
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
$(document).ready(function() {
    // Saat modal 'generateSerahTerima' ditampilkan
    $('#generateSerahTerima').on('show.bs.modal', function(event) {
        // Ambil data dari tombol yang memicu modal
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var batchId = button.data('batch_id');

        // Isi input form 'batch_id' dengan data yang diambil
        $('#generateSerahTerima input[id="batch_id_generate"]').val(batchId);
    });
});
 </script>