<?php
require_once 'includes/functions.php';

$pageTitle = '404 - Halaman Tidak Ditemukan | ' . getSetting('nama_web');
$pageDesc = 'Oops! Halaman yang Anda cari tidak ditemukan';
$pageUrl = BASE_URL;

// Get random articles for suggestion
$randomBerita = getAllBerita(3);

include 'includes/header.php';
?>

<style>
/* 404 Page Styles */
.error-page {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.error-container {
    text-align: center;
    z-index: 10;
    padding: 2rem;
}

/* Glitch Effect for 404 */
.glitch-wrapper {
    position: relative;
    display: inline-block;
}

.glitch {
    font-size: 10rem;
    font-weight: 900;
    color: #FFD700;
    position: relative;
    text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    animation: float 3s ease-in-out infinite;
}

.glitch::before,
.glitch::after {
    content: '404';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.glitch::before {
    color: #ff00ff;
    animation: glitch-1 2s infinite linear alternate-reverse;
    clip-path: polygon(0 0, 100% 0, 100% 35%, 0 35%);
}

.glitch::after {
    color: #00ffff;
    animation: glitch-2 3s infinite linear alternate-reverse;
    clip-path: polygon(0 65%, 100% 65%, 100% 100%, 0 100%);
}

@keyframes glitch-1 {
    0% { transform: translateX(0); }
    20% { transform: translateX(-3px); }
    40% { transform: translateX(3px); }
    60% { transform: translateX(-3px); }
    80% { transform: translateX(3px); }
    100% { transform: translateX(0); }
}

@keyframes glitch-2 {
    0% { transform: translateX(0); }
    20% { transform: translateX(3px); }
    40% { transform: translateX(-3px); }
    60% { transform: translateX(3px); }
    80% { transform: translateX(-3px); }
    100% { transform: translateX(0); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Slot Machine Animation */
.slot-icons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 2rem 0;
}

.slot-icon {
    font-size: 3rem;
    animation: spin-slot 1s ease-in-out;
    display: inline-block;
}

.slot-icon:nth-child(1) { animation-delay: 0s; }
.slot-icon:nth-child(2) { animation-delay: 0.2s; }
.slot-icon:nth-child(3) { animation-delay: 0.4s; }

@keyframes spin-slot {
    0% { transform: rotateX(0deg); opacity: 0; }
    50% { transform: rotateX(180deg); opacity: 0.5; }
    100% { transform: rotateX(360deg); opacity: 1; }
}

/* Error Message */
.error-title {
    font-size: 2rem;
    color: #fff;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
}

.error-subtitle {
    color: #aaa;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Floating Particles */
.particles {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    overflow: hidden;
}

.particle {
    position: absolute;
    width: 10px;
    height: 10px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    animation: particle-float 8s infinite ease-in-out;
    opacity: 0.6;
}

.particle:nth-child(1) { left: 10%; animation-delay: 0s; }
.particle:nth-child(2) { left: 20%; animation-delay: 1s; }
.particle:nth-child(3) { left: 30%; animation-delay: 2s; }
.particle:nth-child(4) { left: 40%; animation-delay: 3s; }
.particle:nth-child(5) { left: 50%; animation-delay: 4s; }
.particle:nth-child(6) { left: 60%; animation-delay: 5s; }
.particle:nth-child(7) { left: 70%; animation-delay: 6s; }
.particle:nth-child(8) { left: 80%; animation-delay: 7s; }
.particle:nth-child(9) { left: 90%; animation-delay: 0.5s; }
.particle:nth-child(10) { left: 95%; animation-delay: 1.5s; }

@keyframes particle-float {
    0%, 100% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 0.6;
    }
    90% {
        opacity: 0.6;
    }
    100% {
        transform: translateY(-100px) rotate(720deg);
        opacity: 0;
    }
}

/* Search Box */
.search-404 {
    max-width: 400px;
    margin: 0 auto 2rem;
}

.search-404 .input-group {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    overflow: hidden;
    border: 2px solid #FFD700;
}

.search-404 input {
    background: transparent;
    border: none;
    color: #fff;
    padding: 15px 25px;
}

.search-404 input::placeholder {
    color: #888;
}

.search-404 input:focus {
    background: transparent;
    box-shadow: none;
    color: #fff;
}

.search-404 button {
    border-radius: 0 50px 50px 0 !important;
    padding: 15px 25px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}

.btn-glow {
    position: relative;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-glow-primary {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: #000;
    border: none;
}

.btn-glow-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
    color: #000;
}

.btn-glow-outline {
    background: transparent;
    color: #FFD700;
    border: 2px solid #FFD700;
}

.btn-glow-outline:hover {
    background: #FFD700;
    color: #000;
    transform: translateY(-3px);
}

/* Suggestion Section */
.suggestion-section {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #333;
}

.suggestion-title {
    color: #FFD700;
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .glitch {
        font-size: 6rem;
    }

    .error-title {
        font-size: 1.5rem;
    }

    .slot-icon {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .glitch {
        font-size: 4rem;
    }

    .action-buttons {
        flex-direction: column;
        align-items: center;
    }

    .btn-glow {
        width: 100%;
        max-width: 250px;
    }
}
</style>

<main class="error-page">
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="error-container">
        <!-- Glitch 404 -->
        <div class="glitch-wrapper">
            <div class="glitch">404</div>
        </div>

        <!-- Slot Icons -->
        <div class="slot-icons">
            <span class="slot-icon">🎰</span>
            <span class="slot-icon">❌</span>
            <span class="slot-icon">🎰</span>
        </div>

        <!-- Error Message -->
        <h1 class="error-title">Oops! Jackpot Tidak Ditemukan</h1>
        <p class="error-subtitle">
            Sepertinya halaman yang kamu cari sudah pindah ke dimensi lain atau tidak pernah ada.
            Jangan khawatir, masih banyak konten menarik lainnya!
        </p>

        <!-- Search Box -->
        <div class="search-404">
            <form action="<?= BASE_URL ?>/cari.php" method="GET">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari artikel...">
                    <button class="btn btn-warning" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="<?= BASE_URL ?>" class="btn btn-glow btn-glow-primary">
                <i class="bi bi-house-door"></i> Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="btn btn-glow btn-glow-outline">
                <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
            </a>
        </div>

        <!-- Article Suggestions -->
        <?php if (!empty($randomBerita)): ?>
        <div class="suggestion-section">
            <h4 class="suggestion-title"><i class="bi bi-lightbulb"></i> Mungkin Kamu Tertarik</h4>
            <div class="row g-3 justify-content-center">
                <?php foreach ($randomBerita as $berita): ?>
                <div class="col-md-4">
                    <div class="card bg-dark border-secondary h-100">
                        <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html">
                            <img src="<?= htmlspecialchars($berita['gambar']) ?>" class="card-img-top" style="height: 120px; object-fit: cover;" alt="<?= htmlspecialchars($berita['judul']) ?>">
                        </a>
                        <div class="card-body p-2">
                            <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html" class="text-decoration-none">
                                <h6 class="card-title text-light mb-0" style="font-size: 0.85rem;"><?= htmlspecialchars(truncate($berita['judul'], 50)) ?></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
