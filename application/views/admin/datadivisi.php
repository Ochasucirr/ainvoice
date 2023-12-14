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

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModaldivisi">Tambah Data Divisi</a>

      <!-- Tabel -->
      <table class="table table-hover" id="example">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul Jobdesc</th>
            <th scope="col">Gambar</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($datadivisi as $dd) : ?>
            <tr>
              <th class="tengah" scope="row"><?= $i; ?></th>
              <td><?= $dd['judul_jobdesc']; ?></td>
              <td class="tengah"><img src="<?= base_url('assets/img/admin/') . $dd['gambar']; ?>" class="img-thumbnail" style="width: 80px;"></td>
              <td><?= $dd['deskripsi']; ?></td>
              <td class="tengah" style="width: 200px;">
                  <a href="<?= base_url('admin/edit_dd/') . $dd['id']; ?>" data-toggle="modal" data-target="#exampleModaleditdd<?= $dd['id']; ?>" class="badge badge-success"><i class="fas fa-fw fa-pencil-alt"></i>&nbsp;edit</a>
                  <a href="<?= base_url('admin/hapus_dd/') . $dd['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin')"><i class="fas fa-fw fa-trash"></i>&nbsp;delete</a>
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
<div class="modal fade" id="exampleModaldivisi" tabindex="-1" aria-labelledby="exampleModaldivisiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModaldivisiLabel" style="font-weight: bold;">Tambah Data Divisi</h4>
      </div>
      <!-- <form action="<?= base_url('admin/datadivisi/'); ?>" method="post"> -->
      <?php echo form_open_multipart('admin/datadivisi/'); ?>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="judul_jobdesc" name="judul_jobdesc" placeholder="Judul Jobdescription">
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="gambar" name="gambar">
              <label class="custom-file-label" for="gambar">Pilih Gambar</label>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
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
<?php foreach ($datadivisi as $dd) : ?>
  <div class="modal fade" id="exampleModaleditdd<?= $dd['id']; ?>" tabindex="-1" aria-labelledby="exampleModaleditdd" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="exampleModaleditdd" style="font-weight: bold;">Edit Data Divisi</h4>
        </div>
        <?php echo form_open_multipart('admin/edit_dd/' . $dd['id']); ?>
        <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" id="judul_jobdesc" value="<?= $dd['judul_jobdesc']; ?>" name="judul_jobdesc" placeholder="Judul Jobdesc">
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" value="" id="gambar" name="gambar">
                <label class="custom-file-label" for="gambar"><?= $dd['gambar'] == NULL || $dd['gambar'] == '' ? 'Pilih Gambar' : $dd['gambar'];  ?></label>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="deskripsi" value="<?= $dd['deskripsi']; ?>" name="deskripsi" placeholder="Deskripsi">
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