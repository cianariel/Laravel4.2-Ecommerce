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


class CommentController extends ApiController
{
    public function __construct()
    {
        //   $this->comment = new Comment();
        //    $this->user = new User();

        $this->heart = new Heart();
    }

    public function addNotification()
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
        foreach ($data['HeartInfo'] as $heart) {

            if ($heart['UserId'] != $data['SenderId'])
                array_push($info['Users'], $heart['UserId']);
        }
        $info['Users'] = array_unique($info['Users']);
        $info['Category'] = 'comment';//$data['Category'];
        $info['SenderId'] = $data['SenderId'];
        $info['Permalink'] = $data['Section'] . '/' . $data['Permalink'] ;
        $info['PostTime'] = $data['PostTime'];
        $info['ItemTitle'] = $data['ItemTitle'];
        $info['Section'] = $data['Section'];

        $this->user->sendNotificationToUsers($info);


    }

}
