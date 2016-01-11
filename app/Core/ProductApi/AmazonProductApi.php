<?php

    /**
     * Created by PhpStorm.
     * User: sanzeeb
     * Date: 1/11/2016
     * Time: 5:55 PM
     */
    namespace App\Core\ProductApi;

    class AmazonProductApi implements ProductApiInterface {


        public function makeUrl()
        {
            // Your AWS Access Key ID, as taken from the AWS Your Account page
            $aws_access_key_id = \Config::get("const.product-api-key.amazon-product-api.access-key");//"AKIAIQYICLTUI4NBTPGA";

            // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
            $aws_secret_key = \Config::get("const.product-api-key.amazon-product-api.secret-key");//"9QvJL0SABeZoJaGV8iebsDI1Kv5AUcdg0zv9Dlch";

            // The region you are interested in
            $endpoint = "webservices.amazon.com";

            $uri = "/onca/xml";

            $params = array(
                "Service"        => "AWSECommerceService",
                "Operation"      => "ItemLookup",
                "AWSAccessKeyId" => $aws_access_key_id,//"AKIAIQYICLTUI4NBTPGA",
                "AssociateTag"   => \Config::get("const.product-api-key.amazon-product-api.associate-tag"),
                "ItemId"         => $this->itemId,
                "IdType"         => "ASIN",
                "ResponseGroup"  => "Images,ItemAttributes,Offers"
            );

            // Set current timestamp if not set
            if (!isset($params["Timestamp"]))
            {
                $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
            }

            // Sort the parameters by key
            ksort($params);

            $pairs = array();

            foreach ($params as $key => $value)
            {
                array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
            }

            // Generate the canonical query
            $canonical_query_string = join("&", $pairs);

            // Generate the string to be signed
            $string_to_sign = "GET\n" . $endpoint . "\n" . $uri . "\n" . $canonical_query_string;

            // Generate the signature required by the Product Advertising API
            $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

            // Generate the signed URL
            $request_url = 'http://' . $endpoint . $uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

            return $request_url;
        }

        public function getData()
        {



        }

        // Implement getProductInformation() method.
        /**
         *
         */
        public function getProductInformation($itemId)
        {
            $this->itmeId = $itemId;

            $client = new \Guzzle\Service\Client();
            $response = $client->get($this->makeUrl());

            $information = $response->getResponseBody();
            return $information;

        }
    }