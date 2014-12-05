<?php

namespace Formboy\Forms\Files;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    public function form() {
        return $this->belongsTo('Form');
    }
} 