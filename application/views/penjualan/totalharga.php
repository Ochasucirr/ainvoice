<?php foreach ($totalharga as $t)  ?>
<input type="text" style="text-align: right;" name="jumlahpenjualan" readonly id="jumlahpenjualan" value="<?php echo number_format($t->totalharga, 0, ',', '.') ?> " class="js-nilai form-control">