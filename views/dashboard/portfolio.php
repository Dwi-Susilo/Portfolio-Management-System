<?php
    if (! file_exists('model/portfolios.php')) {
    abort(500);
    }
?>
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

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($portfolios as $portfolio): ?>
                    <tr>
                        <td>
                            <img
                            src="<?php echo BASE_URL ?>/assets/img/portfolio/<?php echo e($portfolio['image']) ?>" alt="<?php echo e($portfolio['title']) ?>" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;"/>
                        </td>
                        <td><?php echo e($portfolio['title']) ?></td>
                        <td><?php echo e(mb_strimwidth($portfolio['description'], 0, 80, '...')) ?></td>
                        <td><?php echo e(date('d M Y', strtotime($portfolio['created_at']))) ?></td>
                        <td class="text-end">
                        <a href="/dashboard/portfolio/edit?id=<?php echo (int) $portfolio['id'] ?>" class="btn btn-sm btn-outline-primary">
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
