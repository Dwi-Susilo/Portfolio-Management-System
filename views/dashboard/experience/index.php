<div class="main">
    <div class="box-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Daftar Experience</h5>
            <?php if (! empty($experiences)): ?>
                <a href="/dashboard/experience/create" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Experience
                </a>
            <?php endif; ?>
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

        <?php if (empty($experiences)): ?>
            <div class="card shadow-sm p-5 text-center">
                <i class="bi bi-briefcase fs-1 text-light mb-3"></i>
                <p class="text-light mb-3">Belum ada experience.</p>
                <div>
                    <a href="/dashboard/experience/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Experience
                    </a>
                </div>
            </div>

        <?php else: ?>

            <div class="card text-light border-0 shadow-lg rounded-3 overflow-hidden" style="--bs-table-bg: transparent; backdrop-filter: blur(16px);">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                        <thead>
                            <tr class="text-secondary border-bottom border-secondary">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Perusahaan</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col" >Periode</th>
                                <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px;">
                            <?php $i = 1; ?>
                            <?php foreach ($experiences as $experience): ?>
                                <tr class="border-bottom border-secondary border-opacity-25">
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><?php echo e($experience['position']) ?></td>
                                    <td><?php echo e($experience['company_name']) ?></td>
                                    <td><?php echo e($experience['location']) ?></td>
                                    <td>
                                        <?php echo e(date('M Y', strtotime($experience['start_date']))) ?>
                                        &ndash;
                                        <?php echo $experience['end_date'] ? e(date('M Y', strtotime($experience['end_date']))) : 'Sekarang' ?>
                                    </td>
                                    <td>
                                        <a href="/dashboard/experience/edit?id=<?php echo encodeId($experience['id']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="/dashboard/experience/delete" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus experience \'<?php echo e(addslashes($experience['position'])) ?>\'?');">
                                            <?php echo csrfField(); ?>
                                            <input type="hidden" name="id" value="<?php echo (int) $experience['id'] ?>" />
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>









    </div>
</div>
