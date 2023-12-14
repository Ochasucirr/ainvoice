<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        @font-face {
            font-family: "Corporate Condensed";
            src: url("file:C:/Users/62851/AppData/Local/Microsoft/Windows/Fonts/cdaswfte.woff") format("woff"),
        }

        #table {

            border-collapse: collapse;
            width: 100%;
            margin-top: -12px;
        }

        #table td,
        {

        border: none;
        padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            color: black;
            padding: 8px;
            border-top: 1px solid;
            border-bottom: 1px solid;
            border-left: none;
            border-left: none;
        }

        .page_break {
            page-break-after: always;
        }
    </style>
</head><body>

    <?php foreach ($headerpenjualan as $dataheader)

        $tanggaljto    = date('Y-m-d', strtotime('+' . $dataheader->termsofpayment     . 'days', strtotime($dataheader->tanggalpenjualan))); //  
    ?>
    <div>
        <h3 style="padding-bottom: 0px;text-align: center;font-weight: bold;font-size:25px;margin-top: 20px"><?= $title; ?> </h3>
        <table style="margin-top:10px">
            <tr>
                <td>  <h5 style="padding-bottom: 0px;text-align: left;font-size:15px;">eFishery </h3></td>
                <td> <h5 style="padding-bottom: 0px;text-align: right;font-size:15px;padding-left: 410px;"><?php echo $dataheader->nomorpenjualan?> </h3></td>
            </tr>
        </table>
      
       

            <table style="margin-top:20px">
                <tr>
                    <td> Ditujukan Kepada:</td>
                    <td>:</td>
                    <td style="width:150px">&nbsp;</td>
                    <td style="width:100px">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Tanggal Order </td>
                    <td>:</td>
                    <td><?= $dataheader->tanggalpenjualan ?></td>
                </tr>
                <tr>
                    <td> Nama Agen</td>
                    <td>:</td>
                    <td><?= $dataheader->nama_agen ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Tanggal harus bayar </td>
                    <td>:</td>
                    <td><?= $tanggaljto ?></td>
                </tr>
                <tr>
                    <td> Alamat Agen</td>
                    <td>:</td>
                    <td><?= $dataheader->alamat_agen ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Harus bayar ke </td>
                    <td>:</td>
                    <td>003621762362</td>
                </tr>
                <tr>
                    <td> No Telephone Agen</td>
                    <td>:</td>
                    <td><?= $dataheader->no_telephone  ?></td> 
                </tr>


            </table>

            <table id="table" style="margin-top:20px">
                <tr style="font-size:12px;font-family: 'Corporate Condensed', sans-serif;"> 
                    <th style=" width :23%;">Nama Barang</th>
                    <th style=" width :5%;text-align: right;">Jumlah</th>
                    <th style=" width :10%; text-align: right;">Harga</th>
                    <th style=" width :10%;text-align: right;">Total Harga</th>
                </tr>
                <?php foreach ($detailpenjualan as $datadetail) { ?>
                    <tr> 
                        <td> <?= $datadetail->namabarang ?> </td>
                        <td style="text-align:right;"> <?= $datadetail->jumlah ?> </td>
                        <td style="text-align:right;"> <?= number_format($datadetail->harga, '0', ',', '.') ?> </td>
                        <td style="text-align:right;"> <?= number_format($datadetail->jumlahharga, '0', ',', '.') ?> </td>
                    </tr>
                <?php } ?>
                <tr> 
                    <td style=" width :23%;"></td>
                    <td style=" width :5%;text-align: left;">Discount</td>
                    <td style=" width :10%; text-align: right;"><?= $dataheader->discountpersen ?>(%)</td>
                    <td style=" width :10%;text-align: right;"><?= number_format($dataheader->discountnilai, '0', ',', '.') ?></td>
                </tr>
                  <tr> 
                    <td style=" width :23%;"></td>
                    <td style=" width :5%;text-align: right;"></td>
                    <td style=" width :10%; text-align: right;">Grand Total</td>
                    <td style=" width :10%;text-align: right;"><?= number_format($dataheader->jumlahpenjualan, '0', ',', '.') ?></td>
                </tr>
            </table> 

           <table  style="margin-top: 20px;" align="right" width="625">
            <tr>
                <td width="550"></td>
                <td width="680" class="text" align="right" style="padding-right: -10px;">PT. Multidaya Teknologi Nusantara  </td>
            </tr>
               <tr>
                <td width="100"></td>
                
                <td style="padding-left: 770px;" class="text"><img src="assets/img/ttd.jpeg" width="90" height="100"></td>
            </tr>
            <tr>
                <td width="100"></td>
                
                <td style="padding-left: 750px;" class="text">(Manager Penjualan)<br><br><br><br></td>
            </tr>
         </table>

    </div>

</body></html>