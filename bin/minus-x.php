#!/usr/bin/php
<?php
/**
 * MinusX - checks files that shouldn't have an executable bit
 * Copyright (C) 2017 Kunal Mehta <legoktm@member.fsf.org>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @file
 */

// This file can be located in ./bin/minus-x.php
// or ./vendor/mediawiki/minus-x/bin/minus-x.php
$autoload = [
	__DIR__ . '/../../../../vendor/autoload.php',
	__DIR__ . '/../vendor/autoload.php',
];
$found = false;
foreach ( $autoload as $file ) {
	if ( file_exists( $file ) ) {
		require_once $file;
		$found = true;
		break;
	}
}

if ( !$found ) {
	echo "Error, unable to find composer autoloader.\n";
	die( 1 );
}

use MediaWiki\MinusX\CheckCommand;
use MediaWiki\MinusX\FixCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add( new CheckCommand() );
$app->add( new FixCommand() );
$app->run();
