<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Judul dari halaman role -->
<!-- Mengambil data $title dari controler role -->
<h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

<!-- Isi dari kelola role beserta tabel nya -->
    <div class="row">
        <div class="col-lg-6">

        <!-- Pesan Error berhasil, ketika tambah data -->
        <?= form_error('menu', '<div class="alert alert-success" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <!-- Button Tambah Role -->
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Tambah Role</a>
        <!-- Tabel Tampilan dimenu role -->
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <!-- Isi Tabel Tampilan di menu role dengan mengambil data dari Tabel user_role -->
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($role as $r) : ?>
                <tr>
                    <th class="tengah" scope="row"><?= $i; ?></th>
                    <td><?= $r['role']; ?></td>
                    <!-- Tabel action Edit dan Hapus id data pada tabel user_role sehingga bisa ditampilkan di menu role -->
                    <td class="tengah">
                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning"><i class="fab fa-ubuntu"></i>&nbsp;access</a>
                        <a href="<?= base_url('admin/edit_user/') . $r['id']; ?>" data-toggle="modal" data-target="#exampleRoleModaledit<?= $r['id']; ?>" class="badge badge-success"><i class="fas fa-fw fa-pencil-alt"></i>&nbsp;edit</a>
                    </td>
                    <!-- Perulangan setiap kali data masuk -->
                <?php $i++; ?>
                <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    
  </div>
</div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content --> 
<!-- Akhir halaman    -->

<!-- Modal Tambah role/ ketika di klik button tambah akan menampilkan modal ini-->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="newRoleModalLabel" style="font-weight: bold;">Tambah Data Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/role'); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
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
<?php foreach ($role as $m) : ?>
  <div class="modal fade" id="exampleRoleModaledit<?= $m['id']; ?>" tabindex="-1" aria-labelledby="exampleRoleModaledit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="exampleRoleModaledit" style="font-weight: bold;" >Edit Data Role</h4>
        </div>
        <form action="<?= base_url('admin/edit_user/'); ?><?= $m['id'] ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" id="role" value="<?= $m['role']; ?>" name="role" placeholder="Role name">
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