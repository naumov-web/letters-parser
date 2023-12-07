<?php

namespace App\Http\Requests\Api\V1\Traits;

/**
 * Trait UseFileField
 * @package App\Http\Requests\Api\V1\Traits
 */
trait UseFileField
{
    /**
     * Get file field rules
     *
     * @param string $field_name
     * @param bool $is_required
     * @param array $mime_types
     * @return array
     */
    protected function getFileFieldRules(
        string $field_name = 'file',
        bool $is_required = false,
        array $mime_types = []
    ): array {
        $result = [
            $field_name => [
                $is_required ? 'required' : 'nullable',
                'array'
            ],
            $field_name . '.name' => [
                $is_required ? 'required' : ('required_with:' . $field_name),
                'string',
            ],
            $field_name . '.mime' => [
                $is_required ? 'required' : ('required_with:' . $field_name),
                'string'
            ],
            $field_name . '.content' => [
                $is_required ? 'required' : ('required_with:' . $field_name),
                'string',
            ],
        ];

        if (count($mime_types) > 0) {
            $result[$field_name . '.mime'][] = 'in:' . implode(',', $mime_types);
        }

        return $result;
    }
}
