<?php
/**
 * Used for Angular JS code insertions (seeing as braces clash with Blade ones)
 *
 * @param string $code Code/var/whatever to be put in the template
 * @return string
 */
HTML::macro('ng', function($code) {
	return '{{' . $code . '}}';
});
