<?php

namespace Formboy\Domain\Forms;

use Formboy\Exceptions\InvalidTemplateException;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Form extends Model {

    public function files() {
        return $this->hasMany('File');
    }

    public function fields() {
        return $this->hasMany('Formboy\Domain\Forms\Fields\Field');
    }
} 