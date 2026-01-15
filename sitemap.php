<?php
header('Content-Type: application/xml; charset=UTF-8');
require_once 'includes/functions.php';

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Homepage -->
    <url>
        <loc><?= BASE_URL ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Categories -->
<?php
$kategori = loadJson('kategori.json');
foreach ($kategori as $kat):
?>
    <url>
        <loc><?= BASE_URL ?>/<?= $kat['slug'] ?>/</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>

    <!-- Articles -->
<?php
$berita = loadJson('berita.json');
foreach ($berita as $b):
    if (!($b['published'] ?? true)) continue;
?>
    <url>
        <loc><?= BASE_URL ?>/<?= $b['kategori'] ?>/<?= $b['slug'] ?>.html</loc>
        <lastmod><?= date('Y-m-d', strtotime($b['updated_at'] ?? $b['tanggal'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>

    <!-- Static Pages -->
<?php
$halaman = loadJson('halaman.json');
foreach ($halaman as $h):
?>
    <url>
        <loc><?= BASE_URL ?>/halaman/<?= $h['slug'] ?>.html</loc>
        <lastmod><?= date('Y-m-d', strtotime($h['updated_at'] ?? $h['created_at'] ?? 'now')) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.4</priority>
    </url>
<?php endforeach; ?>
</urlset>
