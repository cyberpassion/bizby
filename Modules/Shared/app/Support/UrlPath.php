<?php

namespace Modules\Shared\Support;
use Modules\Shared\Support\BaseActions;

class UrlPath
{
	public static string $prefix = 'module';

    public static function make(string $module, ?string $resource = null): string
    {
        $path = '/' . self::$prefix . '/' . $module;
        if ($resource) {
            $path .= '/' . str_replace('.', '/', $resource);
        }
        return $path;
    }

	// Generic Paths
	public static function makeHome(string $module): string
	{
		return self::make($module, BaseActions::HOME);
	}

	public static function makeList(string $module): string
	{
		return self::make($module, BaseActions::LIST);
	}

	public static function makeView(string $module): string
	{
		return self::make($module, BaseActions::VIEW);
	}

	public static function makeCreate(string $module): string
	{
		return self::make($module, BaseActions::CREATE);
	}

	public static function makeBulk(string $module): string
	{
		return self::make($module, BaseActions::BULK);
	}

	public static function makeReport(string $module): string
	{
		return self::make($module, BaseActions::REPORT);
	}

	public static function makeSettings(string $module): string
	{
		return self::make($module, BaseActions::SETTINGS);
	}

	public static function makePlugins(string $module): string
	{
		return self::make($module, BaseActions::PLUGINS);
	}


	// Singular Paths
	public static function makeUpdate(string $module, $id): string
	{
		return self::make($module, $id . '/' . BaseActions::UPDATE);
	}

	public static function makeDelete(string $module, $id): string
	{
		return self::make($module, $id . '/' . BaseActions::DELETE);
	}

	public static function makeDocuments(string $module, $id): string
	{
		return self::make($module, $id . '/' . BaseActions::DOCUMENTS);
	}

	public static function makeUpload(string $module, $id): string
	{
		return self::make($module, $id . '/' . BaseActions::UPLOAD);
	}

}
