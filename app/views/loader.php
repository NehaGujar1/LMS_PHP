<?php

namespace View;

class Loader {
	public static function make() {
		$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
		$twig = new \Twig\Environment($loader);
		return $twig;
	}
}
