<?php
require_once 'includes/functions.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$hasil = [];

if (!empty($query)) {
    $berita = getAllBerita();
    foreach ($berita as $b) {
        if (stripos($b['judul'], $query) !== false || stripos($b['isi'], $query) !== false) {
            $hasil[] = $b;
        }
    }
}

$pageTitle = 'Cari: ' . $query . ' - ' . getSetting('nama_web');
$pageDesc = 'Hasil pencarian untuk: ' . $query;
$pageUrl = BASE_URL . '/cari.php?q=' . urlencode($query);

$breadcrumbItems = [
    ['name' => 'Home', 'url' => BASE_URL],
    ['name' => 'Pencarian', 'url' => $pageUrl]
];

$schemaBreadcrumb = generateSchemaBreadcrumb($breadcrumbItems);

include 'includes/header.php';
?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php include 'includes/breadcrumb.php'; ?>

                <h4 class="text-warning mb-3"><i class="bi bi-search"></i> Hasil Pencarian</h4>

                <?php if (empty($query)): ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-info-circle"></i> Masukkan kata kunci pencarian.
                </div>
                <?php elseif (empty($hasil)): ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-info-circle"></i> Tidak ditemukan hasil untuk "<strong><?= htmlspecialchars($query) ?></strong>".
                </div>
                <?php else: ?>
                <p class="text-light-emphasis mb-3">Ditemukan <?= count($hasil) ?> hasil untuk "<strong><?= htmlspecialchars($query) ?></strong>"</p>

                <div class="row g-3">
                    <?php foreach ($hasil as $berita): ?>
                    <div class="col-md-6">
                        <div class="card bg-dark border-secondary h-100 card-hover">
                            <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html">
                                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($berita['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($berita['judul']) ?>">
                            </a>
                            <div class="card-body">
                                <span class="badge bg-warning text-dark mb-2"><?= htmlspecialchars(getKategoriBySlug($berita['kategori'])['nama'] ?? $berita['kategori']) ?></span>
                                <a href="<?= BASE_URL ?>/<?= $berita['kategori'] ?>/<?= $berita['slug'] ?>.html" class="text-decoration-none">
                                    <h5 class="card-title text-light"><?= htmlspecialchars($berita['judul']) ?></h5>
                                </a>
                                <p class="card-text text-light-emphasis small"><?= truncate($berita['isi'], 100) ?></p>
                            </div>
                            <div class="card-footer bg-transparent border-secondary">
                                <small class="text-light-emphasis">
                                    <i class="bi bi-calendar"></i> <?= formatTanggal($berita['created_at']) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
