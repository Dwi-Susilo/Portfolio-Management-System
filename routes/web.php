<?php
defined('APP_RUNNING') || abort(403);

// Public Routes
get('/', [ROOT_DIR . '/controllers/siteController.php', 'home']);
post('/', [ROOT_DIR . '/controllers/siteController.php', 'contact']);

// Auth Routes
get('/login', [ROOT_DIR . '/controllers/authController.php', 'login']);
post('/login', [ROOT_DIR . '/controllers/authController.php', 'handleLogin']);
get('/register', [ROOT_DIR . '/controllers/authController.php', 'register']);
post('/register', [ROOT_DIR . '/controllers/authController.php', 'handleRegister']);
post('/dashboard/logout', [ROOT_DIR . '/controllers/authController.php', 'logout']);

// Dashboard Routes
get('/dashboard', [ROOT_DIR . '/controllers/dashboardController.php', 'dashboard']);

// Profile Routes
get('/dashboard/profile', [ROOT_DIR . '/controllers/profileController.php', 'profile']);
get('/dashboard/profile/create', [ROOT_DIR . '/controllers/profileController.php', 'create']);
post('/dashboard/profile/create', [ROOT_DIR . '/controllers/profileController.php', 'handleCreate']);
get('/dashboard/profile/edit', [ROOT_DIR . '/controllers/profileController.php', 'edit']);
post('/dashboard/profile/edit', [ROOT_DIR . '/controllers/profileController.php', 'handleEdit']);
post('/dashboard/profile/delete', [ROOT_DIR . '/controllers/profileController.php', 'delete']);

// Education Routes
get('/dashboard/education', [ROOT_DIR . '/controllers/educationController.php', 'education']);
get('/dashboard/education/create', [ROOT_DIR . '/controllers/educationController.php', 'create']);
post('/dashboard/education/create', [ROOT_DIR . '/controllers/educationController.php', 'handleCreate']);
get('/dashboard/education/edit', [ROOT_DIR . '/controllers/educationController.php', 'edit']);
post('/dashboard/education/edit', [ROOT_DIR . '/controllers/educationController.php', 'handleEdit']);
post('/dashboard/education/delete', [ROOT_DIR . '/controllers/educationController.php', 'delete']);

// Skills Routes
get('/dashboard/skills', [ROOT_DIR . '/controllers/skillsController.php', 'skills']);
get('/dashboard/skills/create', [ROOT_DIR . '/controllers/skillsController.php', 'create']);
post('/dashboard/skills/create', [ROOT_DIR . '/controllers/skillsController.php', 'handleCreate']);
get('/dashboard/skills/edit', [ROOT_DIR . '/controllers/skillsController.php', 'edit']);
post('/dashboard/skills/edit', [ROOT_DIR . '/controllers/skillsController.php', 'handleEdit']);
post('/dashboard/skills/delete', [ROOT_DIR . '/controllers/skillsController.php', 'delete']);

// Experience Routes
get('/dashboard/experience', [ROOT_DIR . '/controllers/experienceController.php', 'experience']);
get('/dashboard/experience/create', [ROOT_DIR . '/controllers/experienceController.php', 'create']);
post('/dashboard/experience/create', [ROOT_DIR . '/controllers/experienceController.php', 'handleCreate']);
get('/dashboard/experience/edit', [ROOT_DIR . '/controllers/experienceController.php', 'edit']);
post('/dashboard/experience/edit', [ROOT_DIR . '/controllers/experienceController.php', 'handleEdit']);
post('/dashboard/experience/delete', [ROOT_DIR . '/controllers/experienceController.php', 'delete']);

// Messages Routes
get('/dashboard/messages', [ROOT_DIR . '/controllers/messagesController.php', 'messages']);
get('/dashboard/messages/show', [ROOT_DIR . '/controllers/messagesController.php', 'show']);
post('/dashboard/messages/delete', [ROOT_DIR . '/controllers/messagesController.php', 'delete']);

// Users Routes
get('/dashboard/users', [ROOT_DIR . '/controllers/usersController.php', 'users']);
get('/dashboard/users/create', [ROOT_DIR . '/controllers/usersController.php', 'create']);
post('/dashboard/users/create', [ROOT_DIR . '/controllers/usersController.php', 'handleCreate']);
get('/dashboard/users/edit', [ROOT_DIR . '/controllers/usersController.php', 'edit']);
post('/dashboard/users/edit', [ROOT_DIR . '/controllers/usersController.php', 'handleEdit']);
post('/dashboard/users/delete', [ROOT_DIR . '/controllers/usersController.php', 'delete']);

// Portfolio Routes
get('/dashboard/portfolio', [ROOT_DIR . '/controllers/portfolioController.php', 'portfolio']);
get('/dashboard/portfolio/create', [ROOT_DIR . '/controllers/portfolioController.php', 'create']);
post('/dashboard/portfolio/create', [ROOT_DIR . '/controllers/portfolioController.php', 'handleCreate']);
get('/dashboard/portfolio/edit', [ROOT_DIR . '/controllers/portfolioController.php', 'edit']);
post('/dashboard/portfolio/edit', [ROOT_DIR . '/controllers/portfolioController.php', 'handleEdit']);
post('/dashboard/portfolio/delete', [ROOT_DIR . '/controllers/portfolioController.php', 'delete']);
