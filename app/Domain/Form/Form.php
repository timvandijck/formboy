<?php

namespace Formboy\Form;

use Illuminate\Database\Eloquent\Model;

class Form extends Model {

    public function files() {
        return $this->hasMany('File');
    }
} 