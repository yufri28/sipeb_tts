 <!-- Modal Edit -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('databencana/update');?>" method="post" enctype="multipart/form-data">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold">Edit</span>
                         <span class="fw-light">Data Bencana</span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Bencana <small class="text-danger">*</small></label>
                                 <select required name="jenis_bencana_id" class="form-control">
                                     <option value="">-- Pilih Jenis Bencana --</option>
                                     <?php foreach ($jenis_bencana as $key => $value):?>
                                     <option value="<?=$value['id_jenis_bencana'];?>">
                                         <?=$value['nama_bencana'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal <small class="text-danger">*</small></label>
                                 <input required type="date" class="form-control" placeholder="Tanggal"
                                     name="tanggal" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Lokasi <small class="text-danger">*</small></label>
                                 <textarea required class="form-control" name="lokasi"></textarea>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Bukti Lap. Pusdolops</label>
                                 <input type="file" accept=".jpg,.jpeg,.png,.docx,.doc,.pdf" id="bukti_lap_pusdolops"
                                     class="form-control" name="bukti_lap_pusdolops" />
                                 <small><i>Bukti Lap. Pusdolops boleh dikosongkan jika tidak ingin mengubah
                                         file.</i></small>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>SK Tanggap Darurat</label>
                                 <input type="file" accept=".jpg,.jpeg,.png,.docx,.doc,.pdf" id="sk_tanggap_darurat"
                                     class="form-control" name="sk_tanggap_darurat" />
                                 <small><i>SK Tanggap Darurat boleh dikosongkan jika tidak ingin mengubah
                                         file.</i></small>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="id_bencana" id="id_bencana">
                     <button type="submit" class="btn btn-primary">
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
// Function to populate form when modal is shown
document.getElementById('editModal').addEventListener('shown.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract info from data-* attributes (you can pass data from the button or other sources)
    var idBencana = button.getAttribute('data-id_bencana');
    var jenisBencanaId = button.getAttribute('data-jenis_bencana_id');
    var tanggal = button.getAttribute('data-tanggal');
    var lokasi = button.getAttribute('data-lokasi');

    // Get the form inside the modal
    var modal = document.getElementById('editModal');

    // Update form fields
    modal.querySelector('select[name="jenis_bencana_id"]').value = jenisBencanaId;
    modal.querySelector('input[id="id_bencana"]').value = idBencana;
    modal.querySelector('input[name="tanggal"]').value = tanggal;
    modal.querySelector('textarea[name="lokasi"]').value = lokasi;
});
 </script>

 <!-- Modal Delete -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('databencana/delete');?>" method="post">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold">Hapus</span>
                         <span class="fw-light">Data Bencana</span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <p>Anda ingin menghapus data bencana <strong id="nama_bencana"></strong> pada tanggal
                                     <strong id="tanggal"></strong> ?
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer border-0">
                     <input type="hidden" name="id_bencana" id="id_bencana_delete">
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
// Function to populate form when modal is shown
document.getElementById('deleteModal').addEventListener('shown.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract info from data-* attributes (you can pass data from the button or other sources)
    var idBencana = button.getAttribute('data-id_bencana');
    var jenisBencana = button.getAttribute('data-jenis_bencana');
    var tanggal = button.getAttribute('data-tanggal');

    // Get the form inside the modal
    var modal = document.getElementById('deleteModal');
    console.log(modal)
    // Update form fields
    modal.querySelector('strong[id="nama_bencana"]').textContent = jenisBencana;
    modal.querySelector('input[id="id_bencana_delete"]').value = idBencana;
    modal.querySelector('strong[id="tanggal"]').textContent = tanggal;
});
 </script>

 <!-- Modal Add -->
 <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="<?=base_url('databencana/add');?>" method="post" enctype="multipart/form-data">
                 <div class="modal-header border-0">
                     <h5 class="modal-title">
                         <span class="fw-mediumbold"> Add</span>
                         <span class="fw-light"> Data Bencana </span>
                     </h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Jenis Bencana <small class="text-danger">*</small></label>
                                 <select required name="jenis_bencana_id" class="form-control">
                                     <option value="">-- Pilih Jenis Bencana --</option>
                                     <?php foreach ($jenis_bencana as $key => $value):?>
                                     <option value="<?=$value['id_jenis_bencana'];?>">
                                         <?=$value['nama_bencana'];?></option>
                                     <?php endforeach;?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Tanggal <small class="text-danger">*</small></label></label>
                                 <input required type="date" class="form-control" placeholder="Tanggal"
                                     name="tanggal" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Lokasi <small class="text-danger">*</small></label>
                                 <textarea required class="form-control" name="lokasi"></textarea>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>Bukti Lap. Pusdolops <small class="text-danger">*</small></label></label>
                                 <input required type="file" accept=".jpg,.jpeg,.png,.docx,.doc,.pdf"
                                     id="bukti_lap_pusdolops" class="form-control" name="bukti_lap_pusdolops" />
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group form-group-default">
                                 <label>SK Tanggap Darurat <small class="text-danger">*</small></label></label>
                                 <input required type="file" accept=".jpg,.jpeg,.png,.docx,.doc,.pdf"
                                     id="sk_tanggap_darurat" class="form-control" name="sk_tanggap_darurat" />
                             </div>
                         </div>

                     </div>
                     <div class="modal-footer border-0">
                         <button type="submit" class="btn btn-primary">
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