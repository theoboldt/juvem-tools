<?php
/**
 * This file is part of the Juvem package.
 *
 * (c) Erik Theoboldt <erik@theoboldt.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

set_time_limit(60 * 60 * 60);

$output = null;

if (array_key_exists('apt-update', $_GET)) {
    $output = `sudo /usr/bin/apt-get -qq update 2>&1`;
}
if (array_key_exists('apt-dist-upgrade', $_GET)) {
    $output
        = `sudo /usr/bin/apt-get -qy dist-upgrade 2>&1 && sudo /usr/bin/apt-get -qy autoremove 2>&1 && sudo /usr/bin/apt-get -qy autoclean 2>&1`;
}
if (array_key_exists('tools', $_GET)) {
    $output = `sudo /usr/bin/git -C /var/www/juvem-tools pull 2>&1`;
}
if (array_key_exists('cache', $_GET)) {
    $output = `sudo /bin/rm -rf /var/www/juvem/var/cache/*`;
}
if (array_key_exists('update', $_GET)) {
    $output = `sudo /bin/sh /mnt/juvemcrypt/do-upgrade.sh 2>&1`;
}
if (array_key_exists('db', $_GET)) {
    $output = `sudo /bin/sh /mnt/juvemcrypt/db-upgrade.sh 2>&1`;
}
if (array_key_exists('disable', $_GET)) {
    $output = `sudo /usr/bin/touch /var/www/juvem/app/web/app-disabled`;
}
if (array_key_exists('enable', $_GET)) {
    $output .= `sudo /bin/rm /var/www/juvem/app/web/app-disabled`;
}
if (array_key_exists('logs', $_GET)) {
    $file = '/var/www/juvem/var/log/prod.log';
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize($file));
        readfile($file);
    }
}
if (array_key_exists('juvemdata-mount', $_GET)) {
    $output .= `sudo /bin/mount /bin/mount /mnt/juvemdata`;
}

if (array_key_exists('juvemdata-umount', $_GET)) {
    $output .= `sudo /bin/sh /mnt/juvemcrypt/juvemdata-umount.sh`;
}

if (array_key_exists('samba-enable', $_GET)) {
    $output .= `sudo /usr/sbin/service smbd start`;
}

if (array_key_exists('samba-disable', $_GET)) {
    $output .= `sudo /usr/sbin/service smbd stop`;
}

if ($output !== null) {
    echo '<pre>' . $output . '</pre>';
}

?>

<h1>Tools</h1>
<ul>
    <li>
        <a href="/app.php?cache=1">Cache leeren</a>
    </li>
    <li>
        <a href="/app.php?update=1">Update</a>
    </li>
    <li>
        <a href="/app.php?db=1">Datenbank-Update</a>
    </li>
    <li>
        <a href="/app.php?disable=1">Disable</a>
    </li>
    <li>
        <a href="/app.php?enable=1">Enable</a>
    </li>
</ul>
<h2>Server</h2>
<ul>
    <li>
        <a href="/app.php?apt-update=1">Paketliste aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?apt-dist-upgrade=1">Pakete aktualisieren</a>
    </li>
    <li>
        <a href="/self.php">Tools aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?logs=1">Protokolldatei abrufen</a>
    </li>
    <li>Juvemdata
      <ul>
        <li>
            <a href="/app.php?juvemdata-mount=1">Dateisystem einbinden</a>
        </li>
        <li>
            <a href="/app.php?juvemdata-umount=1">Dateisystem auswerfen</a>
        </li>
        <li>
            <a href="/app.php?samba-enable=1">Dateifreigaben einschalten</a>
        </li>
        <li>
            <a href="/app.php?samba-disable=1">Dateifreigaben ausschalten</a>
        </li>
      </ul>
</ul>
