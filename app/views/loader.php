<?php

namespace View;

class Loader {
	public static function make() {
		//$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(dirname(__FILE__)), array('cache' => false));
		$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
		echo "p1";
		$twig = new \Twig\Environment($loader);
		echo "p2";
		return $twig;
	}
}
