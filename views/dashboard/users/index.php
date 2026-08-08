<?php if (empty($users)): ?>
    <div class="card shadow-sm p-5 text-center mt-5">
        <i class="bi bi-people fs-1 text-light mb-3"></i>
        <p class="text-light mb-3">Belum ada user.</p>
        <div>
            <a href="/dashboard/users/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah User
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
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dibuat</th>
                        <th scope="col">Login Terakhir</th>
                        <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">
                    <?php foreach ($users as $index => $u): ?>
                        <?php
                            $isSelf    = $u['id'] === (int) ($_SESSION['user_id'] ?? 0);
                            $canDelete = (($_SESSION['role'] ?? null) === 'super_admin') && ! $isSelf;
                        ?>
                        <tr class="border-bottom border-secondary border-opacity-25">
                            <td class="text-center"><?php echo $index + 1 ?></td>
                            <td>
                                <?php echo e($u['username']) ?>
                                <?php if ($isSelf): ?>
                                    <span class="badge bg-secondary ms-1">Anda</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($u['email']) ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($u['created_at']))) ?></td>
                            <td>
                                <?php echo $u['last_login'] ? e(date('d-m-y H:i', strtotime($u['last_login']))) : '-' ?>
                            </td>
                            <td class="text-center">
                                <a href="/dashboard/users/edit?id=<?php echo encodeId($u['id']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <?php if ($canDelete): ?>
                                    <form action="/dashboard/users/delete" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin mau hapus user \'<?php echo eJs($u['username']) ?>\'?')">
                                        <?php echo csrfField(); ?>
                                        <input type="hidden" name="id" value="<?php echo (int) $u['id'] ?>" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php endif; ?>