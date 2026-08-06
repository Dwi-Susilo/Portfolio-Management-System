<?php
    $iconOptions = [
    'bi bi-diagram-3'    => 'Diagram',
    'bi bi-broadcast'    => 'Broadcast',
    'bi bi-people'       => 'People',
    'bi bi-pc-display'   => 'Komputer',
    'bi bi-code-slash'   => 'Coding',
    'bi bi-database'     => 'Database',
    'bi bi-hdd-network'  => 'Jaringan',
    'bi bi-gear'         => 'Teknis',
    'bi bi-shield-check' => 'Keamanan',
    'bi bi-palette'      => 'Desain',
    ];

    $oldIcon = getOld('icon');
    $isKnown = array_key_exists($oldIcon, $iconOptions);
?>

<style>
    .icon-radio {
        display: none;
    }

    .icon-card {
        border: 2px solid #343a40;
        border-radius: 10px;
        padding: 15px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        background-color: #1a1d20;
        color: #a8b2d1;
    }

    .icon-card:hover {
        border-color: #0d6efd;
        background-color: #212529;
        color: #fff;
        transform: translateY(-3px);
    }

    .icon-radio:checked + .icon-card {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.15);
        color: #0d6efd;
        box-shadow: 0 0 12px rgba(13, 110, 253, 0.4);
    }
</style>

<form action="/dashboard/skills/create" method="POST" class="mt-4">
    <?php echo csrfField(); ?>

    <div class="row">
        <div class="col px-5 mb-3">
            <div class="mb-3">
                <label for="category" class="form-label">Nama Kategori</label>
                <input type="text" name="category" id="category" class="form-control <?php echo hasFlash('error', 'category') ? 'is-invalid' : '' ?>"
                    value="<?php echo e(getOld('category')) ?>"
                    placeholder="Contoh Jaringan">
                <div class="invalid-feedback">
                    <?php echo e(getError('category')); ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Daftar Keahlian (pisahkan dengan koma)</label>
                <textarea name="skills" id="skills" class="form-control <?php echo hasFlash('error', 'skills') ? 'is-invalid' : '' ?>" rows="6"
                          placeholder="Contoh: Project Control, Reporting, Cost Estimation"><?php echo e(getOld('skills')) ?></textarea>
                <div class="invalid-feedback">
                    <?php echo e(getError('skills')); ?>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label class="form-label d-block fw-bold">Pilih Ikon Kategori</label>
                <div class="row g-3">
                    <?php foreach ($iconOptions as $value => $label): ?>
                        <div class="col-4 col-sm-3 col-md-2">
                            <label class="w-100">
                                <input type="radio" name="icon" value="<?php echo e($value) ?>" class="icon-radio"
                                       <?php echo($oldIcon === $value) ? 'checked' : '' ?>>
                                <div class="icon-card">
                                    <i class="<?php echo e($value) ?> fs-2 d-block mb-1"></i>
                                    <small class="d-block text-truncate"><?php echo e($label) ?></small>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <!-- Opsi "Lainnya" -->
                    <div class="col-4 col-sm-3 col-md-2">
                        <label class="w-100">
                            <input type="radio" name="icon_choice_marker" id="radio-custom" class="icon-radio"
                                   <?php echo(! $isKnown && $oldIcon) ? 'checked' : '' ?>
                                   onchange="toggleCustomIcon(this.checked)">
                            <div class="icon-card">
                                <i class="bi bi-three-dots fs-2 d-block mb-1"></i>
                                <small class="d-block text-truncate">Lainnya</small>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="custom-icon-wrapper" class="mt-3" style="<?php echo(! $isKnown && $oldIcon) ? '' : 'display:none;' ?>">
                    <label for="icon-custom" class="form-label">Ketik nama icon manual</label>
                    <input type="text" id="icon-custom" class="form-control"
                           placeholder="Contoh: bi bi-rocket-takeoff"
                           value="<?php echo(! $isKnown && $oldIcon) ? e($oldIcon) : '' ?>"
                           oninput="syncCustomIcon(this.value.trim())">
                    <small class="text-muted">
                        Cari nama lengkap di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a> (contoh format: <code>bi bi-nama-icon</code>)
                    </small>
                </div>

                <!-- Ini yang beneran dikirim ke server saat mode custom aktif -->
                <input type="hidden" name="icon_custom_value" id="icon-hidden-final"
                       value="<?php echo(! $isKnown && $oldIcon) ? e($oldIcon) : '' ?>">

                <div class="<?php echo hasFlash('error', 'icon') ? 'text-danger small mt-1' : 'd-none' ?>">
                    <?php echo e(getError('icon')); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="px-5 justify-content-end mb-5">
        <a href="/dashboard/skills" class="btn btn-secondary px-4">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Data</button>

    </div>
</form>

<script>
function toggleCustomIcon(isChecked) {
    const wrapper = document.getElementById('custom-icon-wrapper');
    const hiddenInput = document.getElementById('icon-hidden-final');
    const customInput = document.getElementById('icon-custom');

    if (isChecked) {
        wrapper.style.display = 'block';

        document.querySelectorAll('input[name="icon"]').forEach(r => r.checked = false);
        hiddenInput.value = customInput.value.trim();
    } else {
        wrapper.style.display = 'none';
        hiddenInput.value = '';
    }
}

function syncCustomIcon(value) {
    document.getElementById('icon-hidden-final').value = value;
}

document.querySelectorAll('input[name="icon"]').forEach(radio => {
    radio.addEventListener('change', function () {
        document.getElementById('radio-custom').checked = false;
        document.getElementById('custom-icon-wrapper').style.display = 'none';
        document.getElementById('icon-hidden-final').value = '';
    });
});
</script>