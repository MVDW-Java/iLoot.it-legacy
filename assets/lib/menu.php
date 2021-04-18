<?php

class Menu {
	
	public function __construct($lib) {
		# User is logged in.
		if ($lib->isLoggedIn()) {
			$navigation = Placeholder::replacePlaceholder(file_get_contents(__DIR__ . "/menu/navigation_login.txt"), $lib);
			$this->navigation = Placeholder::replaceFromLanguageFile($navigation, "EN", $lib);
		} else {
			$navigation = Placeholder::replacePlaceholder(file_get_contents(__DIR__ . "/menu/navigation.txt"), $lib);
			$this->navigation = Placeholder::replaceFromLanguageFile($navigation, "EN", $lib);
		}
		
		$footer = Placeholder::replacePlaceholder(file_get_contents(__DIR__ . "/menu/footer.txt"), $lib);
		$this->footer = Placeholder::replaceFromLanguageFile($footer, "EN", $lib);
		
	}
	
	public function getNavigation() {
		return $this->navigation;
	}
	
	public function getFooter() {
		return $this->footer;
	}
	
}

?>