/*
 * PHP : Backup Files & Folders to ZIP-File current directory with php
 * (c) 2019: Uma Shankar. (http://umashankar.cf)
*/
<pre><?php
$path = realpath(__DIR__);
echo "Zipping " . $path. "\n";
$zip = new ZipArchive();
$zip->open('archive.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($files as $name => $file)
{
	if ($file->isDir()) {
		echo $name . "\n";
		flush();
		continue;
	}
	
	$filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($path) + 1);
	
    $zip->addFile($filePath, $relativePath);
}
$zip->close();
echo "End.\n";
