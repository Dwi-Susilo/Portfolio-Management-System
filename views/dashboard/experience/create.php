<main class="main">
    <div class="box-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Tambah Experience</h5>
        </div>

        <?php if (hasFlash('alert', 'success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(getAlert('success')); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (hasFlash('alert', 'danger')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(getAlert('danger')); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <form action="" method="POST">
                <?php echo csrfField(); ?>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Posisi</label>
                            <input type="text" name="position" class="form-control <?php echo hasFlash('error', 'position') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('position')) ?>" placeholder="Contoh: Project Controller">
                            <div class="invalid-feedback">
                                <?php echo e(getError('position')); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Perusahaan</label>
                            <input type="text" name="company_name" class="form-control <?php echo hasFlash('error', 'company_name') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('company_name')) ?>" placeholder="Contoh: PT. Telkom Akses">
                            <div class="invalid-feedback">
                                <?php echo e(getError('company_name')); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi</label>
                            <input type="text" name="location" class="form-control <?php echo hasFlash('error', 'location') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('location')) ?>" placeholder="Contoh: Jakarta">
                            <div class="invalid-feedback">
                                <?php echo e(getError('location')); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label class="form-label fw-bold">Mulai Kerja</label>
                                <input type="date" name="start_date" class="form-control <?php echo hasFlash('error', 'start_date') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('start_date')) ?>">
                                <div class="invalid-feedback">
                                    <?php echo e(getError('start_date')); ?>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">Selesai Kerja</label>
                                <div id="end-date-wrapper">
                                    <input type="date" name="end_date" id="end_date" class="form-control <?php echo hasFlash('error', 'end_date') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('end_date')) ?>">
                                    <div class="invalid-feedback">
                                        <?php echo e(getError('end_date')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="still_working" id="masih-bekerja" value="1" onchange="toggleEndDate(this)">
                                <label class="form-check-label" for="masih-bekerja">Masih bekerja di sini</label>
                            </div>
                        </div>

                    </div>

                    <div class="col-6 d-flex flex-column">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" class="form-control <?php echo hasFlash('error', 'description') ? 'is-invalid' : '' ?>" rows="12" placeholder="Jelaskan tanggung jawab dan pencapaian..."><?php echo e(getOld('description')) ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo e(getError('description')); ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/dashboard/experience" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function toggleEndDate(checkbox) {
        const input = document.getElementById('end_date');

        if (checkbox.checked) {
            input.value = '';
            input.setAttribute('disabled', 'disabled');
        } else {
            input.removeAttribute('disabled');
        }
    }
</script>