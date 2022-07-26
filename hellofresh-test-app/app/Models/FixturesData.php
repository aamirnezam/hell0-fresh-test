<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class FixturesData extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fixtures_data';

}
