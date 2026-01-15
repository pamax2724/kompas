<?php
require_once 'includes/functions.php';

$beritaTerbaru = getAllBerita(12);

$pageTitle = getSetting('meta_title') ?: getSetting('nama_web') . ' - ' . getSetting('tagline');
$pageDesc = getSetting('meta_desc');
$pageUrl = BASE_URL;

include 'includes/header.php';
?>

<main class="py-4">
    <div class="container">
        <!-- Slideshow -->
        <?php include 'includes/slideshow.php'; ?>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <h4 class="text-warning mb-3"><i class="bi bi-newspaper"></i> Berita Terbaru</h4>

                <?php if (empty($beritaTerbaru)): ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-info-circle"></i> Belum ada berita.
                </div>
                <?php else: ?>
                    <?php foreach ($beritaTerbaru as $berita): ?>
                    <div class="card bg-dark border-secondary mb-3" style="overflow:hidden;">
                        <div class="row g-0">
                            <div class="col-4">
                                <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html">
                                    <img src="<?= htmlspecialchars($berita['gambar']) ?>" style="width:100%; height:130px; object-fit:cover;" alt="<?= htmlspecialchars($berita['judul']) ?>">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="card-body py-2 px-3">
                                    <span class="badge bg-warning text-dark mb-1" style="font-size:0.7rem;"><?= htmlspecialchars(getKategoriBySlug($berita['kategori'])['nama'] ?? $berita['kategori']) ?></span>
                                    <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html" class="text-decoration-none">
                                        <h6 class="card-title text-light mb-1" style="font-size:0.95rem;"><?= htmlspecialchars($berita['judul']) ?></h6>
                                    </a>
                                    <p class="card-text text-secondary mb-1" style="font-size:0.8rem;"><?= truncate($berita['isi'], 80) ?></p>
                                    <small class="text-secondary" style="font-size:0.75rem;">
                                        <i class="bi bi-calendar"></i> <?= formatTanggal($berita['created_at']) ?>
                                        <span class="ms-2"><i class="bi bi-eye"></i> <?= number_format($berita['views'] ?? 0) ?></span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
