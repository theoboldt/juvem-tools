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

$output = `cd /var/www/juvem-tools && /usr/bin/git pull 2>&1`;

if ($output !== null) {
    echo '<pre>' . $output . '</pre>';
}
