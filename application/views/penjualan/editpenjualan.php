<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Ubah Data Penjualan</h1>
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
                                       <input style="padding-bottom: 10px;" type="text" value="<?= $hp->nomorpo ?>" name="nomorpo" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Tanggal Invoice</label>
                                       <input style="padding-bottom: 10px;" type="date" value="<?= $hp->tanggalpenjualan ?>" required name="tanggaltransaksi" id="tanggaltransaksi" class="form-control">
                                       <?= form_error('tanggaltransaksi', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                 </div>

                              </div>
                              <div class="row">
                                 <div class="col-md-3">
                                    <label>Agen</label>
                                    <div class="input-group">

                                       <input style="padding-bottom: 10px; " id="namaagen" type="text" value="<?= $hp->nama_agen ?>" name="namaagen" class="form-control">

                                       <input style="padding-bottom: 10px;" id="idagen" type="hidden" value="<?= $hp->id_agen ?>" name="idagen" class="form-control" readonly>

                                       <span class="input-group-btn">
                                          <button style="margin-left: 3px;" type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalagen">Cari</button>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Terms Of Payment</label>
                                       <input style="padding-bottom: 10px;text-align: right;" step="any" type="text" value="<?= $hp->termsofpayment ?>" id="termsofpayment" name="termsofpayment" class="js-nilai form-control">
                                       <?= form_error('termsofpayment', '<small class="text-danger">', '</small>'); ?>
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
                                                <!--  <h4   class="m-0 font-weight-bold text-primary"> Konsep Kepala</h4> -->
                                             </div>
                                             <!-- <div class="col-md-6">
                                                <h6 style="text-align: right" class="m-0 font-weight-bold text-primary"> <a id="adddetailpurchase" class="text-info" style="text-decoration: none" class="btn btn-sm btn-danger mr-1" href="#"> <i class="fas fa-fw fa-plus text-info"></i> <?php echo $this->lang->line('add'); ?></h6></a><br>
                                             </div> -->
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
                                                                     <input style="padding-bottom: 10px;width: 10px;" value='<?= $datas->namabarang ?>' type="text" name="namabarang" class="form-control">
                                                                  </div>
                                                               </td>
                                                               <td style="width: 100px">
                                                                  <input type="hidden" readonly name="idheader" value="<?= $hp->id_headerpenjualan ?>" class="form-control">
                                                                  <input type="hidden" name="iddetailpenjualan" value="<?= $datas->id_detailpenjualan ?>">
                                                                  <input type="number" step="any" style="text-align: right;" onkeyup="hitungtotalhargabarangjs()" name="jumlah" value="<?= number_format($datas->jumlah, 0, ',', '.') ?>" class="js-nilai form-control">
                                                                  <input type="hidden" style="text-align: right;" name="jumlahawal" value="<?= number_format($datas->jumlah, 0, ',', '.') ?>" class="js-nilai form-control">
                                                               </td>

                                                               <td style="width: 150px">
                                                                  <input type="text" style="text-align: right;" name="hargaproduk" value="<?= number_format($datas->harga, 0, ',', '.') ?>" onkeyup="hitungtotalhargabarangjs()" class="js-nilai form-control">
                                                               </td>
                                                               <td style="width: 150px">
                                                                  <input type="text" style="text-align: right;" name="totalhargabarang" value="<?= number_format($datas->jumlahharga, 0, ',', '.') ?>" readonly class="js-nilai form-control">
                                                               </td>
                                                               <td style="width: 50px;"> <a href="#" id="hapusdetailpenjualan" data-nomor="<?= $datas->nomorpenjualan ?>" data-iddetailpenjualan="<?= $datas->id_detailpenjualan ?>" class="hapusdetailpenjualan btn btn-sm btn-danger" role="button" title="Hapus"> <i class="fas fa-fw fa-trash"></i> Hapus </a>
                                                               </td>
                                                            </tr>
                                                         <?php
                                                         }
                                                         ?>
                                                      </tbody>
                                                      <tfoot>
                                                         <tr id="addformdetailpurchase">
                                                            <td style="width: 700px;">
                                                               <div class="input-group">
                                                                  <input style="padding-bottom: 10px;width: 10px;" id="namabarang" type="text" name="namabarang" class="form-control">
                                                               </div>
                                                            </td>
                                                            <td style="width: 100px">
                                                               <input type="hidden" readonly name="idheader" id="idheader" value="<?= $hp->id_headerpenjualan ?>" class="form-control">
                                                               <input type="hidden" id="iddetailpenjualan" name="iddetailpenjualan" value="<?= $id_detailpenjualan ?>">
                                                               <input type="number" step="any" style="text-align: right;" onkeyup="hitungtotalhargabarang()" name="jumlah" id="jumlah" class=" form-control">
                                                            </td>
                                                            <td style="width: 150px">
                                                               <input type="hidden" style="text-align: right;" readonly name="hargaproduk" id="hargaproduk" class="form-control">
                                                               <input type="text" style="text-align: right;" name="hargaproduk_" onkeyup="hitungtotalhargabarang()" id="hargaproduk_" class="js-nilai form-control">
                                                            </td>
                                                            <td style="width: 150px">
                                                               <input type="text" style="text-align: right;" name="totalhargabarang" readonly id="totalhargabarang" class="js-nilai form-control">
                                                            </td>
                                                            <td style="width: 50px">
                                                               <button style="width: 80px;" type="button" class="btn btn-primary btn-sm" id="btntambahdetailtransaksi" onclick="adddetailpenjualan()"> Tambah</button>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Total</td>
                                                            <td></td>
                                                            <td style="width: 200px">
                                                               <?php foreach ($totalharga as $t)  ?>
                                                               <input type="text" style="text-align: right;" name="jumlahpenjualan" readonly id="jumlahpenjualan" value="<?php echo number_format($t->totalharga, 0, ',', '.') ?> " class="js-nilai form-control">
                                                               <!-- <input type="hidden" style="text-align: right;" name="jumlahpenjualan_" readonly id="jumlahpenjualanawal" value="<?= $t->totalharga ?> " class="js-nilai form-control"> -->
                                                            </td>
                                                            <td></td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Discount
                                                            </td>
                                                            <td style="width: 200px;">
                                                               <div class="input-group"><input type="text" style="text-align: right;max-width:75px; " name="diskonpersenheader" onkeyup="hitungheaderdiskonnilai()" value="<?= $hp->discountpersen ?>" id="diskonpersenheader" class="js-nilai form-control"><input type="text" style="text-align: right;max-width:50px" readonly value="%" name="simbol" class="js-nilai form-control"></div>
                                                            </td>
                                                            <td style="width: 200px"><input type="text" style="text-align: right;" onclick="autoblockdiskonnilaiheader()" onkeyup="hitunggrandtotal()" name="diskonnilaiheader" value="<?= number_format($hp->discountnilai, 0, ',', '.') ?>" id="diskonnilaiheader" class="js-nilai form-control"></td>
                                                            <td></td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Grand Total</td>
                                                            <td></td>
                                                            <td style="width: 200px"> <input type="text" value="<?= number_format($hp->jumlahpenjualan, 0, ',', '.') ?>" required style="text-align: right;" name="grandtotal" readonly id="grandtotal" class="js-nilai form-control"></td>
                                                            <td></td>
                                                         </tr>
                                                      </tfoot>

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

                  </div><br>
                  <button onclick="updatedetailpenjualan()" id="btnupdatedetailpenjualan" class="btn btn-info">Ubah</button> <a href="<?= base_url('listpenjualan') ?>" class="btn btn-danger">Kembali</a>
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

