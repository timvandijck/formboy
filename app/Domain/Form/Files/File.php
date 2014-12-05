<?php

namespace Formboy\Form\File;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    public function form() {
        return $this->belongsTo('Form');
    }
} 