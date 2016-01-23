<?php

    namespace App\Http\Controllers;

    use App\Models\Media;
    use Aws\CloudFront\Exception\Exception;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    class MediaController extends ApiController {

        public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth', ['except' => ['addMediaContent','updateMediaContent']]);
            $this->media = new Media();
        }


        public function updateMediaContent()
        {
            $inputData = \Input::all();

         //   dd($inputData);
            $data = array(
                "media_name"   => $inputData['MediaTitle'],
                "media_type"   => $inputData['MediaType'],
                "media_link"   => $inputData['MediaLink'],
                "is_hero_item" => $inputData['IsHeroItem'],
                "is_main_item" => $inputData['IsMainItem']
            );

            return Media::where('id','=',$inputData['MediaId'])->update($data);

        }

        public function deleteMediaContent()
        {

        }
    }
