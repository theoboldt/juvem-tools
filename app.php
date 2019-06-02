<?php
/**
 * This file is part of the Juvem package.
 *
 * (c) Erik Theoboldt <erik@theoboldt.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

set_time_limit(60*60*60);

$output = null;

if (array_key_exists('apt-update', $_GET)) {
    $output = `sudo /usr/bin/apt -qq update`;
}
if (array_key_exists('apt-dist-upgrade', $_GET)) {
    $output = `sudo /usr/bin/apt -dist-upgrade && /usr/bin/apt -y autoremove && /usr/bin/apt -y autoclean`;
}
if (array_key_exists('tools', $_GET)) {
    $output = `cd /var/www/juvem-tools && /usr/bin/git pull`;
}

if ($output !== null) {
    echo '<pre>'.$output.'</pre>';
}

?>

<h1>Tools</h1>
<ul>
    <li>
        <a href="/app.php?apt-update=1">Paketliste aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?apt-dist-upgrade=1">Pakete aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?tools=1">Tools aktualisieren</a>
    </li>
</ul>
