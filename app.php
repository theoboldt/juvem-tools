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
        = `sudo /usr/bin/apt -dist-upgrade 2>&1 && /usr/bin/apt -y autoremove 2>&1 && /usr/bin/apt -y autoclean 2>&1`;
}
if (array_key_exists('tools', $_GET)) {
    $output = `sudo /usr/bin/git -C /var/www/juvem-tools pull 2>&1`;
}
if (array_key_exists('cache', $_GET)) {
    $output = `sudo /bin/rm -rf /var/www/juvem/app/cache/*`;
}
if (array_key_exists('update', $_GET)) {
    $output = `sudo /usr/bin/touch /var/www/juvem/web/app-disabled`;
    $output .= `sudo /usr/bin/git -C /var/www/juvem pull 2>&1`;
    $output .= `sudo /bin/chown www-data:erik -R /var/www/juvem`;
    $output .= `sudo /bin/chmod ug+rw -R /var/www/juvem`;
    $output .= `sudo /bin/rm /var/www/juvem/web/app-disabled`;
}
if (array_key_exists('dep', $_GET)) {
    $output = `sudo /usr/bin/touch /var/www/juvem/web/app-disabled`;
    $output = `sudo /usr/bin/composer -d=/var/www/juvem --no-dev install`;
    $output = `sudo /usr/bin/composer -d=/var/www/juvem --optimize dump-autoload`;
    $output .= `sudo /bin/chown www-data:erik -R /var/www/juvem`;
    $output .= `sudo /bin/chmod ug+rw -R /var/www/juvem`;
    $output .= `sudo /bin/rm /var/www/juvem/web/app-disabled`;
}
if (array_key_exists('deploy', $_GET)) {
    $output = `sudo /usr/bin/touch /var/www/juvem/web/app-disabled`;
    $output .= `/usr/bin/touch /var/www/juvem/web/app-disabled && cd /var/www/juvem && /usr/bin/npm install && /usr/bin/grunt deploy && /bin/rm /var/www/juvem/web/app-disabled`;
    $output .= `sudo /bin/chown www-data:erik -R /var/www/juvem`;
    $output .= `sudo /bin/chmod ug+rw -R /var/www/juvem`;
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
        <a href="/app.php?dep=1">Abhängigkeiten</a>
    </li>
    <li>
        <a href="/app.php?deploy=1">Deployment</a>
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
