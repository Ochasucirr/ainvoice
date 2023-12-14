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
                           <table class="table" style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" id="tablepenjualan">
                              <thead>
                                 <th>Tanggal Order</th>
                                 <th>Nama Agen</th>
                                 <th>Nama Produk</th>
                                 <th>Jumlah Produk</th>
                                 <th>Harga Produk</th>
                              </thead>
                              <tbody>
                                 <?php foreach ($read as $data) { ?>
                                    <tr id="salesstore<?= $data->id_import ?>">
                                       <td>
                                          <input style="max-width:200px" required class="form-control" name="tanggalorder" type="date" value="<?= $data->tanggalorder ?>">
                                          <input style="max-width:200px" required class="form-control" name="tanggalimport" type="hidden" value="<?= $data->tanggalimport ?>">
                                          <input style="max-width:200px" class="form-control" name="idimport" type="hidden" value="<?= $data->id_import ?>">
                                       </td>
                                       <td>
                                          <select name="idagen" class="form-control" required>
                                             <option value=""></option>
                                             <?php foreach ($dataagen as $da) { ?>
                                                <option value="<?= $da->id ?>"><?= $da->nama_agen ?></option>
                                             <?php } ?>
                                          </select>
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="namaproduk" type="text" value="<?= $data->namaproduk ?>">
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="form-control" name="jumlahproduk" type="text" value="<?= $data->jumlahproduk ?>">
                                       </td>
                                       </td>
                                       <td>
                                          <input style="max-width:200px" class="js-nilai form-control" name="hargaproduk" type="text" value="<?= $data->hargaproduk ?>">
                                       </td>
                                    </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                           <a type="btn" onclick="updatepenjualan()" class="btn btn-success float-left" style=" margin-top:15px;margin-right:10px" role="button" title="Simpan"> Simpan </a><a href="<?= base_url('listpenjualan'); ?>" style=" margin-top:15px;margin-right:10px" class="btn btn-danger" role="button" title="Kembali">
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
      $('#tablepenjualan').DataTable({
         lengthMenu: [
            [500, 100, 50, 25, 10],
            [500, 100, 50, 25, 10],
         ]
      });
   });
</script>
<script type="text/javascript">
   function updatepenjualan() {
      $('table#tablepenjualan').each(function(index, table) {
         // Dapatkan data tabel

         var tblpenjualan = [];
         $(table).find('tbody tr').each(function(row, tr) {
            tblpenjualan[row] = {
               'idimport': $(tr).find('input[name="idimport"]').val(),
               'tanggalorder': $(tr).find('input[name="tanggalorder"]').val(),
               'tanggalimport': $(tr).find('input[name="tanggalimport"]').val(),
               'idagen': $(tr).find('select[name="idagen"]').val(),
               'namaproduk': $(tr).find('input[name="namaproduk"]').val(),
               'jumlahproduk': $(tr).find('input[name="jumlahproduk"]').val(),
               'hargaproduk': $(tr).find('input[name="hargaproduk"]').val(),
            };

            // console.log(tblpenjualan)

         });


         var datapenjualan = JSON.stringify(tblpenjualan);
         // console.log(datapenjualan)
         //Kirim data ke server menggunakan AJAX
         $.ajax({
            url: "<?= base_url() ?>penjualan/updateimportpenjualan",
            type: 'post',
            data: {
               tblpenjualan: datapenjualan,
               //jumlahdetailpembelian: jumlah
            },
            success: function(response) {
               var url = "<?php echo base_url('listpenjualan'); ?>";
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