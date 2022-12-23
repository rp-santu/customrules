<?php 

namespace remoteprogrammer\rplibrary\Variables;

use remoteprogrammer\rplibrary\RpLibrary;

class RpVariable
{
	public function file_exists(?string $file): bool
	{
		if (!$file) {
			return false;
		}
		return file_exists($file);
	}

	public function filemtime(?string $file): int
	{
		if (!$this->file_exists($file)) {
			return 0;
		}
		return filemtime($file);
	}

	public function file_content(?string $file): string
	{
		if (!$this->file_exists($file)) {
			return '';
		}
		return file_get_contents($file);
	}

	public function registerGlobalJs($nameOrValues, $value = null)
    {
        RpLibrary::$plugin->jsGlobals->register($nameOrValues, $value);
    }
}
