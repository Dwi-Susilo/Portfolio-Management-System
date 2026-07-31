<main class="main">
    <div class="box-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Daftar Portfolio</h5>
            <a href="/dashboard/portfolio/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Portfolio
            </a>
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

        <?php if (empty($portfolios)): ?>

        <!-- Empty state -->
            <div class="card shadow-sm p-5 text-center">
                <i class="bi bi-briefcase fs-1 text-light mb-3"></i>
                <p class="text-light mb-3">Belum ada portfolio.</p>
                <div>
                <a href="/dashboard/portfolio/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Portfolio
                </a>
                </div>
            </div>

        <?php else: ?>

        <div class="card  text-light border-0 shadow-lg rounded-3 overflow-hidden" style="--bs-table-bg: transparent; backdrop-filter: blur(16px);">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                    <thead>
                        <tr class="text-secondary border-bottom border-secondary">
                            <th scope="col" style="width: 100px;">Gambar</th>
                            <th scope="col" style="width: 200px;">Judul</th>
                            <th scope="col" style="width: 250px;">Deskripsi</th>
                            <th scope="col" style="width: 120px;">Dibuat</th>
                            <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                        <?php foreach ($portfolios as $portfolio): ?>

                        <tr class="border-bottom border-secondary border-opacity-25" >
                            <td>
                                <img
                                src="<?php echo BASE_URL ?>/assets/img/portfolio/<?php echo e($portfolio['image']) ?>" alt="<?php echo e($portfolio['title']) ?>" style="width: 120px; height: 60px; object-fit: cover; border-radius: 4px;"/>
                            </td>
                            <td><?php echo e($portfolio['title']) ?></td>
                            <td><?php echo e(mb_strimwidth($portfolio['description'], 0, 80, '...')) ?></td>
                            <td><?php echo e(date('d M Y', strtotime($portfolio['created_at']))) ?></td>
                            <td class="">
                                <a href="/dashboard/portfolio/edit?id=<?php echo encodeId($portfolio['id']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="/dashboard/portfolio/delete" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus portfolio \'<?php echo e(addslashes($portfolio['title'])) ?>\'?');">
                                    <?php echo csrfField(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $portfolio['id'] ?>" />
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
</main>
