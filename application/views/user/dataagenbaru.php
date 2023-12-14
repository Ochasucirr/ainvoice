<!-- Isi -->
<div class="container-fluid">

  <!-- Judul -->
  <h1 class="h3 mb-4 text-gray-900 text-end"><?= $title; ?></h1>

  <!-- Awalan Table -->
  <div class="row">
    <div class="col-lg">
      <!-- Error -->
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <!-- Pesan -->
      <?= $this->session->flashdata('message'); ?>

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalagenbaru">Tambah Data Agen Baru</a>
      <a href="#" data-toggle="modal" data-target="#modalimport" class="btn btn-primary mb-3">Import Data Agen Baru</a>
      <a href="<?= base_url('validasidataagen') ?>" class="btn btn-primary mb-3">Check Data Import</a>

      <!-- Tabel -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Agen</th>
            <th scope="col">No Telephone</th>
            <th scope="col">Alamat Agen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($dataagenbaru as $dab) : ?>
            <tr>
              <th class="tengah" scope="row"><?= $i; ?></th>
              <td><?= $dab['nama_agen']; ?></td>
              <td><?= $dab['no_telephone']; ?></td>
              <td><?= $dab['alamat_agen']; ?></td>
              <td class="tengah" style="width: 200px;">
                <a href="<?= base_url('user/edit_dab/') . $dab['id']; ?>" data-toggle="modal" data-target="#exampleModaleditdab<?= $dab['id']; ?>" class="badge badge-success"><i class="fas fa-fw fa-pencil-alt"></i>&nbsp;edit</a>
                <a href="<?= base_url('user/hapus_dab/') . $dab['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin')"><i class="fas fa-fw fa-trash"></i>&nbsp;delete</a>
              </td>
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

<!-- Modal Tambah-->
<div class="modal fade" id="exampleModalagenbaru" tabindex="-1" aria-labelledby="exampleModalagenbaruLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalagenbaruLabel">Tambah Data Agen Baru</h1>
      </div>
      <?php echo form_open_multipart('user/dataagenbaru/'); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="nama_agen" name="nama_agen" placeholder="Nama Agen">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="no_telephone" name="no_telephone" placeholder="No Telephone">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="alamat_agen" name="alamat_agen" placeholder="Alamat Agen">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<?php foreach ($dataagenbaru as $dab) : ?>
  <div class="modal fade" id="exampleModaleditdab<?= $dab['id']; ?>" tabindex="-1" aria-labelledby="exampleModaleditdab" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModaleditdab">Edit Data Agen Baru</h1>
        </div>
        <?php echo form_open_multipart('user/edit_dab/' . $dab['id']); ?>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_agen" value="<?= $dab['nama_agen']; ?>" name="nama_agen" placeholder="Nama Agen">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="no_telephone" value="<?= $dab['no_telephone']; ?>" name="no_telephone" placeholder="No Telephone">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="alamat_agen" value="<?= $dab['alamat_agen']; ?>" name="alamat_agen" placeholder="Alamat Agen">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="<?php echo base_url() . 'user/importdataagen'; ?> " enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Tanggal Import</label>
              <input type="date" required class="form-control" name="tanggaltransaksi">
            </div>
            <div class="col-md-6">
              <label>File</label>
              <input type="file" class="form-control" name="file">
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a class="btn btn-danger" type="button" data-dismiss="modal">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>