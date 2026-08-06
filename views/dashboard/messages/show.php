<?php
    /** @var array $message */
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h1 class="h3 text-light">Detail Pesan dari <?php echo e($message['name']) ?></h1>
    <a href="/dashboard/messages" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Kotak Masuk
    </a>
</div>

<div class="card bg-dark text-light border-secondary shadow-sm">
    <div class="card-header border-secondary bg-dark d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="mb-1 text-white"><?php echo e($message['subject']) ?></h5>
            <small class="text-secondary">
                Dari: <strong class="text-light"><?php echo e($message['name']) ?></strong>
                (&lt;<a href="mailto:<?php echo e($message['email']) ?>" class="text-info"><?php echo e($message['email']) ?></a>&gt;)
            </small>
        </div>
        <div class="text-end">
            <span class="badge bg-secondary mb-1">
                <?php echo date('d M Y H:i', strtotime($message['created_at'])) ?>
            </span>
        </div>
    </div>

    <div class="card-body p-4">
        <!-- Isi Pesan Utama -->
        <div class="p-3 bg-secondary bg-opacity-10 rounded border border-secondary text-light mb-4" style="min-height: 180px; font-size: 1rem; line-height: 1.6;">
            <?php echo nl2br(e($message['message'])) ?>
        </div>

        <!-- Tombol Aksi Tambahan -->
        <div class="d-flex justify-content-between align-items-center">
            <a href="mailto:<?php echo e($message['email']) ?>?subject=Re: <?php echo urlencode($message['subject']) ?>"
               class="btn btn-primary">
                <i class="bi bi-reply-fill me-1"></i> Balas via Email
            </a>

            <form action="/dashboard/messages/delete" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari <?php echo ejs($message['name'] ?? $message['name']) ?>?')">
                <?php echo csrfField(); ?>
                <input type="hidden" name="id" value="<?php echo (int) $message['id'] ?>" />
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>