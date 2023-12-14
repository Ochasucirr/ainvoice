<!-- Isi -->
<div class="container-fluid">

  <!-- Judul -->
  <h1 class="h3 mb-4 text-gray-900 text-end"><?= $title; ?></h1>

  <!-- Awalan Table -->
  <div class="row">
    <div class="col-lg">

    <!-- <a href="<?= base_url('cetaknonagen'); ?>" class="btn btn-primary mb-3">Cetak data</a> -->

      <!-- Tabel -->
      <table class="table table-hover" id="example">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Agen</th>
            <th scope="col">No Telephone</th>
            <th scope="col">Alamat Agen</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($datanonagen as $dn) : ?>
            <tr>
              <th class="tengah" scope="row"><?= $i; ?></th>
              <td><?= $dn['namaagen']; ?></td>
              <td><?= $dn['notelepon']; ?></td>
              <td><?= $dn['alamatagen']; ?></td>
            </tr>
            <?php $i++ ?>
          <?php endforeach; ?>
        </tbody>
      </table>  

    </div>
  </div>
<br><br>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

