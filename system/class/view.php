<?php

class View {

    public function load($template, $data = array()) {

		$file = DIR_VIEW . $template . '.html';

		if (file_exists($file)) {
			extract($data);

			ob_start();

			require($file);

			$output = ob_get_contents();

			ob_end_clean();

            return $output;
		} else {
			exit('Error: Could not load template ' . $file . '!');
		}
	}
}