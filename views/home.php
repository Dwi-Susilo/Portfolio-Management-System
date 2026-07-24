
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
<div class="container">
<a class="navbar-brand fw-bold fs-4" href="#">Dendy<span class="accent-text">.N</span></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto text-uppercase">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
        <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
        <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
    </ul>
    <div class="navbar-nav text-uppercase">
        <div class="nav-item">
            <?php if ($_SESSION['isLogin']): ?>
                <div class="dropdown ">
                    <button class="btn dropdown-toggle nav-link text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username'] ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class=" nav-link" href="/dashboard">Dashboard</a></li>
                        <li><a class=" nav-link" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="logout" method="post" class="">
                                <button type="submit" name="logout" class=" nav-link text-uppercase" >logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

            <?php else: ?>
                <a class="nav-link auth" href="login">
                    <i class="bi bi-lock me-2"></i>
                    Admin Login
                </a>

            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</nav>

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
    <!-- Exp 1 -->
    <div class="timeline-item">
        <div class="glass-card p-4 ms-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h4 class="mb-0">Project Controller</h4>
            <span class="badge bg-primary">2024 - Sekarang</span>
        </div>
        <h6 class="accent-text mb-3">PT. Telkom Akses | Jakarta</h6>
        <p class="text-muted text-desc small">
            Pengawasan seluruh proses proyek agar sesuai jadwal yang ditetapkan mulai dari survei dan akuisisi lokasi, negosiasi perizinan dengan pihak pemerintah setempat, implementasi, uji terima, hingga penyelesaian administrasi
            untuk proses penagihan kepada klien.
        </p>
        </div>
    </div>
    <!-- Exp 2 -->
    <div class="timeline-item">
        <div class="glass-card p-4 ms-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h4 class="mb-0">Team Leader Assurance FTTH</h4>
            <span class="badge bg-secondary">2020 - 2024</span>
        </div>
        <h6 class="accent-text mb-3">PT. Telkom Akses | Jakarta</h6>
        <p class="text-muted text-desc small">
            Memimpin dan mengawasi tim teknis di lapangan, memastikan hasil pekerjaan memenuhi standar teknis, menyelesaikan kendala ROW, serta mengelola material dan tenaga kerja secara efisien.
        </p>
        </div>
    </div>
    <!-- Exp 3 -->
    <div class="timeline-item">
        <div class="glass-card p-4 ms-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h4 class="mb-0">Helpdesk Assurance</h4>
            <span class="badge bg-secondary">2018 - 2020</span>
        </div>
        <h6 class="accent-text mb-3">PT. Telkom Akses | Jakarta</h6>
        <p class="text-muted text-desc small">Memantau performa jaringan menggunakan NMS, mengelola Trouble Ticket sesuai SLA, dan melakukan koordinasi eskalasi intensif dengan tim Tier 2/3.</p>
        </div>
    </div>
    <!-- Exp 4 -->
    <div class="timeline-item">
        <div class="glass-card p-4 ms-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h4 class="mb-0">Surveyor Icon+</h4>
            <span class="badge bg-secondary">2015 - 2017</span>
        </div>
        <h6 class="accent-text mb-3">PT. Gerbang Sinergi Prima | Jakarta</h6>
        <p class="text-muted text-desc small">Survei jalur kabel fiber optik, menentukan titik optimal ODC/ODP, menghitung BoQ, dan menyusun Laporan Hasil Survei (LHS) menggunakan Google Earth/GIS.</p>
        </div>
    </div>
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
    <div class="col-md-4">
        <div class="glass-card overflow-hidden">
        <img src="assets/img/FTTH Network Deployment.jpg" class="img-fluid" alt="Project" />
        <div class="p-4">
            <h5>FTTH Network Deployment</h5>
            <p class="text-muted text-desc small">Placeholder for large-scale fiber optic infrastructure projects managed under PT. Telkom Akses.</p>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card overflow-hidden">
        <img src="assets/img/Network Assurance System.jpg" class="img-fluid" alt="Project" />
        <div class="p-4">
            <h5>Network Assurance System</h5>
            <p class="text-muted text-desc small">Implementation of SLA-based troubleshooting protocols and preventive maintenance for regional nodes.</p>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card overflow-hidden">
        <img src="assets/img/GIS.jpeg" class="img-fluid" alt="Project" />
        <div class="p-4">
            <h5>GIS & Site Surveying</h5>
            <p class="text-muted text-desc small">Detailed route mapping and Bill of Quantity preparation for underground and aerial cabling projects.</p>
        </div>
        </div>
    </div>
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
        <div class="timeline-item">
            <div class="glass-card p-4 ms-3">
            <h5>Universitas Asa Indonesia</h5>
            <span class="accent-text">2024 - Sekarang</span>
            </div>
        </div>
        <div class="timeline-item">
            <div class="glass-card p-4 ms-3">
            <h5>SMK Negeri 7 Jakarta</h5>
            <span class="accent-text">2007 - 2010</span>
            </div>
        </div>
        <div class="timeline-item">
            <div class="glass-card p-4 ms-3">
            <h5>SMP Negeri 158 Jakarta</h5>
            <span class="accent-text">2006 - 2008</span>
            </div>
        </div>
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
