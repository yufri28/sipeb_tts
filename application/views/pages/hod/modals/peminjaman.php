 <!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('hodaccess/add');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Add</span>
                         <span class="fw-light"> Peminjaman </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
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
                                 <label>Nama Penanggung Jawab <small class="text-danger">*</small></label></label>
                                 <input required type="text" id="nama_penanggungjawab" class="form-control"
                                     placeholder="Nama Penanggung Jawab" name="nama_penanggungjawab" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>No HP Penanggung Jawab <small class="text-danger">*</small></label></label>
                                 <input required type="number" id="no_hp" class="form-control"
                                     placeholder="No HP Penanggung Jawab" name="no_hp" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Alamat Penggunaan Barang <small class="text-danger">*</small></label></label>
                                 <textarea required name="alamat" class="form-control" id="alamat"></textarea>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Keperluan <small class="text-danger">*</small></label></label>
                                 <textarea required name="keperluan" class="form-control" id="keperluan"></textarea>
                             </div>
                         </div>
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

 <?php foreach ($barang_pinjam as $key => $value) :?>
 <!-- Modal Detail -->
 <div class="modal fade" id="detailModal<?=$value['batch_id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header border-0">
                 <h5 class="modal-title">
                     <span class="fw-mediumbold"> Detail</span>
                     <span class="fw-light"> Peminjaman </span>
                 </h5>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="table-responsive">
                             <table id="no-filter-select" class="display nowrap table table-striped table-hover">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Jenis Barang</th>
                                         <th>Jumlah Barang</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $i = 1;?>
                                     <?php foreach ($barang_pinjam as $key => $barang) :?>
                                     <?php if($value['batch_id'] == $barang['batch_id']):?>
                                     <tr>
                                         <td><?=$i++;?>.</td>
                                         <td><?=$barang['nama_jenisbarang'];?></td>
                                         <td><?=$barang['jumlah'];?></td>
                                     </tr>
                                     <?php endif;?>
                                     <?php endforeach;?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer border-0">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                     Close
                 </button>
             </div>
         </div>
     </div>
 </div>
 <?php endforeach;?>


 <!-- Modal Terima -->
 <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('hodaccess/konfirmasi_peminjaman');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Terima</span>
                         <span class="fw-light"> Peminjaman </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <p>Terima peminjaman <strong id="nama"></strong> pada tanggal <strong
                                         id="tanggal"></strong>?</p>
                                 <small><i>Masukkan pesan jika ada yang ingin disampaikan kepada
                                         peminjam!</i></small>
                                 <div class="col-sm-12">
                                     <div class="form-group form-group-default">
                                         <label>Pesan <small class="text-danger">*</small></label></label>
                                         <textarea required name="pesan" class="form-control" id="pesan"></textarea>
                                     </div>
                                 </div>
                                 <input type="hidden" name="status" value="terima">
                                 <input type="hidden" name="batch_id" id="batch_id">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary">
                         Terima
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
    // Saat modal 'accModal' ditampilkan
    $('#accModal').on('show.bs.modal', function(event) {
        // Ambil data dari tombol yang memicu modal
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var batchId = button.data('batch_id');
        var nama = button.data('nama');
        var tanggal = button.data('tanggal');

        // Isi input form 'batch_id' dengan data yang diambil
        $('#accModal input[name="batch_id"]').val(batchId);
        $('#accModal strong[id="nama"]').text(nama);
        $('#accModal strong[id="tanggal"]').text(tanggal);
    });
});
 </script>


 <!-- Modal Tolak -->
 <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('hodaccess/konfirmasi_peminjaman');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Tolak</span>
                         <span class="fw-light"> Peminjaman </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <p>Tolak peminjaman <strong id="nama"></strong> pada tanggal <strong
                                         id="tanggal"></strong>?</p>
                                 <small><i>Masukkan alasan ditolak!</i></small>
                                 <div class="col-sm-12">
                                     <div class="form-group form-group-default">
                                         <label>Alasan <small class="text-danger">*</small></label></label>
                                         <textarea required name="pesan" class="form-control" id="pesan"></textarea>
                                     </div>
                                 </div>
                                 <input type="hidden" name="status" value="tolak">
                                 <input type="hidden" name="batch_id" id="batch_id">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary">
                         Tolak
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
    // Saat modal 'rejectModal' ditampilkan
    $('#rejectModal').on('show.bs.modal', function(event) {
        // Ambil data dari tombol yang memicu modal
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var batchId = button.data('batch_id');
        var nama = button.data('nama');
        var tanggal = button.data('tanggal');

        // Isi input form 'batch_id' dengan data yang diambil
        $('#rejectModal input[name="batch_id"]').val(batchId);
        $('#rejectModal strong[id="nama"]').text(nama);
        $('#rejectModal strong[id="tanggal"]').text(tanggal);
    });
});
 </script>