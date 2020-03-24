<?php

namespace App\Library\Base;

use Illuminate\Database\Eloquent\Model;
use App\Library\Tool\Crypt;

class BaseModel extends Model
{
    use Crypt;

    public $timestamps = false;
    protected $dateFormat = 'U';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $casts = [
        'create_time' => 'date:Y-m-d H:i:s',
    ];
}
