<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;
use LogicException;

trait Translatable
{
    protected string $defaultLocale = 'en';

    public function __($originFieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;

        if ($locale === 'ru') {
            $fieldName = $originFieldName.'_ru';
        } else {
            $fieldName = $originFieldName;
        }

        $attributes = array_keys(array: $this->attributes);

        if (!in_array(needle: $fieldName, haystack: $attributes)) {
            throw new LogicException(message: 'No such attribute for model '.get_class(object: $this));
        }

        if ($locale === 'ru' && (is_null(value: $this->$fieldName) || empty($this->$fieldName))) {
            return $this->$originFieldName;
        }

        return $this->$fieldName;
    }
}
