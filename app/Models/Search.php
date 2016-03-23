<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Product;
    use URL;
    use Redirect;

    class Search extends \Eloquent {

        protected $connection = 'wpdb';
        protected $table = 'users';


        public static function buildIndex()
        {

            $rawProducts = Product::where('post_status', 'Active')->get();

            foreach($rawProducts as $product){

                // making the thumbnail url by injecting "thumb-" in the url which has been uploaded during media submission.
                $storeInfo = $product->getStoreInfoByProductId($product->id);

                $media = $product->medias()
                                ->where('media_type', '=', 'img-upload')
                                ->where('is_main_item', '=', '1')
                                ->first();

                $feedImage = $media->media_link;

                $data = [
                    'title' => $product->product_name,
                    'content' => $product->product_description,
                    'date_created' => $product->created_at->format('Y-m-d\TH:i:s\Z'),
                    'price' => $product->price,
                    'sale_price' => $product->sale_price,
                    'categories' => $product->productCategory->category_name,
                    'tags' => $product->tags->lists('tag_name'),

                    'type' => 'product',
                    'affiliate_link' => $product->affiliate_link,
                    'permalink' => $product->product_permalink,
                    'storeinfo' => json_encode($storeInfo),
                    'store' => $storeInfo['StoreName'],
                     'feed_image' => $feedImage,
                ];

                $products[] = $data;
            }

            // 2.Get Ideas

            if (env('FEED_PROD') == true){
                $url = 'https://ideaing.com//ideas/feeds/index.php?with_tags';
            }else{
                $url = URL::to('/') . '/ideas/feeds/index.php?with_tags';
            } 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            $json = curl_exec($ch);

            $rawIdeas = json_decode($json);

            foreach($rawIdeas as $idea){
                $data = [
                    'title' => $idea->title,
                    'content' => $idea->content,
                    'date_created' => date('Y-m-d\TH:i:s\Z', strtotime($idea->creation_date)), // TODO -- also save string date for display
                    'categories' => $idea->category_all,
                    'tags' => $idea->tags_all,
                    'permalink' => $idea->url,
                    'type' => 'idea',
                    'author' => $idea->author,
                    'authorlink' => $idea->authorlink,
                    'avator' => $idea->avator,
                    'feed_image' => json_encode($idea->feed_image), // cut off unnecessary data
                    'storeinfo' => ''
                ];

                $ideas[] = $data;
            }

            // Mix up
            $return = array_merge($ideas, $products);

            $return = array_values(array_sort($return, function ($value) {
                return $value['date_created'];
            }));

            return $return;
        }











    }
