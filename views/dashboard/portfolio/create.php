<?php
    if (! file_exists(ROOT_DIR . '/model/portfolios.php')) {
    abort(500);
    }
?>

<main class="main">
    <div class="box-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Tambah Portfolio</h5>

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

        <div class="">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php echo csrfField(); ?>
                <div class="row g-4">
                    <!-- Kolom Kiri: Upload & Preview Foto -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Photo</label>

                            <!-- Tempat Preview Gambar -->
                            <div class="mb-3 text-center">
                                <img id="img-preview" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJD7nwnklV7l87_fnonhaZfrCfIwGkJKvl8vcK8M9BAA&s=10"
                                     class="img-fluid rounded border mb-2 "
                                     alt="Preview Gambar"
                                     style="max-height: 230px; width: 100%; object-fit: cover;">
                            </div>

                            <input type="file" name="image" id="input-gambar" class="form-control <?php echo hasFlash('error', 'image') ? 'is-invalid' : '' ?>" accept="image/*" required onchange="previewImage(event)">
                            <div  class="invalid-feedback">
                                <?php echo e(getError('image')); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Input Form -->
                    <div class="col-md-8 px-5">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Proyek</label>
                            <input type="text" name="title" class="form-control <?php echo hasFlash('error', 'title') ? 'is-invalid' : '' ?>" value="<?php echo e(getOld('title')) ?>" placeholder="Masukkan nama proyek..." required>
                            <div  class="invalid-feedback">
                                <?php echo e(getError('title')); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <textarea name="description" class="form-control <?php echo hasFlash('error', 'description') ? 'is-invalid' : '' ?>" rows="5" placeholder="Masukkan deskripsi..." required><?php echo e(getOld('description')) ?></textarea>
                            <div  class="invalid-feedback">
                                <?php echo e(getError('description')); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4 px-5">
                    <a href="/dashboard/portfolio" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" name="add_portfolio" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>

    </div>
</main>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>