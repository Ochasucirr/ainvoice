<div class="container">
   <!-- Card / Kotak Form nya -->
   <!-- Card Putih -->
    <div class="row justify-content-center">
    <div class="col-lg-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">

    <!-- Card Body -->
        <div class="row">
        <div class="col-lg">
        <div class="p-5">
        <div class="text-center">
        <h1 class="h4 text-danger-900 mb-4" style="font-weight: bold;">LOGIN</h1>
        </div>
            <!-- Pesan error/Berhasil-->
            <?= $this->session->flashdata('message'); ?>
            
            <!-- Form Putih-->
            <form class="user" method="post" action="<?= base_url('auth'); ?>">
                <!-- Username -->
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Username">
                        <!-- Form Error  -->
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                <!-- Password -->
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                        <!-- Form Error -->
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                <!-- Button Login -->
                    <button type="submit" class="btn btn-primary btn-user btn-block" style="font-size:medium;">Login</button>
            </form>

            <!-- spasi  -->
            <hr>
            <br>
            <div class="centered-content">
            <p class="text-danger-900" style="font-weight: bold;">Perlu bantuan?</p>
            <a href="https://wa.me/6281310825619" class="centered-image">
                <img src="<?= base_url('logo.png'); ?>" alt="Logo" width="70" height="52">
            </a>
            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="<?= base_url(); ?>"><button type="button" class="btn btn-light" style="font-weight: 600;">Kembali</button></a>

        </div>
    </div>
</div>

