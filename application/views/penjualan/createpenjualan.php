<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1><?php echo $this->lang->line('add'); ?> Data Invoice</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Invoice</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid" style="padding-bottom: 70px;">
         <form action="<?php echo base_url() . 'tambahdatapenjualan'; ?> " enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
            <div class="row">
               <div class="col-md-12">

                  <div class="row">
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="shadow card">
                           <div class="col-md-3">
                              <h4 style="margin-top: 10px;margin-bottom: 0px;padding-bottom: 0px;margin-left: 7px;">Header Invoice</h4>
                           </div>
                           <div class="card-body">

                              <div class="row">

                                 <input style="padding-bottom: 10px;" type="hidden" name="id" class="form-control">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating"> Invoice</label>
                                       <input style="padding-bottom: 10px;" type="text" id="nomor" name="nomor" class="form-control" readonly value="<?= $nomorinvoice ?>">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Nomor PO</label>
                                       <input style="padding-bottom: 10px;" autofocus type="text" value="<?= set_value('nomorpo') ?>" name="nomorpo" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Tanggal Invoice</label>
                                       <input style="padding-bottom: 10px;" value="<?php echo date('Y-m-d'); ?>" type="date" value="<?= set_value('tanggaltransaksi') ?>" name="tanggaltransaksi" id="tanggaltransaksi" class="form-control">
                                       <?= form_error('tanggaltransaksi', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">

                                 <div class="col-md-3">
                                    <label>Agen</label>
                                    <div class="input-group">

                                       <input style="padding-bottom: 10px; " id="namaagen" required type="text" value="<?= set_value('namaagen') ?>" name="namaagen" class="form-control">

                                       <input style="padding-bottom: 10px;" id="idagen" type="hidden" value="<?= set_value('idagen') ?>" name="idagen" class="form-control" readonly>
                                       <span class="input-group-btn">
                                          <button style="margin-left: 3px;" type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalagen">Cari</button>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label class="bmd-label-floating">Terms Of Payment</label>
                                       <input style="padding-bottom: 10px;text-align: right;" step="any" type="text" value="<?= set_value('termsofpayment') ?>" name="termsofpayment" class="js-nilai form-control">
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
                                 <h4 style="margin-top: 10px;margin-bottom: 0px;padding-bottom: 0px;margin-left: 7px;">Detail Invoice</h4>
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

                                                   <table class="table table-hover" width="100%" cellspacing="0">
                                                      <thead>
                                                         <tr height="20px">

                                                            <th style="width: 700px;">Nama Barang</th>
                                                            <th style="width: 150px">Jumlah</th>
                                                            <th style="width: 150px">Harga</th>
                                                            <th style="width: 150px">Total Harga</th>
                                                            <th style="width: 50px"><?php echo $this->lang->line('pengaturan'); ?></th>
                                                         </tr>
                                                      </thead>
                                                      <tbody id="tabledetailsale"></tbody>
                                                      <tfoot>
                                                         <tr id="addformdetailsale">
                                                            <td style="width: 700px;">
                                                               <div class="input-group">
                                                                  <input style="padding-bottom: 10px;width: 10px;" id="namabarang" type="text" name="namabarang" class="form-control">
                                                               </div>
                                                            </td>
                                                            <td>
                                                               <input type="hidden" readonly name="idheader" id="idheader" value="0" class="form-control">
                                                               <!--   <div id="iddetailpenjualan"></div> -->
                                                               <input type="number" step="any" style="text-align: right;width: 150px" onkeyup="hitungtotalhargabarang()" name="jumlah" id="jumlah" class="form-control">
                                                            </td>
                                                            <td>
                                                               <input type="hidden" style="text-align: right;" name="hargaproduk" id="hargaproduk" class="form-control">
                                                               <input type="text" style="text-align: right;width: 150px" onkeyup="hitungtotalhargabarang()" name="hargaproduk_" id="hargaproduk_" class="js-nilai form-control">
                                                            </td>
                                                            <td style="width: 150px">
                                                               <input type="text" style="text-align: right;" name="totalhargabarang" readonly id="totalhargabarang" class="js-nilai form-control">
                                                            </td>
                                                            <td style="width: 50px">
                                                               <!-- <a href="#" id="btntambahdetailtransaksi" class=" btn btn-sm btn-primary" role="button" title="Tambah" onclick="adddetailpenjualan()"> <i class="fas fa-fw fa-pluss"></i>Tambah</a> -->
                                                               <button onclick="adddetailpenjualan()" class=" btn btn-sm btn-primary" role="button" style="width: 80px;"> Tambah</button>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Total</td>
                                                            <td></td>
                                                            <td style="width: 200px" id="tampiltotalpenjualan">
                                                            </td>
                                                            <td></td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Discount
                                                            </td>
                                                            <td style="width: 200px;">
                                                               <div class="input-group"><input type="text" style="text-align: right;max-width:75px; " name="diskonpersenheader" onkeyup="hitungheaderdiskonnilai()" value="<?= set_value('diskonpersenheader') ?>" id="diskonpersenheader" class="js-nilai form-control"><input type="text" style="text-align: right;max-width:50px" readonly value="%" name="simbolpersen" class="js-nilai form-control"></div>
                                                            </td>
                                                            <td style="width: 200px">
                                                               <input type="text" style="text-align: right;" onclick="autoblockdiskonnilaiheader()" name="diskonnilaiheader" value="<?= set_value('diskonnilaiheader') ?>" id="diskonnilaiheader" class="js-nilai form-control">
                                                            </td>
                                                            <td></td>
                                                         </tr>
                                                         <tr>
                                                            <td></td>
                                                            <td>Grand Total</td>
                                                            <td></td>
                                                            <td style="width: 200px"> <input type="text" value="<?= set_value('grandtotal') ?>" required style="text-align: right;" name="grandtotal" readonly id="grandtotal" class="js-nilai form-control"></td>
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
                  <button type="submit" id="btnsubmitpenjualan" class="btn btn-info">Simpan</button> <a href="<?= base_url('listpenjualan'); ?>" class="btn btn-danger">Kembali</a>
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
      detailsale();
      $("#grandtotal").val(0)
      totalhargapenjualan();

   });

   function autoblockdiskonnilaiheader() {
      $('#diskonnilaiheader').select();
   }

   function autoblockbiaya() {
      $('#biaya').select();
   }

   function autoblockbayardimuka() {
      $('#bayardimuka').select();
   }

   function autoblockpajaknilaiheader() {
      $('#pajaknilaiheader').select();
   }
   var input = document.getElementById('namabarang');

   input.addEventListener('keydown', function(event) {
      if (event.keyCode === 13) {
         event.preventDefault();
         return false;
      }
   });

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
   // $("select[id=tipepenjualan]").on("change", function() {
   //    if ($(this).val() == "Material") {
   //       $("button[id=diamond] ").hide();
   //       $("button[id=bahanbakupendukung] ").hide();
   //       $("button[id=material] ").show();
   //       $('#hargaproduk_').val("");
   //       $('#hargaproduk').val("");
   //       $('#jumlah').val("");
   //       $('#idbarang').val("");
   //       $('#namabarang').val("");
   //       $('#hargaproduk').val("");
   //       $('#butir').val("");
   //       $('#discountpersen').val("");
   //       $('#discountnilai').val("");
   //       $('#totalhargabarang').val("");

   //    } else if ($(this).val() == "Diamond") {

   //       $("button[id=diamond] ").show();
   //       $("button[id=bahanbaku] ").hide();
   //       $("button[id=material] ").hide();
   //       $('#hargaproduk_').val("");
   //       $('#hargaproduk').val("");
   //       $('#jumlah').val("");
   //       $('#idbarang').val("");
   //       $('#namabarang').val("");
   //       $('#hargaproduk').val("");
   //       $('#butir').val("");
   //       $('#discountpersen').val("");
   //       $('#discountnilai').val("");
   //       $('#totalhargabarang').val("");
   //    } else if ($(this).val() == "Bahan Baku Pendukung") {

   //       $("button[id=diamond] ").hide();
   //       $("button[id=bahanbaku] ").hide();
   //       $("button[id=bahanbakupendukung] ").show();
   //       $("button[id=material] ").hide();
   //       $('#hargaproduk_').val("");
   //       $('#hargaproduk').val("");
   //       $('#jumlah').val("");
   //       $('#idbarang').val("");
   //       $('#namabarang').val("");
   //       $('#hargaproduk').val("");
   //       $('#butir').val("");
   //       $('#discountpersen').val("");
   //       $('#discountnilai').val("");
   //       $('#totalhargabarang').val("");
   //    }
   // });
   // $("select[id=tipepenjualan]").trigger("change");

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

   function hitungtotalhargabarang() {
      var harga = $('#hargaproduk_').val();
      var jumlah = $('#jumlah').val();
      var hargaproduk = harga.replaceAll('.', '')
      // var discountnilai =  str.replace(".", "");
      // console.log(discountnilai)
      var totalhargabarang = hargaproduk * jumlah

      document.getElementById("totalhargabarang").value = formatNumber(parseInt(totalhargabarang));
      document.getElementById('btntambahdetailtransaksi').disabled = false

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


   function detailsale() {
      $.ajax({
         url: '<?php echo base_url("penjualan/getdetailsale"); ?>',
         type: 'get',
         success: function(data) {

            let detailsale = "";
            data = JSON.parse(data);
            if (data.length == 0) {
               document.getElementById('btnsubmitpenjualan').disabled = true
               document.getElementById('diskonpersenheader').value = ""
               document.getElementById('diskonnilaiheader').value = ""
               document.getElementById('grandtotal').value = ""
               let tabledetailsale = document.querySelector("#tabledetailsale");

               tabledetailsale.innerHTML = ""
            } else {
               for (let i = 0; i < data.length; i++) {
                  detailsale += `
                                      <tr id="user${data[i].id_detailpenjualan}">
                                           <td style="width: 700px"> <input readonly  style="padding-bottom: 10px;" value='${data[i].namabarang}' id="namabarang_" type="text" name="namabarang" class="form-control" > <input style="padding-bottom: 10px;width: 10px;" id="idbarang_" type="hidden" name="idbarang" class="form-control"> <input style="padding-bottom: 10px;width: 10px;" value="${data[i].id_detailpenjualan}" id="iddetailpenjualan_" type="hidden" name="iddetailpenjualan" class="form-control" ></td>
                                           <td style="width: 150px"><input style="padding-bottom: 10px;width: 150px;text-align:right" value="${data[i].jumlah}"  onblur="
            onblurfunctionupdatedetailpenjualan()" id="jumlah_" onkeyup="hitungtotalhargabarangjs()" type="text" name="jumlah" class="js-nilai form-control" ></td> 
                                           <td style="width: 150px"><input  style="padding-bottom: 10px;width: 150px;text-align:right" onkeyup="hitungtotalhargabarangjs()"  value="${formatNumber(data[i].harga)}" id="hargaprodukjs" type="text" name="hargaproduk" class="js-nilai form-control" onblur="onblurfunctionupdatedetailpenjualan()"></td> 
                                           <td style="width: 150px"><input  style="padding-bottom: 10px;text-align:right;width" value="${formatNumber(data[i].jumlahharga)}" id="jumlahharga_" readonly type="text"   name="totalhargabarang"   class="form-control" ></td>
                                           <td style="width: 50px"> <a href="#"  id="btndeletedetailpenjualan" data-iddetailpenjualan="${data[i].id_detailpenjualan}"  class="hapusdetailsale btn btn-sm btn-danger" role="button" title="Hapus">  <i class="fas fa-fw fa-trash"></i>Hapus</a>
                                           </td>
                                      </tr>
                                      `;

               }
               let tabledetailsale = document.querySelector("#tabledetailsale");

               tabledetailsale.innerHTML = detailsale;
               document.getElementById('btnsubmitpenjualan').disabled = false
            }

         }
      });
   }

   function hitungdiskonnilaijs() {
      //   var hargaproduk        =  $('#hargaproduk').val();
      // var jumlah             =  $('#jumlah').val();
      // var discountpersen     = $('#discountpersen').val();

      let hargaprodukjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=hargaproduk]`);
      let jumlahjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=jumlah]`);
      let discountpersenjs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountpersen]`);
      let discountnilaijs = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountnilai]`);

      var diskon = hargaprodukjs.value.replaceAll('.', '') * jumlahjs.value * discountpersenjs.value / 100;

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

   function hitungtotalhargabarangjs() {
      var hargaproduk = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=hargaproduk]`).value;
      var jumlah = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=jumlah]`).value;

      // var discountnilai =  str.replace(".", "");

      var totalhargabarang = hargaproduk.replaceAll('.', '') * jumlah.replaceAll('.', '')

      document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=totalhargabarang]`).value = formatNumber(parseInt(totalhargabarang));
   }

   function adddetailpenjualan() {
      var idheader = $('#idheader').val();
      var iddetailpenjualan = $('#iddetailpenjualan').val();
      var namabarang = $('#namabarang').val();
      var tanggaltransaksi = $('#tanggaltransaksi').val();
      var jumlah = $('#jumlah').val();
      var idlawantransaksi = $('#idlawantransaksi').val();
      var harga = $('#hargaproduk_').val();
      var nomor = $('#nomor').val();
      var totalhargabarang = $('#totalhargabarang').val();

      // console.log(skuproduk);

      if (namabarang == "") {
         alert("Nama barang tidak boleh kosong")
         document.getElementById('btntambahdetailtransaksi').disabled = true
      } else if (jumlah == 0) {
         alert("Jumlah barang tidak boleh kurang dari 0")
         document.getElementById('btntambahdetailtransaksi').disabled = true
      } else if (namabarang != "") {
         $.ajax({
            url: "<?php echo base_url("penjualan/adddetailpenjualan"); ?>",
            type: "POST",
            data: {
               namabarang: namabarang,
               jumlah: jumlah,
               idheader: idheader,
               iddetailpenjualan: iddetailpenjualan,
               tanggaltransaksi: tanggaltransaksi,
               idlawantransaksi: idlawantransaksi,
               nomor: nomor,
               hargaproduk: harga.replaceAll('.', ''),
               totalhargabarang: totalhargabarang.replaceAll('.', '')
            },
            success: function(msg) {

               //$('#addformdetailpurchase').hide()
               hitungheaderdiskonnilai();
               detailsale();
               totalhargapenjualan();
            }
         });
         $('#hargaproduk_').val("");
         $('#hargaproduk').val("");
         $('#jumlah').val("");
         $('#namabarang').val("");
         $('#hargaproduk').val("");
         $('#totalhargabarang').val("");
      }



   }

   function onblurfunctionupdatedetailpenjualan() {

      var iddetailpenjualan = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=iddetailpenjualan]`);
      var namabarang = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=namabarang]`);
      var jumlah = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=jumlah]`).value;
      // var butir = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=butir]`).value;
      var harga = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=hargaproduk]`).value;
      // var discountpersen = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountpersen]`).value;
      // var discountnilai = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=discountnilai]`).value;
      var totalhargabarang = document.querySelector(`tr#${event.target.parentNode.parentNode.id} input[name=totalhargabarang]`).value;
      // var idlokasi = $('#idlokasi').val();
      var idlawantransaksi = $('#idlawantransaksi').val();
      var tanggaltransaksi = $('#tanggaltransaksi').val();
      // var jenisbahan = $('#tipepenjualan').val();
      var idheader = $('#idheader').val();
      var nomor = $('#nomor').val();

      // console.log(namabarangjs.value,jumlahjs.value, butirjs.value,hargajs.value, discountpersenjs.value,discountnilaijs.value, totalhargabarangjs.value)
      $.ajax({
         url: "<?php echo base_url("penjualan/updatedetailpenjualan"); ?>",
         type: "POST",
         data: {
            iddetailpenjualan: iddetailpenjualan.value,
            namabarang: namabarang.value,
            jumlah: jumlah.replaceAll('.', ''),
            // butir: butir.replaceAll('.', ''),
            hargaproduk: harga.replaceAll('.', ''),
            // discountpersen: discountpersen.replaceAll('.', ''),
            // discountnilai: discountnilai.replaceAll('.', ''),
            totalhargabarang: totalhargabarang.replaceAll('.', ''),
            tanggaltransaksi: tanggaltransaksi,
            // tipepenjualan: jenisbahan,
            // idlokasi: idlokasi,
            nomor: nomor,
            idlawantransaksi: idlawantransaksi,
         },
         success: function(msg) {
            detailsale();
            totalhargapenjualan();
         }
      });
   }


   function totalhargapenjualan() {
      var idheader = $('#idheader').val();
      $.ajax({
         url: '<?php echo base_url("penjualan/gettotalharga"); ?>',
         type: 'post',
         data: {
            idheader: idheader
         },
         success: function(data) {
            $('#tampiltotalpenjualan').html(data);
            hitungheaderdiskonnilai();
            hitunggrandtotal()
         }
      });

   }
</script>
<script>
   $(document).on('click', '#btndeletedetailpenjualan', function(e) {
      e.preventDefault();
      var iddetailpenjualan = $(this).attr('data-iddetailpenjualan');
      var nomor = $('#nomor').val();;

      $.ajax({
         url: "<?php echo base_url() . 'penjualan/deletedetailpenjualan'; ?>",
         type: "post",
         data: {
            iddetailpenjualan: iddetailpenjualan,
            nomor: nomor,
         },
         success: function() {
            detailsale();
            totalhargapenjualan();
            hitungheaderdiskonnilai();
            // if ($('#jumlahpenjualan').val(0)) {
            //   $('#diskonnilaiheader').val("");
            //   $('#diskonpersenheader').val("");
            //   $('#biaya').val("");
            //   $('#bayardimuka').val("");
            //   $('#pajakpersenheader').val("");
            //   $('#pajaknilaiheader').val("");
            //   $('#pajaknilaiheader').attr('readonly', false);
            //   $('#diskonnilaiheader').attr('readonly', false);
            // }

         }
      });
   });
</script>
<!-- End Function Javascript -->