<?php
/**
 * Generate readme.txt from GitHub's README.md
 *
 * @author fumikito
 * @version 1.0.0
 * @see https://github.com/fumikito/wp-readme
 */

$file = false;

// Try file
foreach ( [ './readme.md', './README.md' ] as $file_name ) {
	if ( file_exists( $file_name ) ) {
		$file = $file_name;
		break;
	}
}

// File not found.
if ( ! $file ) {
	echo '[Error] No README.md in current directory.'.PHP_EOL;
	exit(1);
}

echo "readme.md found...\n";

$string = file_get_contents( $file );

// Replace headers
$string = preg_replace_callback( '/^(#+)\s+(.*)/mu', function( $match ) {
	$length = strlen( $match[ 1 ] );
	$sep = '';
	for ( $i = 1, $l = 3 - ( $length - 1 ); $i <= $l; $i++ ) {
		$sep .= '=';
	}
	return "{$sep} {$match[2]} {$sep}";
}, $string );

// Replace markdown format
$string = preg_replace( '/```/', '`', $string );

//保存
if ( ! file_put_contents( './readme.txt', $string ) ) {
	echo "[Error] Failed to save readme.txt.".PHP_EOL;
	exit(1);
}

echo "readme.txt generated successfully!".PHP_EOL;
