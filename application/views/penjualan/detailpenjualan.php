<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Detail Data Penjualan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Penjualan</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid" style="padding-bottom: 70px;">
         <form action="<?php echo base_url() . 'penjualan/updatepenjualan'; ?> " enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="shadow card">
                           <div class="col-md-3">
                              <h4 style="margin-top: 10px;margin-bottom: 0px;padding-bottom: 0px;margin-left: 7px;">Header Penjualan</h4>
                           </div>
                           <div class="card-body">
                              <?php foreach ($headerpenjualan as $hp) ?>
                              <div class="row">

                                 <input style="padding-bottom: 10px;" type="hidden" name="id" class="form-control">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating"><?php echo $this->lang->line('number'); ?> penjualan</label>
                                       <input style="padding-bottom: 10px;" type="text" id="nomor" name="nomor" class="form-control" readonly value="<?= $hp->nomorpenjualan ?>">

                                       <input style="padding-bottom: 10px;" type="hidden" name="id_headerpenjualan" id="id_headerpenjualan" class="form-control" readonly value="<?= $hp->id_headerpenjualan ?>">

                                    </div>
                                 </div>
                                 <!-- <div class="col-md-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating"><?php echo $this->lang->line('supplierinvoice'); ?></label>
                                       <input style="padding-bottom: 10px;" type="text" value="<?= $hp->faktursupplier ?>" name="faktursupplier" class="form-control">

                                    </div>
                                 </div> -->
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Nomor PO</label>
                                       <input style="padding-bottom: 10px;" readonly type="text" value="<?= $hp->nomorpo ?>" name="nomorpo" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Tanggal Invoice</label>
                                       <input style="padding-bottom: 10px;" type="date" value="<?= $hp->tanggalpenjualan ?>" readonly name="tanggaltransaksi" id="tanggaltransaksi" class="form-control">
                                    </div>
                                 </div>

                              </div>
                              <div class="row">
                                 <div class="col-md-3">
                                    <label>Agen</label>
                                    <div class="input-group">

                                       <input style="padding-bottom: 10px; " readonly type="text" value="<?= $hp->nama_agen ?>" name="namaagen" class="form-control">
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Terms Of Payment</label>
                                       <input style="padding-bottom: 10px;text-align: right;" step="any" type="text" readonly value="<?= $hp->termsofpayment ?>" id="termsofpayment" name="termsofpayment" class="js-nilai form-control">

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div><br>
                  <?= $this->session->flashdata('message'); ?>
                  <div class="row">

                     <div class="col-md-12">
                        <div class="shadow card">
                           <div class="row">
                              <div class="col-md-3">
                                 <h4 style="margin-top: 10px;margin-bottom: 0px;padding-bottom: 0px;margin-left: 7px;">Detail Penjualan</h4>
                              </div>

                           </div>

                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="card">
                                       <div class="card-body">
                                          <div class="row">
                                             <div class="col-md-6">
                                             </div>
                                          </div>
                                          <div class="row">
                                             <form action="<?php echo base_url() . 'penjualan'; ?> "></form>
                                             <div class="col-md-12">

                                                <div class="table-responsive">
                                                   <div id="tampilkepala"></div>

                                                   <table class="table table-hover" width="100%" cellspacing="0" id="tabledetailpenjualan">
                                                      <thead id="theaddetailkepala">
                                                         <tr height="20px">

                                                            <th style="width: 700px;">Nama Barang</th>
                                                            <th style="width: 100px">Jumlah</th>
                                                            <th style="width: 150px">Harga</th>
                                                            <th style="width: 150px">Total Harga</th>
                                                            <th style="width: 50px"><?php echo $this->lang->line('pengaturan'); ?></th>

                                                         </tr>
                                                      </thead>
                                                      <!-- <tbody id="tabledetailpurchaseedit"></tbody> -->
                                                      <tbody id="datapenjualan">
                                                         <?php
                                                         foreach ($detailpenjualan as $datas) {
                                                         ?>
                                                            <tr id="detailpenjualan<?= $datas->id_detailpenjualan ?>">
                                                               <td style="width: 700px;">
                                                                  <div class="input-group">
                                                                     <input readonly style="padding-bottom: 10px;width: 10px;" value='<?= $datas->namabarang ?>' type="text" name="namabarang" class="form-control">
                                                                  </div>
                                                               </td>
                                                               <td style="width: 100px">
                                                                  <input type="hidden" name="iddetailpenjualan" value="<?= $datas->id_detailpenjualan ?>">
                                                                  <input readonly type="number" step="any" style="text-align: right;" onkeyup="hitungtotalhargabarangjs()" name="jumlah" value="<?= number_format($datas->jumlah, 0, ',', '.') ?>" class="js-nilai form-control">
                                                               </td>

                                                               <td style="width: 150px">
                                                                  <input type="text" readonly style="text-align: right;" name="hargaproduk" value="<?= number_format($datas->harga, 0, ',', '.') ?>" onkeyup="hitungtotalhargabarangjs()" class="js-nilai form-control">
                                                               </td>
                                                               <td style="width: 150px">
                                                                  <input type="text" style="text-align: right;" name="totalhargabarang" value="<?= number_format($datas->jumlahharga, 0, ',', '.') ?>" readonly class="js-nilai form-control">
                                                               </td>
                                                               <td style="width: 50px;">
                                                               </td>
                                                            </tr>
                                                         <?php
                                                         }
                                                         ?>
                                                         <tr>
                                                            <td></td>
                                                            <td>Discount
                                                            </td>
                                                            <td style="width: 200px;">
                                                               <div class="input-group"><input type="text" style="text-align: right;max-width:75px; " name="diskonpersenheader" readonly value="<?= $hp->discountpersen ?>" id="diskonpersenheader" class="js-nilai form-control"><input type="text" style="text-align: right;max-width:50px" readonly value="%" name="simbolpersen" class="js-nilai form-control"></div>
                                                            </td>
                                                            <td style="width: 200px">
                                                               <input type="text" style="text-align: right;" name="diskonnilaiheader" readonly value="<?= number_format($hp->discountnilai, 0, ',', '.') ?>" id="diskonnilaiheader" class="js-nilai form-control">
                                                            </td>
                                                            <td></td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Grand Total</td>
                                                            <td></td>
                                                            <td style="width: 200px"> <input type="text" value="<?= number_format($datas->jumlahpenjualan, 0, ',', '.') ?>" required style="text-align: right;" name="grandtotal" readonly id="grandtotal" class="js-nilai form-control"></td>
                                                            <td></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>



                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <br><br>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div><br> <a href="<?= base_url('listpenjualan') ?>" class="btn btn-danger">Kembali</a>
               </div>
            </div>
         </form>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- Function Javascript -->


<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>vendor/jquery-ui/jquery-ui.min.js"></script>