<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class HomeHero extends Model {
    	/**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'homehero';
        protected $fillable = array(
            'hero_image',
            'hero_image_title',
            'hero_image_alt',
            'hero_image_desc',
            'hero_image_caption',
            'hero_image_link_title',
            'hero_image_link',
            'hero_image_products',
            'hero_status'
        );
        protected $hidden = ['created_at'];
        // return room information data for public view
        public function getViewForPublic($permalink, $id = null)
        {
            $column = $id == null ? 'room_permalink' : 'id';
            $value = $id == null ? $permalink : $id;

            $roomInfo = Room::where($column, $value)
                ->first();
            return $roomInfo;

        }
        public function heroDetailsViewGenerate()
        {
            // dd($productData);
            $homeheroImages = HomeHero::all();
            foreach ($homeheroImages as $hero) {
                $products = json_decode($hero->hero_image_products);
                $temp = new Product();
                foreach ($products as $elementKey => $pr) {
                    $product = $temp->getSingleProductInfoForView($pr->product_id);
                    if($product)
                    {
                        $strReplace = \Config::get("const.file.s3-path");
                        $path = str_replace($strReplace, '', $product->media_link);
                        $path = $strReplace . 'thumb-' . $path;
                        $pr->media_link = $path;
                        $pr->product_name = $product->product_name;
                        $pr->price = $product->price;
                        $pr->sale_price = $product->sale_price ;
                        $pr->store = $temp->getStoreInfoByProductId($pr->product_id);
                        $pr->affiliate_link = $product->affiliate_link;
                        $pr->product_permalink = $product->product_permalink;
                    }
                    else{
                        $pr->product_id="";
                        unset($products[$elementKey]);
                    }
                }
                $hero['Image_Products'] = $products;
            }
            return $homeheroImages;
            
            /*
            //$roomInfo['Status'] = $roomData['room']->room_status;

            $image1['Image'] = $heroData['room']->hero_image;
            $images = [];
            if($heroData['room']->hero_image_1)
            {
                $Image = [];
                $Image['Image'] = $heroData['room']->hero_image;
                $Image['Image_alt'] = $heroData['room']->hero_image_alt;
                $Image['Image_Title'] = $heroData['room']->hero_image_title;
                $Image['Image_Caption'] = $heroData['room']->hero_image_caption;
                $Image['Image_hyperlink'] = $heroData['room']->hero_image_link;
                $Image['Image_hyperlink_title'] = $heroData['room']->hero_image_link_title;
                
                $products = json_decode($heroData['room']->hero_image_products);
                $temp = new Product();
                foreach ($products as $elementKey => $pr) {
                    $product = $temp->getSingleProductInfoForView($pr->product_id);
                    if($product)
                    {
                        $strReplace = \Config::get("const.file.s3-path");
                        $path = str_replace($strReplace, '', $product->media_link);
                        $path = $strReplace . 'thumb-' . $path;
                        $pr->media_link = $path;
                        $pr->product_name = $product->product_name;
                        $pr->price = $product->price;
                        $pr->sale_price = $product->sale_price ;
                        $pr->store = $temp->getStoreInfoByProductId($pr->product_id);
                        $pr->affiliate_link = $product->affiliate_link;
                        $pr->product_permalink = $product->product_permalink;
                    }
                    else{
                        $pr->product_id="";
                        unset($products[$elementKey]);
                    }
                }
                $Image['Image_Products'] = $products;
                $Image['Image_Description'] = $roomData['room']->hero_image_1_desc;
                $images[] = $Image;
            }
            if($roomData['room']->hero_image_2)
            {
                $Image = [];
                $Image['Image'] = $roomData['room']->hero_image_2;
                $Image['Image_alt'] = $roomData['room']->hero_image_2_alt;
                $Image['Image_Title'] = $roomData['room']->hero_image_2_title;
                $Image['Image_Caption'] = $roomData['room']->hero_image_2_caption;
                $Image['Image_hyperlink'] = $roomData['room']->hero_image_2_link;
                $Image['Image_hyperlink_title'] = $roomData['room']->hero_image_2_link_title;

                $products = json_decode($roomData['room']->hero_image_2_products);

                $temp = new Product();
                foreach ($products as $pr) {
                    $product = $temp->getSingleProductInfoForView($pr->product_id);
                    if($product)
                    {
                        $strReplace = \Config::get("const.file.s3-path");
                        $path = str_replace($strReplace, '', $product->media_link);
                        $path = $strReplace . 'thumb-' . $path;
                        $pr->media_link = $path;
                        $pr->product_name = $product->product_name;
                        $pr->price = $product->price;
                        $pr->sale_price = $product->sale_price ;
                        $pr->store = $temp->getStoreInfoByProductId($pr->product_id);
                        $pr->affiliate_link = $product->affiliate_link;
                        $pr->product_permalink = $product->product_permalink;
                    }
                    else{
                        $pr->product_id="";
                        unset($products[$elementKey]);
                    }
                }
                $Image['Image_Products'] = $products;
                $Image['Image_Description'] = $roomData['room']->hero_image_2_desc;
                $images[] = $Image;
            }
            
            if($roomData['room']->hero_image_3)
            {
                $Image = [];
                $Image['Image'] = $roomData['room']->hero_image_3;
                $Image['Image_alt'] = $roomData['room']->hero_image_3_alt;
                $Image['Image_Title'] = $roomData['room']->hero_image_3_title;
                $Image['Image_Caption'] = $roomData['room']->hero_image_3_caption;
                $Image['Image_hyperlink'] = $roomData['room']->hero_image_3_link;
                $Image['Image_hyperlink_title'] = $roomData['room']->hero_image_3_link_title;

                $products = json_decode($roomData['room']->hero_image_3_products);
                $temp = new Product();
                foreach ($products as $pr) {
                    $product = $temp->getSingleProductInfoForView($pr->product_id);
                    if($product)
                    {
                        $strReplace = \Config::get("const.file.s3-path");
                        $path = str_replace($strReplace, '', $product->media_link);
                        $path = $strReplace . 'thumb-' . $path;
                        $pr->media_link = $path;
                        $pr->product_name = $product->product_name;
                        $pr->price = $product->price;
                        $pr->sale_price = $product->sale_price ;
                        $pr->store = $product->storeInfo;
                        $pr->store = $temp->getStoreInfoByProductId($pr->product_id);
                        $pr->affiliate_link = $product->affiliate_link;
                        $pr->product_permalink = $product->product_permalink;
                    }
                    else{
                        $pr->product_id="";
                        unset($products[$elementKey]);
                    }
                }
                $Image['Image_Products'] = $products;
                $Image['Image_Description'] = $roomData['room']->hero_image_3_desc;
                $images[] = $Image;
            }
            $roomInfo['images'] = $images;
            $result['homehero'] = $roomInfo;
            return $result;*/
        }
    }