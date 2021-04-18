<?php

class Placeholder {
	
	public static function replacePlaceholder($line, $lib) {	
	
		# Login required.
		if ($lib->isLoggedIn()) {
				
			# Dollars
			$line = str_replace("[DOLLARS]", $lib->getCurrency("dollar"), $line);
			
			# Username
			$line = str_replace("[USERNAME]", $lib->getUserdata()["username"], $line);
		
		}
		
		return $line;
	}
	
	public static function replaceFromLanguageFile($line, $language, $lib) {
		
		# Get language file.
		$json = json_decode(file_get_contents(__DIR__ . "/language.json"));
		
		# Check if language exists.
		if (!isset($json->$language)) {
			return $line;
		}
		
		$pattern = "/{(.*?)}/";

		if(preg_match_all($pattern, $line, $matches)) {
			$results = $matches[1];
		}
		
		if (isset($results)) {
			foreach($results as $placeholder) {
				$path = str_replace(".", "->", $placeholder);
				
				$value = eval("return \$json->$language->$path;");
				
				$line = str_replace("{" . $placeholder . "}", $value, $line);
			}
		}
		
		return $line;
		
	}
	
}

?>