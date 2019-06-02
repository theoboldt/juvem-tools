<?php
/**
 * This file is part of the Juvem package.
 *
 * (c) Erik Theoboldt <erik@theoboldt.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


sleep(10);

$output = `sudo /usr/bin/git -C /var/www/juvem-tools pull 2>&1`;

if ($output !== null) {
    echo '<pre>' . $output . '</pre>';
}
