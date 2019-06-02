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

if (isset($_GET['apt-update'])) {
    $output = `sudo /usr/bin/apt -qq update`;
}
if (isset($_GET['apt-update'])) {
    $output = `sudo /usr/bin/apt -dist-upgrade && /usr/bin/apt -y autoremove && /usr/bin/apt -y autoclean`;
}

if ($output !== null) {
    echo '<pre>'.$output.'</pre>';
}

?>

<h1>Tools</h1>
<ul>
    <li>
        <a href="/app.php?apt-update">Paketliste aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?apt-dist-upgrade">Pakete aktualisieren</a>
    </li>
    <li>
        <a href="/app.php?tools">Tools aktualisieren</a>
    </li>
</ul>
