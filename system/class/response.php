<?php

class Response {
    private $output;
    private $headers = array();

    public function addHeader($header) {
		$this->headers[] = $header;
	}

    public function setOutput($output) {
		$this->output = $output;
	}

    public function output() {

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