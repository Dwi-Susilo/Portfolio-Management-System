<?php if (empty($skills)): ?>
    <div class="card shadow-sm p-5 text-center mt-5">
        <i class="bi bi-briefcase fs-1 text-light mb-3"></i>
        <p class="text-light mb-3">Belum ada data skills.</p>
        <div>
            <a href="/dashboard/skills/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Data Skills
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="card  text-light border-0 shadow-lg rounded-3 overflow-hidden mt-5" style="--bs-table-bg: transparent; backdrop-filter: blur(16px);">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                <thead>
                    <tr class="text-secondary border-bottom border-secondary">
                        <th scope="col" class="text-center" style="width: 50px;">No</th>
                        <th scope="col" style="width: 150px;">Kategori</th>
                        <th scope="col" style="width: 250px;">Skills</th>
                        <th scope="col" style="width: 100px;">Dibuat</th>
                        <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">
                    <?php foreach ($skills as $key => $skill): ?>
                        <tr class="border-bottom border-secondary border-opacity-25">
                            <td class="text-center"><?php echo $key += 1 ?></td>
                            <td><?php echo e($skill['category']) ?></td>
                            <td><?php echo e($skill['skills']) ?></td>
                            <td><?php echo e(date('d M Y', strtotime($skill['created_at']))) ?></td>
                            <td class="text-center">
                                <a href="/dashboard/skills/edit?id=<?php echo encodeId($skill['id']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="/dashboard/skills/delete" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus kategori \'<?php echo ejs($skill['category']) ?>\'?');">
                                    <?php echo csrfField(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $skill['id'] ?>" />
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