 <!-- Modal Konfirmasi -->
 <div class="modal fade" id="konfirmasiSelesai" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('barangkeluar/konfirmasi_selesai');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold">Konfirmasi</span>
                         <span class="fw-light"></span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="text-center">
                                 <h5>Tandai selesai peminjaman ini?</h5>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="batch_id" id="batch_id">
                     <button type="submit" class="btn btn-primary">Yes</button>
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
    var konfirmasiSelesai = document.getElementById('konfirmasiSelesai');
    konfirmasiSelesai.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Tombol yang memicu modal
        var batchId = button.getAttribute('data-batch_id'); // Ambil data id_pinjam
        var modalbatchId = document.getElementById('batch_id');
        modalbatchId.value = batchId; // Set hidden input dengan id_pinjam
    });
});
 </script>