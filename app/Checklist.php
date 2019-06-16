<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';

    protected $fillable = ['user_id', 'name'];

    
}