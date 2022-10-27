<?php

namespace App;

use Faker\Core\DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cars
 * @package App
 *
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Cars extends Model
{

    protected $fillable = [
        'title'
    ];
}
