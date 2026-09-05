<?php

namespace App\Http\Controllers\Concerns;

trait ChecksModulePermission
{
    protected function authorizeModule(string $moduleKey, string $action): void
    {
        abort_unless(
            auth()->check() && auth()->user()->hasPermission($moduleKey, $action),
            403,
            'You do not have permission to perform this action.'
        );
    }
}