<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Response{
	private array $headers = [];
	private string $output = '';
	private array $params = [];

	public function setOutput(string $content){
		$this->output = $content;
	}

	public function getOutput(): string {
		return $this->output;
	}

	public function show(): void {
		if ($this->output) {
			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}
			echo $this->output;
		}
	}
}
