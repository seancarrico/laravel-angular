<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid as ID;

trait Uuid
{
    public static function generate()
    {
        return str_replace('-','',ID::generate());
    }
}
