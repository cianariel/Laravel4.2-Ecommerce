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
            $this->middleware('jwt.auth', ['except' => ['addMediaContent']]);
            $this->media = new Media();
        }



        public function updateMediaContent()
        {

        }

        public function deleteMediaContent()
        {

        }
    }
