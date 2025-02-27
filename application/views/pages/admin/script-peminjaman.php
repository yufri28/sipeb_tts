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

        // Jika jumlah inputan tidak sesuai dengan pilihan jenis barang
        if (jumlahValues.length !== selectedOptions.length) {
            errorMessage = 'Jumlah barang harus sesuai dengan jumlah barang yang dipilih!';
        } else {
            // Validasi setiap jumlah terhadap stok dan memastikan tidak ada angka 0
            selectedOptions.forEach((option, index) => {
                const stok = parseInt(option.getAttribute('data-stok')) || 0;
                const jumlah = jumlahValues[index] || 0;

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
    $('#id_kondisi_terkini').select2({
        placeholder: "-- Pilih Jenis Barang --",
        allowClear: true,
        width: '100%',
        closeOnSelect: false // Membiarkan dropdown tetap terbuka untuk pilihan multiple
    });

    // Reset pilihan saat halaman dimuat untuk memastikan tidak ada pilihan otomatis
    $('#id_kondisi_terkini').val([]).trigger('change');
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