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
    $output = `sudo /usr/bin/apt -qq update 2>&1`;
}
if (array_key_exists('apt-dist-upgrade', $_GET)) {
    $output
        = `sudo /usr/bin/apt -q --dist-upgrade 2>&1 && sudo /usr/bin/apt -qy autoremove 2>&1 && sudo /usr/bin/apt -qy autoclean 2>&1`;
}
if (array_key_exists('tools', $_GET)) {
    $output = `sudo /usr/bin/git -C /var/www/juvem-tools pull 2>&1`;
}
if (array_key_exists('cache', $_GET)) {
    $output = `sudo /bin/rm -rf /var/www/juvem/app/cache/*`;
}
if (array_key_exists('update', $_GET)) {
    $output = `sudo /bin/sh /mnt/juvemcrypt/do-upgrade.sh 2>&1`;
}
if (array_key_exists('disable', $_GET)) {
    $output = `sudo /usr/bin/touch /var/www/juvem/web/app-disabled`;
}
if (array_key_exists('enable', $_GET)) {
    $output .= `sudo /bin/rm /var/www/juvem/web/app-disabled`;
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
</ul>
