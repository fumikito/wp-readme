<?php
/**
 * Post type test
 *
 * @package Hamelp
 */

/**
 * Test validator
 */
class PathTest extends \PHPUnit\Framework\TestCase {
	
	/**
	 * Test lang validator
	 */
	public function test_file_path() {
		// Find path.
		$path = wp_readme_find( __DIR__ . '/document' );
		$this->assertEquals( __DIR__ . '/document/README.md', $path );
		// File not found.
		$path = wp_readme_find( __DIR__ . '/not_exists' );
		$this->assertEmpty( $path );
		// Find path without directory.
		$this->assertFileExists( wp_readme_find() );
	}
}
