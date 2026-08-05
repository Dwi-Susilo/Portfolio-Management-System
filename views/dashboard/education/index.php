<?php if (empty($educations)): ?>
    <div class="card shadow-sm p-5 text-center mt-5">
        <i class="bi bi-briefcase fs-1 text-light mb-3"></i>
        <p class="text-light mb-3">Belum ada data.</p>
        <div>
            <a href="<?php echo getPath(); ?>/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
    </div>

<?php else: ?>

    <div class="card text-light border-0 shadow-lg rounded-3 overflow-hidden mt-5" style="--bs-table-bg: transparent; backdrop-filter: blur(16px);">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                <thead>
                    <tr class="text-secondary border-bottom border-secondary">
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Intitusi</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col" >Periode</th>
                        <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">
                    <?php $i = 1; ?>
                    <?php foreach ($educations as $education): ?>
                        <tr class="border-bottom border-secondary border-opacity-25">
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td><?php echo e($education['institution_name']) ?></td>
                            <td><?php echo e($education['location']) ?></td>
                            <td>
                                <?php echo e(date('M Y', strtotime($education['start_year']))) ?>
                                &ndash;
                                <?php echo $education['end_year'] ? e(date('M Y', strtotime($education['end_year']))) : 'Sekarang' ?>
                            </td>
                            <td>
                                <a href="<?php echo getPath(); ?>/edit?id=<?php echo encodeId($education['id']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="<?php echo getPath(); ?>/delete" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus experience \'<?php echo e(addslashes($education['position'])) ?>\'?');">
                                    <?php echo csrfField(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $education['id'] ?>" />
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

