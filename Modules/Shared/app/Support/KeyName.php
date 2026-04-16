<?php

namespace Modules\Shared\Support;

class KeyName
{

	public static function make(string $string): string
	{
		return str_replace(['.','_'], '-', strtolower($string));
	}

}
