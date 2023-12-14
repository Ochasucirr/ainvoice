<div class="container-fluid">
   <div class="row">
      <div class="col-12" id="data">
         <div class="shadow card">

            <!-- /.card-header -->
            <div class="card-body">
               <div class="table-responsive">
                  <table id="dataTable" style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" class="table table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                     <thead style="text-transform: uppercase;">
                        <tr height="20px">
                           <th style="vertical-align: top;text-align: center;" width="5%">
                              Nomor Invoice
                           </th>
                           <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Info penjualan</th>
                           <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Rincian</th>
                           <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 1;
                        foreach ($read as $data) {
                        ?>
                           <tr id="penjualan<?= $data->id_headerpenjualan ?>">
                              <td style="vertical-align: top;" width="5%">
                                 <p style="margin-bottom: 5px;font-size: 18px;margin-top: 5px;">
                                    <font style="color:black"> <?= $data->nomorpenjualan ?>
                                    </font>
                                 <p style="margin-bottom: 5px;font-size: 18px;margin-top: 5px;">Tanggal : <font style="color:black"><?= $data->tanggalpenjualan ?>
                                    </font>
                                 <p style="margin-bottom: 5px;font-size: 18px;margin-top: 5px;">Terms Of Payment : <font style="color:black"><?= $data->termsofpayment ?> Hari
                                    </font>
                              </td>
                              <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="2%">

                                 <p style="margin-bottom: 5px;font-size: 18px;margin-top: 5px;">Nomor PO : <font style="color:black"><?= $data->nomorpo ?></font>
                                 </p>
                                 <p style="margin-bottom: 5px;font-size: 18px;margin-top: 5px;">Agen: <b style="color:black"><?= $data->nama_agen ?></b></p>

                              </td>

                              <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="5%">


                                 <div class="input-group">
                                    <font size="4px" style="color: black;">Discount</font>
                                    <input style="text-align:right;max-width: 50px;margin-left:15px;height: 25px;padding:0px;background: transparent; border: none;" type="text" readonly value="<?php echo number_format($data->discountpersen, 0, ',', '.') ?> %" name="discountpersen" class="js-nilai form-control">

                                    <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="hidden" value="<?php echo number_format($data->discountnilai, 0, ',', '.') ?>" name="discountnilai" class="js-nilai form-control">
                                    <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="text" value="<?php echo number_format($data->discountnilai, 0, ',', '.') ?>" name="discountnilai" class="js-nilai form-control">
                                 </div>

                                 <!-- <div class="input-group">
                                          <font size="4px" style="color: black; ">Biaya</font>
                                          <input style="text-align:right;max-width: 50px;margin-right:5px;height: 25px;padding:0px;background: transparent; border: none;" type="text" readonly value="" name="kosong " class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;max-width: 20px;margin-left:60px;height: 25px;" readonly type="text" value="<?= $data->symbol ?>" name="satuan" class="form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="hidden" value="<?php echo number_format($data->biaya, 0, ',', '.') ?>" name="biaya" class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="text" value="<?php echo number_format($data->biaya, 0, ',', '.') ?>" name="biaya" class="js-nilai form-control">
                                       </div> -->

                                 <!-- <div class="input-group">
                                          <font size="4px" style="color: black;">DP</font>
                                          <input style="text-align:right;max-width: 50px;margin-right:5px;height: 25px;padding:0px;background: transparent; border: none;" type="text" readonly value="" name="kosong " class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;max-width: 20px;margin-left:80px;height: 25px" readonly type="text" value="<?= $data->symbol ?>" name="satuan" class="form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="hidden" value="<?php echo number_format($data->dibayardimuka, 0, ',', '.') ?>" name="dibayardimuka" class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="text" value="<?php echo number_format($data->dibayardimuka, 0, ',', '.') ?>" name="dibayardimuka" class="js-nilai form-control">
                                       </div> -->

                                 <!-- <div class="input-group">
                                          <font size="4px" style="color: black;">Pajak</font>
                                          <input style="text-align:right;max-width: 50px;margin-right:5px;margin-left:43px;height: 25px;padding:0px;background: transparent; border: none;" type="text" readonly value="<?php echo number_format($data->pajakpersen, 0, ',', '.') ?> %" name="pajakpersen " class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;max-width: 20px;margin-left:17px;height: 25px" readonly type="text" value="<?= $data->symbol ?>" name="satuan" class="form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right" type="hidden" value="<?php echo number_format($data->pajaknilai, 0, ',', '.') ?>" name="pajaknilai" class="js-nilai form-control">
                                          <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="text" value="<?php echo number_format($data->pajaknilai, 0, ',', '.') ?>" name="pajaknilai" class="js-nilai form-control">
                                       </div> -->
                                 <div class="input-group">
                                    <font size="4px" style="color: black">Total</font>
                                    <input style="text-align:right;max-width: 50px;margin-right:5px;height: 25px;padding:0px;background: transparent; border: none;" type="text" readonly value="" name="kosong " class="js-nilai form-control">
                                    <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="hidden" value="<?php echo number_format($data->jumlahpenjualan, 0, ',', '.') ?>" name="jumlahpenjualan" class="js-nilai form-control">
                                    <input style="padding:0px;background: transparent; border: none;text-align:right;height: 25px" type="text" value="<?php echo number_format($data->jumlahpenjualan, 0, ',', '.') ?>" name="jumlahpenjualan" class="js-nilai form-control">
                                 </div>
                              </td>
                              <td style="vertical-align: top;border-top: 1px solid #e3e6f0;text-align:left" width="1%">
                                 <a href="<?= base_url('detaildatapenjualan/' . $data->id_headerpenjualan); ?>" class="btn btn-sm" style="margin-bottom: 10px;width: 100px;background: transparent; border-color: #858796;color:black;" role="button" title="Detail Detail Model"> <i class="fas fa-fw fa-search"></i> Detail </a><br>
                                 <a href="#" data-toggle="modal" data-target="#modaledit" id="<?= $data->id_headerpenjualan ?>|" style="margin-bottom: 10px;width: 100px;background: transparent; border-color: #858796;color:black;" class="editpenjualan btn btn-sm" role="button" title="Ubah Detail Model"> <i class="fas fa-fw fa-pencil-alt"></i> Ubah </a><br>
                                 <a href="#" data-toggle="modal" data-target="#modalhapus" id="<?= $data->id_headerpenjualan ?>|<?= $data->nomorpenjualan ?>" title="Hapus" class="hapusdetailpenjualan btn btn-sm" style="margin-bottom: 10px;width: 100px;background: transparent; border-color: #858796;color:black;" role="button" title="Hapus"> <i class="fas fa-fw fa-trash"></i> Hapus </a><br>
                                 <a href="<?= base_url('cetakinvoice/' . $data->id_headerpenjualan); ?>" target="_blank" style="margin-bottom: 10px;width: 100px;color:black;background: transparent; border-color: #858796;" class="btn btn-sm  mr-1" role="button" title="Cetak"><i class="fas fa-fw fa-print"></i> Cetak </a>
                              </td>
                           </tr>
                        <?php
                           $no++;
                        }
                        ?>
                     </tbody>
                  </table>
               </div>

            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->

      </div>
   </div>
