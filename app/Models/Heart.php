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
        if ($info['Section'] == 'product') {

            $item = Product::where('id', $info['ItemId'])
                           ->with('hearts')
                           ->first();

        } elseif ($info['Section'] == 'ideas') {

            $item = WpPost::where('ID',$info['ItemId'])
                          ->with('hearts')
                          ->first();
        }

       // $product = Product::where('id', $info['pid'])->first();

        $heart = new Heart();
        $heart->user_id = $info['UserId'];

        $result = $item->hearts()->save($heart);

        return $result;
    }

    public function findHeartCountForItem($data)
    {
        if ($data['Section'] == 'product') {

            $item = Product::where('id', $data['ItemId'])
                              ->with('hearts')
                              ->first();

        } elseif ($data['Section'] == 'ideas') {

            $item = WpPost::where('ID',$data['ItemId'])
                            ->with('hearts')
                            ->first();
        }

        $itemsHeartCounts = isset($item->hearts)?$item->hearts:[];
        $HeartCountCollection = new Collection();

        $user = new User();

        foreach($itemsHeartCounts as $singleComment)
        {
            $userInfo = $user->getUserById($singleComment['user_id']);

            $data['HeartId'] = $singleComment['id'];
            $data['UserId'] = $userInfo['id'];
            $data['UserName'] = $userInfo['name'];
            $data['UserEmail'] = $userInfo['email'];
            $data['Picture'] = $userInfo->medias[0]->media_link;
            $data['PostTime'] = Carbon::createFromTimestamp(strtotime($singleComment['created_at']))->diffForHumans();

            $HeartCountCollection->push($data);

        }

        return $HeartCountCollection;

    }


}
