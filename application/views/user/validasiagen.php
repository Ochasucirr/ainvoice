<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-900 text-end"><?= $title ?></h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content" style="padding-bottom: 60px;">
      <div class="container-fluid mb-3">
         <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
               <div>
                  <div class="shadow card">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table" style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="tableagen">
                              <thead>
                                 <th>Tanggal Gabung</th>
                                 <th>Nama Agen</th>
                                 <th>No Telephone</th>
                                 <th>Alamat Agen</th>
                              </thead>
                              <tbody>
                                 <?php foreach ($read as $data) { ?>
                                    <tr id="salesstore<?= $data->id_import ?>">
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="tanggalgabung" type="date" value="<?= $data->tanggalgabung ?>">
                                          <input style="max-width:200px" class="form-control" name="idimport" type="hidden" value="<?= $data->id_import ?>">
                                          <input style="max-width:200px" class="form-control" name="tanggalimport" type="hidden" value="<?= $data->tanggalimport ?>">
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="namaagen" type="text" value="<?= $data->nama_agen ?>">
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="notelephone" type="text" value="<?= $data->no_telephone ?>">
                                       </td>
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="alamatagen" type="text" value="<?= $data->alamat_agen ?>">
                                       </td>
                                    </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                           <a type="btn" onclick="updateagen()" class="btn btn-success float-left" style=" margin-top:15px;margin-right:10px" role="button" title="Simpan"> Simpan </a><a href="<?= base_url('user/dataagenbaru'); ?>" style=" margin-top:15px;margin-right:10px" class="btn btn-danger" role="button" title="Kembali">
                              Kembali
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- row selesai -->
         </div>
         <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
</div>
<!--- Function JavaScript -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>

<script>
   $(document).ready(function() {
      $('#tableagen').DataTable({
         lengthMenu: [
            [500, 100, 50, 25, 10],
            [500, 100, 50, 25, 10],
         ]
      });
   });
</script>
<script type="text/javascript">
   function updateagen() {
      $('table#tableagen').each(function(index, table) {
         // Dapatkan data tabel

         var tblagen = [];
         // console.log(a)
         $(table).find('tbody tr').each(function(row, tr) {
            tblagen[row] = {
               'idimport': $(tr).find('input[name="idimport"]').val(),
               'tanggalgabung': $(tr).find('input[name="tanggalgabung"]').val(),
               'tanggalimport': $(tr).find('input[name="tanggalimport"]').val(),
               'namaagen': $(tr).find('input[name="namaagen"]').val(),
               'notelephone': $(tr).find('input[name="notelephone"]').val(),
               'alamatagen': $(tr).find('input[name="alamatagen"]').val(),
            };

            // console.log(tblagen)

         });


         var dataagen = JSON.stringify(tblagen);
         // console.log(dataagen)

         // Kirim data ke server menggunakan AJAX
         $.ajax({
            url: "<?= base_url() ?>user/updateimportagen",
            type: 'post',
            data: {
               tblagen: dataagen,
               //jumlahdetailpembelian: jumlah
            },
            success: function(response) {
               var url = "<?php echo base_url('user/dataagenbaru'); ?>";
               window.location.href = url;
            },
            error: function(response) {
               alert('Terjadi kesalahan saat menyimpan data.');
            }
         });
      });
   }
</script>
<!--- End Function JavaScript -->