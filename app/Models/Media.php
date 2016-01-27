<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
   // use Illuminate\Http\Request;


    class Media extends Model {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'medias';

        protected $fillable = array(
            'media_name',
            'media_type',
            'media_link',
            'is_hero_item',
            'is_main_item',
            'mediable_id',
            'mediable_type'
        );

        protected $hidden = ['mediable_id','mediable_type','created_at', 'updated_at'];


        /**
         * Define Relationship
         * /
         *
         * /*
         * @return media object
         */
        public function mediable()
        {
            return $this->morphTo();
        }

        /**
         * @param Request $request
         * @return array
         */

        /**
         * @param $id
         */
        public function deleteMediaItem($id)
        {
            $mediaItem = $this->media->where('id', $id)->first();

            //delete entry from database
            $this->media->where('id', $id)->delete();

            if (($mediaItem['media_type'] == 'img-upload') || ($mediaItem['media_type'] == 'video-upload'))
            {
                // delete file from S3
                $strReplace = \Config::get("const.file.s3-path");// "http://s3-us-west-1.amazonaws.com/ideaing-01/";
                $file = str_replace($strReplace, '', $mediaItem['media_link']);
                $s3 = Storage::disk('s3');
                $s3->delete($file);

                if ($mediaItem['media_type'] == 'img-upload')
                {
                    $file = 'thumb-' . $file;
                    $s3->delete($file);
                }
            }
        }


    }
