<?php if (empty($messages)): ?>
    <div class="card shadow-sm p-5 text-center mt-5">
        <i class="bi bi-briefcase fs-1 text-light mb-3"></i>
        <p class="text-light mb-3">Belum ada Pesan masuk.</p>
    </div>

<?php else: ?>

    <div class="card text-light border-0 shadow-lg rounded-3 overflow-hidden mt-5" style="--bs-table-bg: transparent; backdrop-filter: blur(16px);">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                <thead>
                    <tr class="text-secondary border-bottom border-secondary">
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Pengirim</th>
                        <th scope="col">Subjek</th>
                        <th scope="col" >Tanggal</th>
                        <th scope="col" >Status</th>
                        <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">
                    <?php $i = 1; ?>
                    <?php foreach ($messages as $index => $msg): ?>
                        <!-- Efek cetak tebal (fw-bold) jika pesan is_read == 0 -->
                        <tr class="border-secondary <?php echo $msg['is_read'] == 0 ? 'fw-bold text-white' : 'text-secondary' ?>">
                            <td class="text-center"><?php echo $index + 1 ?></td>
                            <td>
                                <div class="<?php echo $msg['is_read'] == 0 ? 'text-white' : 'text-light' ?>">
                                    <?php echo htmlspecialchars($msg['name']) ?>
                                </div>
                                <small class=" fw-normal d-block"><?php echo e($msg['email']) ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($msg['subject']) ?></td>
                            <td class="fw-normal"><?php echo date('d M Y H:i', strtotime($msg['created_at'])) ?></td>
                            <td>
                                <?php if ($msg['is_read'] == 0): ?>
                                    <span class="badge bg-primary">Belum dibaca</span>
                                <?php else: ?>
                                    <span ></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/dashboard/messages/show?id=<?php echo encodeId($msg['id']) ?>"
                                    class="btn btn-sm btn-outline-primary me-2"
                                    title="Lihat Detail Pesan">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="/dashboard/messages/delete" method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari <?php echo htmlspecialchars($msg['name']) ?>?')">
                                    <?php echo csrfField(); ?>
                                    <input type="hidden" name="id" value="<?php echo $msg['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Pesan">
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

