<?php
    /** @var array $portfolios */
    /** @var array $experiences */
    /** @var array $educations */
?>

<header>
    <!-- Hero Section -->
    <section id="home" class="section hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-10">
                    <h5 class="accent-text mb-3">Welcome to my professional profile</h5>
                    <h1 class="display-3 fw-bold mb-3">Dendy Novianto</h1>
                    <h3 class="h4 text-muted text-desc mb-4">Project Controller | FTTH Specialist</h3>
                    <p class="lead text-muted text-desc mb-5">
                    Seorang expert dalam FTTH ataupun FTTX dengan pengalaman lebih dari 10 tahun. Spesialis dalam pengawasan proyek, manajemen teknis lapangan, dan optimasi infrastruktur jaringan telekomunikasi.
                    </p>

                    <div class="d-flex gap-3">
                        <a href="#portfolio" class="btn btn-primary-custom">View Portfolio</a>
                        <a href="#contact" class="btn btn-outline-custom">Contact Me</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>

<main>
    <!-- About Section -->
    <section id="about" class="section py-5">
        <div class="container">
            <h2 class="section-title text-center">About <span class="accent-text">Me</span></h2>
            <div class="row justify-content-center">
                <div class="glass-card p-5">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <img src="assets/img/christopher-campbell.jpg" alt="Dendy Novianto" class="profile-img" />
                        </div>
                        <div class="col-md-8 align-content-center">
                            <h4 class="accent-text text-center mb-4">Professional Summary</h4>
                            <p class="text-muted text-desc">
                            Memiliki rekam jejak yang kuat dalam mengelola siklus hidup proyek FTTH, mulai dari survei lokasi, akuisisi, hingga implementasi dan uji terima. Ahli dalam koordinasi tim lintas fungsi dan manajemen pemangku kepentingan
                            untuk memastikan target operasional tercapai tepat waktu.
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="section py-5 bg-opacity-10 bg-light">
        <div class="container">
            <h2 class="section-title">Work <span class="accent-text">Experience</span></h2>
            <div class="timeline">
            <?php $i = 1; ?>
            <?php foreach ($experiences as $index => $experience): ?>
                <?php
                    $start_year = ! empty($experience['start_date']) ? date('Y', strtotime($experience['start_date'])) : '';

                    if (empty($experience['end_date']) || $experience['end_date'] == '0000-00-00' || strtolower($experience['end_date']) == 'present') {
                        $end_year = 'Sekarang';
                    } else {
                        $end_year = date('Y', strtotime($experience['end_date']));
                    }

                    $badge_class = ($index === 0) ? 'bg-primary' : 'bg-secondary text-white opacity-75';
                ?>
                <!-- Exp <?php echo $index + 1; ?> -->
                <div class="timeline-item">
                    <div class="glass-card p-4 ms-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="mb-0"><?php echo e($experience['position']); ?></h4>
                            <span class="badge <?php echo $badge_class; ?>">
                                <?php echo e($start_year); ?> – <?php echo e($end_year); ?>
                            </span>
                        </div>
                        <h6 class="accent-text mb-3"><?php echo e($experience['company_name']); ?> | <?php echo e($experience['location']); ?></h6>
                        <p class="text-muted text-desc small">
                            <?php echo e($experience['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section py-5">
        <div class="container">
            <h2 class="section-title text-center">Technical <span class="accent-text">Arsenal</span></h2>
            <div class="row g-4">
            <div class="col-md-3">
                <div class="glass-card p-4 text-center h-100">
                <i class="bi bi-diagram-3 fs-1 accent-text mb-3"></i>
                <h5>Manajemen Proyek</h5>
                <div class="mt-3">
                    <span class="skill-badge">Project Control</span>
                    <span class="skill-badge">Reporting</span>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center h-100">
                <i class="bi bi-broadcast fs-1 accent-text mb-3"></i>
                <h5>Telekomunikasi</h5>
                <div class="mt-3">
                    <span class="skill-badge">FTTH/FTTX</span>
                    <span class="skill-badge">Fiber Optic</span>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center h-100">
                <i class="bi bi-people fs-1 accent-text mb-3"></i>
                <h5>Interpersonal</h5>
                <div class="mt-3">
                    <span class="skill-badge">Leadership</span>
                    <span class="skill-badge">Negotiation</span>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center h-100">
                <i class="bi bi-pc-display fs-1 accent-text mb-3"></i>
                <h5>Komputasi</h5>
                <div class="mt-3">
                    <span class="skill-badge">GIS/Google Earth</span>
                    <span class="skill-badge">NMS</span>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section (Placeholders) -->
    <section id="portfolio" class="section py-5 bg-opacity-10 bg-light">
        <div class="container">
            <h2 class="section-title">Featured <span class="accent-text">Work</span></h2>
            <div class="row g-4">
                <?php foreach ($portfolios as $portfolio): ?>
                    <div class="col-md-4">
                        <div class="glass-card overflow-hidden">
                            <img src="<?php echo BASE_URL ?>/assets/img/upload/portfolio/<?php echo e($portfolio['image']) ?>" class="img-fluid" alt="<?php echo e($portfolio['title']) ?>" />
                            <div class="p-4">
                                <h5><?php echo e($portfolio['title']) ?></h5>
                                <p class="text-muted text-desc small"><?php echo e($portfolio['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="section py-5">
        <div class="container">
            <h2 class="section-title text-center">Academic <span class="accent-text">History</span></h2>
            <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="timeline">
                    <?php foreach ($educations as $education): ?>
                        <?php
                            $startYearEducation = ! empty($education['start_date']) ? date('Y', strtotime($education['start_date'])) : '';

                            if (empty($education['end_date']) || $education['end_date'] == '0000-00-00' || strtolower($education['end_date']) == 'present') {
                                $endYearEducation = 'Sekarang';
                            } else {
                                $endYearEducation = date('Y', strtotime($education['end_date']));
                            }

                        ?>
                        <div class="timeline-item">
                            <div class="glass-card p-4 ms-3">
                            <h5><?php echo e($education['institution_name']); ?></h5>
                            <span class="accent-text">
                                <?php echo e($startYearEducation); ?> – <?php echo e($endYearEducation); ?>
                            </span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section py-5">
        <div class="container">
            <h2 class="section-title text-center">Get In <span class="accent-text">Touch</span></h2>
            <div class="row g-5">
            <div class="col-lg-5">
                <div class="glass-card p-5 h-100">
                <h4 class="mb-4">Contact Information</h4>
                <div class="d-flex mb-4">
                    <i class="bi bi-geo-alt accent-text fs-4 me-3"></i>
                    <p class="text-muted text-desc mb-0">Perumnas Klender, Jaktim</p>
                </div>
                <div class="d-flex mb-4">
                    <i class="bi bi-envelope accent-text fs-4 me-3"></i>
                    <p class="text-muted text-desc mb-0">dendinovianto@gmail.com</p>
                </div>
                <div class="d-flex mb-4">
                    <i class="bi bi-telephone accent-text fs-4 me-3"></i>
                    <p class="text-muted text-desc mb-0">+6281286687844</p>
                </div>
                <div class="mt-5">
                    <h5 class="mb-3">Social Connections</h5>
                    <div class="d-flex gap-3">
                    <a href="https://www.linkedin.com/" target="_blank" class="btn btn-outline-custom p-2 px-3"><i class="bi bi-linkedin"></i></a>
                    <a href="https://github.com/" target="_blank" class="btn btn-outline-custom p-2 px-3"><i class="bi bi-github"></i></a>
                    <a href="https://www.instagram.com/" target="_blank" class="btn btn-outline-custom p-2 px-3"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="glass-card p-5">
                <form id="contactForm" action="" method="post">
                    <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted text-desc">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required autocomplete="off" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted text-desc">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label small text-muted text-desc">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label small text-muted text-desc">Message</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Your Message"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-custom w-100">Send Message</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <p class="text-center text-muted text-desc mb-0">&copy; 2026 Dendy Novianto. Seluruh hak cipta dilindungi.</p>
    </div>
</footer>
