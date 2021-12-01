<?php

/**
 *
 * Custom Array Functions
 */
if (!function_exists('array_remove')) {
    /**
     * Remove unnecessary elements from array
     * @param array removable elements
     * @param array array that needs to be removed from
     * @return array array
     */

    function array_remove(array $delete_array, array $array): array
    {
        foreach ($delete_array as $deleteItem) {
            unset($array[$deleteItem]);
        }

        return $array;
    }
}
/**
 *
 * End of Custom Array Functions
 */
if (!function_exists('makeNotFoundMessage')) {
    function makeNotFoundMessage($name): string
    {
        return __('messages.not_found', ['name' => $name]);
    }
}

if (!function_exists('makeCreatedMessage')) {
    function makeStoredMessage($name): string
    {
        return __('messages.store_success', ['name' => $name]);
    }
}

if (!function_exists('makeUpdateSuccessMessage')) {
    function makeUpdatedMessage($name): string
    {
        return __('messages.update_success', ['name' => $name]);
    }
}

if (!function_exists('makeDeletedMessage')) {
    function makeDeletedMessage($name)
    {
        return __('messages.destroy_success', ['name' => $name]);
    }
}
if (!function_exists('makeBadRequestMessage')) {
    function makeBadRequestMessage($name)
    {
        return __('messages.bad_request', ['name' => $name]);
    }
}
if (!function_exists('hasTables')) {
    function hasTables(array $tables): bool
    {
        foreach ($tables as $table) {
            if (!(\Illuminate\Support\Facades\Schema::hasTable($table))) {
                return false;
            }
        }

        return true;
    }
}
