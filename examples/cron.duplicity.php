<?php
/**
 * Example backup script.
 *
 * @author Ioannis Botis
 * @date 23/9/2016
 * @version: cron.duplicity.php 8:59 am
 * @since 23/9/2016
 */

require_once('settings.php');

use Backup\Binary;
use Backup\Duplicity;
use Backup\IncrementalBackup;

$binary = new Binary('duplicity');
$duplicity = new Duplicity($path_to_backup, $path_to_save, $binary);

echo "Version: " . $duplicity->getVersion() . "\n";

//$backup->setPassPhrase( 'abcdef' );

$backupClass = new IncrementalBackup ($duplicity);

$backups = $backupClass->getAllBackups();
foreach ($backups as $time) {
    echo 'There is a backup at ' . $time . "\n";
}

if ($backupClass->isChanged()) {
    // back me up.
    echo 'Back up initiated' . "\n";
    $backupClass->createBackup();
} else {
    echo 'No need to backup.' . "\n";
}