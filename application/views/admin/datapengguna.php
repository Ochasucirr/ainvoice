<!-- Isi -->
<div class="container-fluid">

  <!-- Judul -->
  <h1 class="h3 mb-4 text-gray-900 text-end"><?= $title; ?></h1>

  <!-- Awalan Tabel -->
  <div class="row">
    <div class="col-lg" >
      <!-- Error -->
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <!-- Pesan -->
      <?= $this->session->flashdata('message'); ?>

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalpengguna">Tambah Data Pengguna</a>

      <!-- Table -->
      <table class="table" id="example">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Gambar</th>
            <th scope="col">Role ID</th>
            <th scope="col">Date Created</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($datapengguna as $dp) : ?>
            <tr>
              <th class="tengah" scope="row"><?= $i; ?></th>
              <td><?= $dp['name']; ?></td>
              <td class="tengah"><img src="<?= base_url('assets/img/profile/') . $dp['image']; ?>" class="img-thumbnail" style="width: 80px;"></td>
              <td class="tengah"><?= $dp['role_id']; ?></td>
              <td class="tengah"><?= $dp['date_created']; ?></td>
              <td class="tengah">
                <a href="<?= base_url('admin/edit_dp/') . $dp['id']; ?>" data-toggle="modal" data-target="#editPengguna<?= $dp['id']; ?>" class="badge badge-success"><i class="fas fa-fw fa-pencil-alt"></i>&nbsp;edit</a>
                <a href="<?= base_url('admin/hapus_dp/') . $dp['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin')"><i class="fas fa-fw fa-trash"></i>&nbsp;delete</a>
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
<div class="modal fade" id="exampleModalpengguna" tabindex="-1" aria-labelledby="exampleModalpenggunaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalpenggunaLabel" style="font-weight: bold;">Tambah Data Pengguna</h4>
      </div>
      <!-- <form action="<?= base_url('admin/datapengguna'); ?>" method="post"> -->
      <?php echo form_open_multipart('admin/datapengguna'); ?>
      <div class="modal-body">
        <!-- Form Nama -->
        <div class="form-group">
          <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
          <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="gambar">Pilih Gambar</label>
          </div>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password1" name="password" placeholder="Password">
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <input type="number" min="1" max="3" class="form-control" id="role" name="role" placeholder="Role ID">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight: bold;">Keluar</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<?php foreach ($datapengguna as $dp) : ?>
  <div class="modal fade" id="editPengguna<?= $dp['id']; ?>" tabindex="-1" aria-labelledby="editPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="editPenggunaLabel" style="font-weight: bold;">Edit Data Pengguna</h4>
        </div>
        <!-- <form action="<?= base_url('admin/edit_dp/' . $dp['id']); ?>" method="post"> -->
        <?php echo form_open_multipart('admin/edit_dp/' . $dp['id']); ?>
        <div class="modal-body">
          <!-- Form Nama -->
          <div class="form-group">
            <input type="text" class="form-control" id="name" value="<?= $dp['name']; ?>" name="name" placeholder="Nama Lengkap">
            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" value="" id="image" name="image">
              <label class="custom-file-label" for="gambar"><?= $dp['image'] == NULL || $dp['image'] == '' ? 'Pilih Gambar' : $dp['image']; ?></label>
            </div>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="number" min="1" max="3" class="form-control" id="role" value="<?= $dp['role_id']; ?>" name="role" placeholder="Role ID">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight: bold;">Keluar</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>