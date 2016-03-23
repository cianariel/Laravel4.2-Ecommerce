<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Heart;
use App\Models\Product;
use App\Models\User;

use App\Models\WpPost;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;


class HeartController extends ApiController
{
    public function __construct()
    {
        //   $this->comment = new Comment();
        $this->user = new User();

        $this->heart = new Heart();
    }

    public function addHeart()
    {
        // saving heart information
        $inputData = \Input::all();

        $data['UserId'] = $inputData['uid'];
        $data['ItemId'] = $inputData['iid'];
        $data['Section'] = $inputData['section'];

        $data['Link'] = $inputData['plink'];

        $result = $this->heart->addHeartCounter($data);

        $notification['HeartInfo'] = $this->heart->findHeartCountForItem($data);
        $notification['SenderId'] = $inputData['uid'];
        $notification['Permalink'] = $data['Link'];

        $dataStr = date("Y-m-d H:i:s");
        $notification['PostTime'] = (string)$dataStr;

        // sending notification
        $info['Users'] = [];
        foreach ($notification['HeartInfo'] as $heart) {

            if (isset($heart['UserId']) && $heart['UserId'] != $notification['SenderId'])
                array_push($info['Users'], $heart['UserId']);
        }
        $info['Users'] = array_unique($info['Users']);
        $info['Category'] = 'heart';//$data['Category'];
        $info['SenderId'] = $notification['SenderId'];
        $info['Permalink'] = $data['Section'] . '/' . $data['Link'];
        $info['PostTime'] = $notification['PostTime'];
        $info['ItemTitle'] = $notification['HeartInfo']['ItemTitle'];
        $info['Section'] = $data['Section'];
        $info['Category'] = 'heart';//$data['Section'];

        $this->user->sendNotificationToUsers($info);

    }

}
