<?php

namespace Modules\Shared\Services;

use Modules\Shared\Models\Term;

class TermResolverService
{
    public static function resolve($value)
    {
        if (!is_string($value)) return $value;

        if (preg_match('/^(core|tenant)_(\d+)$/', $value, $matches)) {

            // 🔥 Map core → central
            $connection = $matches[1] === 'core' ? 'central' : $matches[1];

            $id = $matches[2];

            try {
                $term = Term::on($connection)->find($id);
                return $term?->name ?? $value;
            } catch (\Exception $e) {
                return $value;
            }
        }

        return $value;
    }
}