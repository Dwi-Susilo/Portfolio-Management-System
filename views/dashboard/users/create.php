<div class="mt-4">
    <form action="" method="POST">
        <?php echo csrfField(); ?>
        <div class="row pt-4">
            <div class="col-4 ps-5">
                <img src="<?php BASE_URL?>/assets/img/login.jpg" alt="login.jpg" class="" style="width: auto; height: 400px;" />
            </div>

            <div class="col px-5">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control <?php echo hasFlash('error', 'username') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('username')) ?>" required autocomplete="off">
                    <div class="invalid-feedback">
                        <?php echo e(getError('username')); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control <?php echo hasFlash('error', 'email') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('email')) ?>">
                    <div class="invalid-feedback">
                        <?php echo e(getError('email')); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control <?php echo hasFlash('error', 'password') ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo e(getError('password')); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control <?php echo hasFlash('error', 'cpassword') ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo e(getError('cpassword')); ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/dashboard/users" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </div>
        </div>

    </form>
</div>
