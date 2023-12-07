<?php
namespace Templater;
defined('_RUNKEY') or die;

class Autoloader {
	private array $paths = [];
	private array $classes = [];

	public function __construct() {
		spl_autoload_register([$this, 'load']);
		spl_autoload_extensions('.php');
	}

	public function register(string $namespace, string $directory): void {
		if(isset($this->paths[$namespace])) {
			if(!in_array($directory, $this->paths[$namespace])) {
				$this->paths[$namespace][] = $directory;
			}
		}
		else {
			$this->paths[$namespace] = array_unique((array) $directory);
		}
	}

	public function load(string $class): bool {
		$namespace = '';

		$parts = explode('\\', $class);
		$filename = array_pop($parts);

		foreach($this->paths as $prefix => $dirs) {
			foreach ($dirs as $dir) {
				$file = $dir . $filename . '.php';
				if (file_exists($file)) {
					if(count($parts) > 0){
						$namespace = implode('\\', $parts);
					} else {
						$namespace = $prefix;
					}
					require_once($file);
					return true;
				}
			}
		}
		return false;
	}
}