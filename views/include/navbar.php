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

                    <?php if (isset($_SESSION['isLogin'])): ?>
                        <div class="dropdown ">
                            <button class="btn dropdown-toggle nav-link text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']) ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class=" nav-link" href="/dashboard">Dashboard</a></li>
                                <li><a class=" nav-link" href="/profile">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="logout" method="post" class="">
                                        <?php echo csrfField(); ?>
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