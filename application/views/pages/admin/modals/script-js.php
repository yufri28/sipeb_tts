<script>
document.addEventListener("DOMContentLoaded", function() {

    // ========================== Jenis Barang =====================
    // Event listener for the edit button
    const editJenisBarang = document.querySelector('#editJenisBarang');
    const hapusJenisBarang = document.querySelector('#hapusJenisBarang');
    // Button that triggered the modal
    editJenisBarang.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idJenisBarang = button.getAttribute('data-id');
        const namaJenisBarang = button.getAttribute('data-nama');
        const ketJenisBarang = button.getAttribute('data-ket');

        // Set values to the modal fields
        editJenisBarang.querySelector('#idJenisBarangEdit').value = idJenisBarang;
        editJenisBarang.querySelector('#namaJenisBarangEdit').value = namaJenisBarang;
        editJenisBarang.querySelector('#ketJenisBarangEdit').value = ketJenisBarang;

    });

    hapusJenisBarang.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idJenisBarang = button.getAttribute('data-id');
        const namaJenisBarang = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusJenisBarang.querySelector('#jenis_barang').textContent = namaJenisBarang;
        hapusJenisBarang.querySelector('#idJenisBarangHapus').value = idJenisBarang;
    });

    // =============== Klasifikasi ======================
    // Event listener for the edit button
    const editKlasifikasi = document.querySelector('#editKlasifikasi');
    const hapusKlasifikasi = document.querySelector('#hapusKlasifikasi');
    // Button that triggered the modal
    editKlasifikasi.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idKlasifikasi = button.getAttribute('data-id');
        const namaKlasifikasi = button.getAttribute('data-nama');
        const ketKlasifikasi = button.getAttribute('data-ket-kl');

        // Set values to the modal fields
        editKlasifikasi.querySelector('#idKlasifikasiEdit').value = idKlasifikasi;
        editKlasifikasi.querySelector('#namaKlasifikasiEdit').value = namaKlasifikasi;
        editKlasifikasi.querySelector('#ketKlasifikasiEdit').value = ketKlasifikasi;

    });

    hapusKlasifikasi.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idKlasifikasi = button.getAttribute('data-id');
        const namaKlasifikasi = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusKlasifikasi.querySelector('#nama_klasifikasi').textContent = namaKlasifikasi;
        hapusKlasifikasi.querySelector('#idKlasifikasiHapus').value = idKlasifikasi;
    });


    // ==========================  Satuan ===============
    const editSatuan = document.querySelector('#editSatuan');
    const hapusSatuan = document.querySelector('#hapusSatuan');
    // Button that triggered the modal
    editSatuan.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idSatuan = button.getAttribute('data-id');
        const namaSatuan = button.getAttribute('data-nama');

        // Set values to the modal fields
        editSatuan.querySelector('#idSatuanEdit').value = idSatuan;
        editSatuan.querySelector('#namaSatuanEdit').value = namaSatuan;

    });

    hapusSatuan.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idSatuan = button.getAttribute('data-id');
        const namaSatuan = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusSatuan.querySelector('#nama_satuan').textContent = namaSatuan;
        hapusSatuan.querySelector('#idSatuanHapus').value = idSatuan;
    });

    // ==========================  Sumber ===============
    const editSumber = document.querySelector('#editSumber');
    const hapusSumber = document.querySelector('#hapusSumber');
    // Button that triggered the modal
    editSumber.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idSumber = button.getAttribute('data-id');
        const namaSumber = button.getAttribute('data-nama');

        // Set values to the modal fields
        editSumber.querySelector('#idSumberEdit').value = idSumber;
        editSumber.querySelector('#namaSumberEdit').value = namaSumber;

    });

    hapusSumber.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idSumber = button.getAttribute('data-id');
        const namaSumber = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusSumber.querySelector('#nama_sumber').textContent = namaSumber;
        hapusSumber.querySelector('#idSumberHapus').value = idSumber;
    });

    // ==========================  Kondisi ===============
    const editKondisi = document.querySelector('#editKondisi');
    const hapusKondisi = document.querySelector('#hapusKondisi');
    // Button that triggered the modal
    editKondisi.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idKondisi = button.getAttribute('data-id');
        const namaKondisi = button.getAttribute('data-nama');

        // Set values to the modal fields
        editKondisi.querySelector('#idKondisiEdit').value = idKondisi;
        editKondisi.querySelector('#namaKondisiEdit').value = namaKondisi;

    });

    hapusKondisi.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idKondisi = button.getAttribute('data-id');
        const namaKondisi = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusKondisi.querySelector('#nama_kondisi').textContent = namaKondisi;
        hapusKondisi.querySelector('#idKondisiHapus').value = idKondisi;
    });

    // ========================== Jenis Bencana ===============
    const editJenisBencana = document.querySelector('#editJenisBencana');
    const hapusJenisBencana = document.querySelector('#hapusJenisBencana');
    // Button that triggered the modal
    editJenisBencana.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idJenisBencana = button.getAttribute('data-id');
        const namaJenisBencana = button.getAttribute('data-nama');

        // Set values to the modal fields
        editJenisBencana.querySelector('#idJenisBencanaEdit').value = idJenisBencana;
        editJenisBencana.querySelector('#namaJenisBencanaEdit').value = namaJenisBencana;

    });

    hapusJenisBencana.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Get data attributes from the clicked button
        const idJenisBencana = button.getAttribute('data-id');
        const namaJenisBencana = button.getAttribute('data-nama');

        // Set values to the modal fields
        hapusJenisBencana.querySelector('#jenis_bencana').textContent = namaJenisBencana;
        hapusJenisBencana.querySelector('#idJenisBencanaHapus').value = idJenisBencana;
    });

});
</script>