</div>

<!-- Function Javascript -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>vendor/jquery-ui/jquery-ui.min.js"></script>

<script>
   function resetfilterpenjualan() {
      $(document).on('click', '#btnresetfilterpenjualan', function(e) {
         e.preventDefault();

         $("#from").val("");
         $("#to").val("");
         filterdatapenjualan();
         $('#btnresetfilterpenjualan').hide();
      });

   }

   function filterdatapenjualan() {
      // let k = $(this).val();
      // console.log(k); 
      var from = $("#from").val();
      var to = $("#to").val();


      if (from == "" && to == "") {

         $('#btnresetfilterpenjualan').hide();
      } else {

         $('#btnresetfilterpenjualan').show();
      }

      $.ajax({
         url: "<?php echo base_url() . 'penjualan/filterpenjualan'; ?>",
         type: "post",
         data: {
            from: from,
            to: to,
         },
         success: function(data) {

            $('#tampil').html(data);
            $('#penjualan').hide();
         }
      });
   }
   $('.editpenjualan').on("click", function() {
      // ambil nilai id dari link print
      var DataJadwal = this.id;
      var datanya = DataJadwal.split("|");
      $("#isimodaleditpenjualan").html('<input style="padding-bottom: 10px;" type="hidden" name="idheaderpenjualan" class="form-control" value=' + datanya[0] + '>Apakah anda yakin ingin mengubah data ini ?');
   });
   $('.hapusdetailpenjualan').on("click", function() {
      // ambil nilai id dari link print
      var DataJadwal = this.id;
      var datanya = DataJadwal.split("|");
      $("#isimodalhapuspenjualan").html('<input style="padding-bottom: 10px;" type="hidden" name="id_headerpenjualan" class="form-control" value=' + datanya[0] + '><input style="padding-bottom: 10px;" type="hidden" name="nomorpenjualan" class="form-control" value=' + datanya[1] + '>Apakah anda ingin menghapus data ini?');
   });
</script>
<!-- End Function Javascript -->