<script>
   $(document).ready(function() {
      // detailpurchase_edit();
      // totalhargapenjualan_edit();
   });

   $("select[id=tipepenjualan]").on("change", function() {
      if ($(this).val() == "Material") {
         $("button[id=diamond] ").hide();
         $("button[id=bahanbakupendukung] ").hide();
         $("button[id=material] ").show();
         $('#hargaproduk_').val("");
         $('#hargaproduk').val("");
         $('#jumlah').val("");
         $('#idbarang').val("");
         $('#namabarang').val("");
         $('#hargaproduk').val("");
         $('#butir').val("");
         $('#discountpersen').val("");
         $('#discountnilai').val("");
         $('#totalhargabarang').val("");

      } else if ($(this).val() == "Diamond") {

         $("button[id=diamond] ").show();
         $("button[id=bahanbaku] ").hide();
         $("button[id=material] ").hide();
         $('#hargaproduk_').val("");
         $('#hargaproduk').val("");
         $('#jumlah').val("");
         $('#idbarang').val("");
         $('#namabarang').val("");
         $('#hargaproduk').val("");
         $('#butir').val("");
         $('#discountpersen').val("");
         $('#discountnilai').val("");
         $('#totalhargabarang').val("");
      } else if ($(this).val() == "Bahan Baku Pendukung") {

         $("button[id=diamond] ").hide();
         $("button[id=bahanbaku] ").hide();
         $("button[id=bahanbakupendukung] ").show();
         $("button[id=material] ").hide();
         $("button[id=inventory] ").hide();
         $('#hargaproduk_').val("");
         $('#hargaproduk').val("");
         $('#jumlah').val("");
         $('#idbarang').val("");
         $('#namabarang').val("");
         $('#hargaproduk').val("");
         $('#butir').val("");
         $('#discountpersen').val("");
         $('#discountnilai').val("");
         $('#totalhargabarang').val("");
      } else if ($(this).val() == "Inventory") {

         $("button[id=diamond] ").hide();
         $("button[id=bahanbaku] ").hide();
         $("button[id=bahanbakupendukung] ").hide();
         $("button[id=inventory] ").show();
         $("button[id=material] ").hide();
         $('#hargaproduk_').val("");
         $('#hargaproduk').val("");
         $('#jumlah').val("");
         $('#idbarang').val("");
         $('#namabarang').val("");
         $('#hargaproduk').val("");
         $('#butir').val("");
         $('#discountpersen').val("");
         $('#discountnilai').val("");
         $('#totalhargabarang').val("");
      }
   });
   $("select[id=tipepenjualan]").trigger("change");

   $("#namaagen").autocomplete({
      source: function(request, response) {
         // Fetch data
         $.ajax({
            url: "<?= base_url() ?>penjualan/get_agen",
            type: 'post',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function(data) {
               response(data);
            }
         });
      },
      select: function(event, ui) {
         // Set selection
         $('#namaagen').val(ui.item.label); // display the selected text
         $('#idagen').val(ui.item.value); // display the selected text 
         return false;
      },
      focus: function(event, ui) {
         $('#namaagen').val(ui.item.label); // display the selected text
         $('#idagen').val(ui.item.value); // display the selected text 

         return false;
      },
   });

   function updatedetailpenjualan() {
      $('table#tabledetailpenjualan').each(function(index, table) {
         // Dapatkan data tabel

         var tbldetailpenjualan = [];
         // console.log(a)
         $(table).find('tbody tr').each(function(row, tr) {
            tbldetailpenjualan[row] = {
               'namabarang': $(tr).find('input[name="namabarang"]').val(),
               'jumlah': $(tr).find('input[name="jumlah"]').val(),
               'jumlahawal': $(tr).find('input[name="jumlahawal"]').val(),
               'hargaproduk': $(tr).find('input[name="hargaproduk"]').val(),
               'totalhargabarang': $(tr).find('input[name="totalhargabarang"]').val(),
            };
            // var sub = {
            //    'parcel': $(tr).find('input[name="parcel"]').val(),
            //    'idparcel': $(tr).find('input[name="idparcel"]').val(),
            //    'jumlah': $(tr).find('input[name="jumlahdiamond"]').val(),
            //    'berat': $(tr).find('input[name="berat"]').val(),
            //    'harga': $(tr).find('input[name="harga"]').val(),
            //    'idheadsetting': $(tr).find('select[name="idheadsetting"]').val(),
            // };

            // tabledetaildiamond.push(sub)

            // console.log(tabledetaildiamond)

         });

         //console.log(tbldetailpenjualan)
         var detailpenjualan = JSON.stringify(tbldetailpenjualan);
         var id_headerpenjualan = $('#id_headerpenjualan').val()
         var jumlahpenjualan = $('#jumlahpenjualan').val()
         var diskonpersenheader = $('#diskonpersenheader').val()
         var diskonnilaiheader = $('#diskonnilaiheader').val()
         var nomor = $('#nomor').val()
         var termsofpayment = $('#termsofpayment').val()
         var tipepenjualan = $('#tipepenjualan').val()
         var tanggaltransaksi = $('#tanggaltransaksi').val()
         var idagen = $('#idagen').val()

         // var id_detailpenjualanbarangjadi = $('#id_detailpenjualanbarangjadi').val();
         //Kirim data ke server menggunakan AJAX
         $.ajax({
            url: "<?= base_url() ?>penjualan/updatepenjualan",
            type: 'post',
            data: {
               tbldetailpenjualan: detailpenjualan,
               id_headerpenjualan: id_headerpenjualan,
               nomor: nomor,
               termsofpayment: termsofpayment,
               jumlahpenjualan: jumlahpenjualan,
               tanggaltransaksi: tanggaltransaksi,
               diskonpersenheader: diskonpersenheader,
               diskonnilaiheader: diskonnilaiheader,
               idagen: idagen,
               //jumlahdetailpenjualan: jumlah
            },
            success: function(response) {
               // location.reload()
               //console.log(response);
               //alert('Data berhasil disimpan!');
            },
            error: function(response) {
               console.log(response)
               alert('Terjadi kesalahan saat menyimpan data.');
            }
         });
         //console.log(tableData)
      });

      // var barcode = document.querySelector(".barcode").value
      // // console.log(barcode)
      // if (barcode == "") {
      //    alert("Barcode tidak boleh kosong")
      //    document.getElementById("btnupdatedetailpenjualan").disabled = true;
      // } else {

      // }

   }

   function matauangtransaksimodal() {
      $(document).on('click', '#matauang', function(e) {
         var idmatauang = $(this).attr('data-id');
         var matauang = $(this).attr('data-matauang');

         var tanggal = $('#tanggaltransaksi').val();

         $.ajax({
            url: "<?= base_url() ?>Ajax/get_kursmatauang",
            type: 'post',
            data: {
               tanggaltransaksi: tanggal,
               search: idmatauang
            },
            success: function(data) {
               data = JSON.parse(data);
               const isEmpty = Object.keys(data).length === 0;
               // console.log(isEmpty);
               if (isEmpty == true) {
                  $('#rate').val(0);

               } else if (isEmpty == false) {
                  $.each(data, function(key, val) {
                     $('#rate').val(val.labelrate);
                  });
               }
               document.getElementById("idmatauang").value = idmatauang
               document.getElementById("matauang").value = matauang
               $('#modalmatauangtransaksi').modal('hide');

            }

         });

      });
   }

   function materialmodalpenjualan() {
      $(document).on('click', '#materialpenjualan', function(e) {
         var idmaterial = $(this).attr('data-id');
         var material = $(this).attr('data-material');

         var tanggal = $('#tanggaltransaksi').val();

         $.ajax({
            url: "<?= base_url() ?>Ajax/get_kursmaterial",
            type: 'post',
            data: {
               tanggaltransaksi: tanggal,
               search: idmaterial
            },
            success: function(data) {
               data = JSON.parse(data);
               const isEmpty = Object.keys(data).length === 0;
               // console.log(isEmpty);
               if (isEmpty == true) {
                  $('#hargaproduk').val(0);
                  $('#hargaproduk_').val(0);

               } else if (isEmpty == false) {
                  $.each(data, function(key, val) {
                     $('#hargaproduk_').val(val.labelrate_);
                     $('#hargaproduk').val(val.labelrate);
                  });
               }
               document.getElementById("idbarang").value = idmaterial;
               document.getElementById("namabarang").value = material
               $('#modalmaterialpenjualan').modal('hide');

            }

         });

      });
   }

   function getkursmatauang() {
      var tanggal = $('#tanggaltransaksi').val();
      var idmatauang = $('#idmatauang').val();
      // console.log(tanggal, idmaterial);
      $.ajax({
         url: "<?= base_url() ?>Ajax/get_kursmatauang",
         type: 'post',
         data: {
            tanggaltransaksi: tanggal,
            search: idmatauang
         },
         success: function(data) {
            data = JSON.parse(data);
            const isEmpty = Object.keys(data).length === 0;
            // console.log(isEmpty);
            if (isEmpty == true) {
               $('#rate').val(0);

            } else if (isEmpty == false) {
               $.each(data, function(key, val) {
                  $('#rate').val(val.labelrate);
               });
            }
         }
      });
   }

   document.querySelectorAll('.js-nilai').forEach(elm => {
      elm.addEventListener("keyup", function(e) {
         elm.value = convertRupiah(elm.value);
      });
   })

   function hitungtotalhargabarang() {
      var hargaproduk = $('#hargaproduk_').val();
      var jumlah = $('#jumlah').val();
      // var discountnilai =  str.replace(".", "");
      // console.log(hargaproduk.replaceAll('.', ''))
      var totalhargabarang = hargaproduk.replaceAll('.', '') * jumlah

      document.getElementById("totalhargabarang").value = formatNumber(parseInt(totalhargabarang));

   }

   function hitungdiskonnilai() {
      var hargaproduk = $('#hargaproduk_').val();
      var jumlah = $('#jumlah').val();
      var discountpersen = $('#discountpersen').val();


      var diskon = hargaproduk.replaceAll('.', '') * jumlah * discountpersen / 100;

      if ($('#discountpersen').val() == 0) {
         $('#discountnilai').val(0)
         document.getElementById("discountnilai").disabled = false;

         hitungtotalhargabarang()
      } else if ($('#discountpersen').val() != 0) {

         document.getElementById("discountnilai").disabled = true;
         document.getElementById("discountnilai").value = diskon;

         hitungtotalhargabarang()
      }
   }

   function hitungdiskonnilaijs() {
      //   var hargaproduk        =  $('#hargaproduk').val();
      // var jumlah             =  $('#jumlah').val();
      // var discountpersen     = $('#discountpersen').val();

      let hargaprodukjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=hargaproduk]`).value;
      let jumlahjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=jumlah]`).value;
      let discountpersenjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountpersen]`);
      let discountnilaijs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountnilai]`);

      var diskon = hargaprodukjs.replaceAll('.', '') * jumlahjs.replaceAll('.', '') * discountpersenjs.value.replaceAll('.', '') / 100;

      if (discountpersenjs.value == 0) {
         discountnilaijs.value = 0
         discountnilaijs.disabled = false
         hitungtotalhargabarangjs()
      } else if (discountpersenjs.value != 0) {

         discountnilaijs.disabled = true
         discountnilaijs.value = formatNumber(parseInt(diskon));
         hitungtotalhargabarangjs()
      }
   }

   function totalpenjualan() {
      // var inputs = document.querySelectorAll("#inputContainer input");
      var totalhargabarang = document.querySelectorAll(`input[name=totalhargabarang]`);
      var sum = 0;

      for (var i = 0; i < totalhargabarang.length; i++) {
         var inputValue = parseFloat(totalhargabarang[i].value.replaceAll('.', ''));
         if (!isNaN(inputValue)) {
            sum += inputValue;
         }
      }
      // Tampilkan hasil penjumlahan
      $('#jumlahpenjualan').val(formatNumber(parseInt(sum)))
      hitunggrandtotal()
   }

   function hitungtotalhargabarangjs() {
      var hargaproduk = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=hargaproduk]`).value;
      var jumlah = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=jumlah]`).value;
      var total = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=totalhargabarang]`);
      // var discountnilai =  str.replace(".", "");
      // console.log(discountnilai)
      var totalhargabarang = hargaproduk.replaceAll('.', '') * jumlah.replaceAll('.', '');
      //console.log(totalhargabarang)
      total.value = formatNumber(parseInt(totalhargabarang));
      totalpenjualan()
      // var totalpenjualan = $('#jumlahpenjualan').val()

      // var b = parseInt(totalhargabarang) + parseInt(totalpenjualan)

      // $('#jumlahpenjualan').val(formatNumber(parseInt(b)))
   }

   function hitungheaderdiskonnilai() {
      var jumlahpenjualan = $('#jumlahpenjualan').val();
      var diskonpersenheader = $('#diskonpersenheader').val();
      var totalpenjualan = jumlahpenjualan.replaceAll('.', '')

      var diskonheader = totalpenjualan * diskonpersenheader / 100;

      if ($('#diskonpersenheader').val() == 0) {
         $('#diskonnilaiheader').val(0)
         $('#diskonnilaiheader').attr('readonly', false);

      } else if ($('#diskonpersenheader').val() != 0) {

         $('#diskonnilaiheader').attr('readonly', true);
         document.getElementById("diskonnilaiheader").value = formatNumber(parseInt(diskonheader));
         hitunggrandtotal();

      }
   }

   function hitunggrandtotal() {
      var jumlahpenjualan = $('#jumlahpenjualan').val();
      var diskonnilaiheader = $('#diskonnilaiheader').val();

      var totalhargapenjualan = jumlahpenjualan.replaceAll('.', '');
      var totaldiskon = diskonnilaiheader.replaceAll('.', '');

      var grandtotal = totalhargapenjualan - totaldiskon


      document.getElementById("grandtotal").value = formatNumber(parseInt(grandtotal));

   }

   // function detailpurchase_edit() {
   //    var idheaderpenjualan = $('#id_headerpenjualan').val();

   //    $.ajax({
   //       url: '<?php echo base_url("ajax/getdetailpurchase_edit"); ?>',
   //       type: 'post',
   //       data: {
   //          idheaderpenjualan: idheaderpenjualan
   //       },
   //       success: function(data) {

   //          let detailpurchaseedit = "";
   //          data = JSON.parse(data);

   //          for (let i = 0; i < data.length; i++) {
   //             detailpurchaseedit += `
   //                                    <tr id="user${data[i].id_detailpenjualan}">
   //                                         <td style="width: 700px"> <input readonly  style="padding-bottom: 10px;" value="${data[i].namabarang}" id="namabarang_" type="text" name="namabarang" class="form-control" > <input style="padding-bottom: 10px;width: 10px;" id="idbarang_" type="hidden" name="idbarang" class="form-control"> <input style="padding-bottom: 10px;width: 100px;" value="${data[i].id_detailpenjualan}" id="iddetailpenjualan_" type="hidden" name="iddetailpenjualan" class="form-control" ></td>
   //                                         <td style="width: 100px"><input style="padding-bottom: 10px;width: 150px;text-align:right"  value="${data[i].jumlah}"  onblur="
   //          onblurfunctionupdatedetailpenjualan_edit()" id="jumlah_" onkeyup="hitungtotalhargabarangjs()" type="number" step="any" name="jumlah" class=" form-control" ></td>
   //                                         <td style="width: 100px"><input  style="padding-bottom: 10px;width: 150px;text-align:right" value="${data[i].butir}" onblur="
   //          onblurfunctionupdatedetailpenjualan_edit()" id="butir_"  type="text" name="butir" class="form-control" ></td>
   //                                         <td style="width: 150px"><input readonly style="padding-bottom: 10px;width: 150px;text-align:right" value="${data[i].harga}" id="hargaprodukjs" type="text" name="hargaproduk" class="form-control" ></td>
   //                                         <td style="width: 150px"><input  style="padding-bottom: 10px;text-align:right" value="${data[i].discountpersendetail}" onblur="
   //          onblurfunctionupdatedetailpenjualan_edit()" id="discountpersen_" onkeyup="hitungdiskonnilaijs()" type="text" name="discountpersen" class="form-control" ></td>
   //                                         <td style="width: 2px"><input   style="padding-bottom: 10px;text-align:right" value='${data[i].discountnilai}'' onblur="
   //          onblurfunctionupdatedetailpenjualan_edit()" id="discountnilai_" onkeyup="hitungtotalhargabarangjs()" type="text" name="discountnilai" class="form-control" ></td>
   //                                         <td style="width: 50px"><input  style="padding-bottom: 10px;text-align:right;width" id="jumlahharga_" readonly type="number" step="any" name="totalhargabarang"   class="form-control" ></td>
   //                                         <td> <a href="#"  id="hapusdetailpenjualan" data-nomor="${data[i].nomorpenjualan}" data-iddetailpenjualan="${data[i].id_detailpenjualan}"  class="hapusdetailpenjualan btn btn-sm btn-danger" role="button" title="Hapus">  <i class="fas fa-fw fa-trash"></i> Hapus </a>
   //                                         </td>
   //                                    </tr>
   //                                    `;

   //          }
   //          let tabledetailpurchaseedit = document.querySelector("#tabledetailpurchaseedit");

   //          tabledetailpurchaseedit.innerHTML = detailpurchaseedit;
   //       }
   //    });

   // }

   // function totalhargapenjualan_edit() {
   //    var idheaderpenjualan = $('#id_headerpenjualan').val();
   //    $.ajax({
   //       url: '<?php echo base_url("penjualan/gettotalharga_edit"); ?>',
   //       type: 'post',
   //       data: {
   //          idheaderpenjualan: idheaderpenjualan
   //       },
   //       success: function(data) {
   //          $('#tampiltotalpenjualan_edit').html(data);
   //          hitungheaderdiskonnilai();
   //       }
   //    });

   // }

   function adddetailpenjualan() {
      // inputRow()
      // var id = $("#id").val();
      // var iddetail = $("#iddetail").val();


      // // document.querySelector(`#detail${id} #totalharga`).value = formatNumber(total)

      // iddetail++;

      var namabarang = document.querySelector(`#addformdetailpurchase #namabarang`).value
      var iddetailpenjualan = document.querySelector(`#addformdetailpurchase #iddetailpenjualan`).value
      var jumlah = document.querySelector(`#addformdetailpurchase #jumlah`).value
      var hargaproduk = document.querySelector(`#addformdetailpurchase #hargaproduk_`).value
      var totalhargabarang = document.querySelector(`#addformdetailpurchase #totalhargabarang`).value

      var id = hargaproduk.replaceAll('.', '')

      let kolombaru = `<tr id="detailpenjualan${id}-">
                           <td style="width: 700px;">
                                 <div class="input-group">
                                    <input style="padding-bottom: 10px;width: 10px;" value='${namabarang}' type="text" name="namabarang" class="form-control">
                                 </div>
                           </td>
                           <td style="width: 100px">
                               <input type="hidden" name="iddetailpenjualan" value="${iddetailpenjualan}">
                               <input type="number" step="any" style="text-align: right;" onkeyup="hitungtotalhargabarangjs()" name="jumlah" value="${jumlah}" class="js-nilai form-control">
                           </td> 
                           <td style="width: 150px">
                              <input type="text" style="text-align: right;" value="${hargaproduk}" name="hargaproduk" onkeyup="hitungtotalhargabarangjs()" class="js-nilai form-control"> 
                           </td> 
                           <td style="width: 150px">
                              <input type="text" style="text-align: right;" name="totalhargabarang" value="${totalhargabarang}" readonly class="js-nilai form-control">
                           </td>
                           <td style="width: 50px;"> <a href="#" id="hapusdetailpenjualan" data-iddetailpenjualan="${iddetailpenjualan}" class="hapusdetailpenjualan btn btn-sm btn-danger" role="button" title="Hapus"> <i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                               </td>
                        </tr>`
      //let tr = document.querySelector(`#isi`).style.display = ""
      $('#datapenjualan').append(kolombaru)
      // $("#idparcelinput").val("")
      // $("#parcelinput").val("")
      // $("#caratinput").val("")
      // $("#hargainput").val("")
      // $("#clarityinput").val("")
      // $("#shapeinput").val("")
      // $("#colorinput").val("")
      // $("#idheadsetting").val("")
      // $("#colorinput").val("")
      // $("#idheadsettinginput").val("")
      // $("#jumlahinput").val("")
      // $("#beratinput").val("") 
      document.querySelector(`#addformdetailpurchase #namabarang`).value = ""
      document.querySelector(`#addformdetailpurchase #jumlah`).value = ""
      document.querySelector(`#addformdetailpurchase #hargaproduk_`).value = ""
      document.querySelector(`#addformdetailpurchase #totalhargabarang`).value = ""

      totalpenjualan()
      // document.querySelector(`#markup`).value = ""
      // document.querySelector(`#salesprice`).value = ""

   }

   $(document).on('click', '.hapusdetailpenjualan', function(e) {
      e.preventDefault();
      // var id = $(this).attr('data-id');
      // var iddeskripsi = $(this).attr('data-iddeskripsi');

      // console.log(id, iddeskripsi) 
      let barisdetailpenjualan = document.querySelector(`tr#${event.target.parentNode.parentNode.id}`);
      // let harga = document.querySelector(`tr#${event.target.parentNode.parentNode.id} #harga`).value;
      // // let idbaris = document.querySelector(`tr#${event.target.parentNode.parentNode.id} #idnumber`).value;
      barisdetailpenjualan.remove()
      totalpenjualan()
   });

   $(document).on('click', '#btndeletedetailpenjualanedit', function(e) {
      e.preventDefault();
      var iddetailpenjualan = $(this).attr('data-iddetailpenjualan');
      var nomor = $(this).attr('data-nomor');
      console.log(nomor)
      $.ajax({
         url: "<?php echo base_url() . 'penjualan/deletedetailpenjualan'; ?>",
         type: "post",
         data: {
            iddetailpenjualan: iddetailpenjualan,
            nomor: nomor,
         },
         success: function() {
            detailpurchase_edit();
            totalhargapenjualan_edit();
            hitunggrandtotal();
            if ($('#jumlahpenjualan').val(0)) {
               $('#diskonnilaiheader').val("");
               $('#diskonpersenheader').val("");
               $('#diskonnilaiheader').attr('readonly', false);
            }
         }
      });
   });
</script>
<!-- End Function Javascript -->