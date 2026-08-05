<div class="mt-4">
    <form action="" method="POST">
        <?php echo csrfField(); ?>

            <div class=" px-5">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Intitusi</label>
                    <input type="text" name="institution_name" class="form-control <?php echo hasFlash('error', 'institution_name') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('institution_name')) ?>" placeholder="Contoh: Universitas Asa Indonesia">
                    <div class="invalid-feedback">
                        <?php echo e(getError('institution_name')); ?>
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
                        <label class="form-label fw-bold">Mulai Pendidikan</label>
                        <input type="date" name="start_year" class="form-control <?php echo hasFlash('error', 'start_year') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('start_year')) ?>">
                        <div class="invalid-feedback">
                            <?php echo e(getError('start_year')); ?>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold">Selesai Pendidikan</label>
                        <div id="end-date-wrapper">
                            <input type="date" name="end_year" id="end_year" class="form-control <?php echo hasFlash('error', 'end_year') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('end_year')) ?>">
                            <div class="invalid-feedback">
                                <?php echo e(getError('end_year')); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" name="is_current" id="is_current" value="1" onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current">Belum selesai</label>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/dashboard/experience" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </div>

    </form>
</div>


<script>
    function toggleEndDate(checkbox) {
        const input = document.getElementById('end_year');

        if (checkbox.checked) {
            input.value = '';
            input.setAttribute('disabled', 'disabled');
        } else {
            input.removeAttribute('disabled');
        }
    }
</script>