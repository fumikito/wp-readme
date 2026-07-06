<?php

/**
 * Test converter.
 */
class ConvertTest extends \PHPUnit\Framework\TestCase {
	
	/**
	 * Test converter
	 */
	public function test_conversion() {
		$readme_dir = __DIR__ . '/document';
		wp_readme_replace( wp_readme_find( $readme_dir ) );
		$this->assertFileEquals( $readme_dir . '/readme.txt', $readme_dir . '/readme-sample.txt' );
		$this->assertTrue( true );
	}
	
	/**
	 * Raw HTML tags inside fenced code blocks must be escaped, or WordPress.org's
	 * readme renderer treats them as real markup instead of a code sample.
	 * Quotes are left untouched since they don't affect HTML tag structure.
	 */
	public function test_code_block_html_is_escaped() {
		$markdown = <<<MD
```
<div class="foo">It's a <strong>bug</strong>.</div>
```
MD;
		$expected = '<pre>&lt;div class="foo"&gt;It\'s a &lt;strong&gt;bug&lt;/strong&gt;.&lt;/div&gt;</pre>';
		$this->assertEquals( $expected, wp_readme_convert_string( $markdown ) );
	}

	/**
	 * Test visibility.
	 */
	public function test_visibility() {
		// Github comment
		$actual = <<<HTML
<!-- only:github/ -->
This text should be removed
<!-- /only:github -->
Only this.
<!-- only:github/ -->
This text should be removed
<!-- /only:github -->
HTML;
		$actual = wp_readme_visibility( $actual );
		$this->assertEquals( "\nOnly this.\n", $actual );
		
		// WordPress comment.
		$actual = <<<HTML
<!-- only:wp>
This section will be revealed.
</only:wp -->
HTML;
		$expected = <<<TXT
This section will be revealed.
TXT;
		$this->assertEquals( $expected, wp_readme_visibility( $actual ) );
		// Environment variables.
		putenv( 'WP_README_ENV=production' );
		$actual = <<<HTML
<!-- only:production>
This section will be revealed.
</only:production -->
<!-- not:production/ -->
This text should be removed
<!-- /not:production -->
HTML;
		$expected = <<<TXT
This section will be revealed.
TXT;
		$this->assertEquals( trim( $expected ), trim( wp_readme_visibility( $actual ) ) );
		// Try another.
		$actual = <<<HTML
<!-- only:development>
This section will be revealed.
</only:development -->
HTML;
		putenv( 'WP_README_ENV=development' );
		$this->assertEquals( $expected, wp_readme_visibility( $actual ) );
	}
}