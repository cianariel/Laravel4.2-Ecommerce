<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hearts';

    /**
     * Define Relationship
     * /
     *
     * /*
     * @return media object
     */

    public function heartable()
    {
        return $this->morphTo();
    }

    public function addHeartCounter($info)
    {
        $product = Product::where('id', $info['pid'])->first();

        $heart = new Heart();
        $heart->user_id = $info['uid'];

        $result = $product->hearts()->save($heart);

        return $result;
    }


}
