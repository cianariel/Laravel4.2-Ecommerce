<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Tag;


class TagsController extends ApiController
{

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth',
            ['except' => [
                'addTagInfo','updateTagInfo','deleteTagInfo','addTags','showAllTags','showTagByProductId',
                'getProductsByTag'

            ]]);

        $this->tag = new Tag();

    }

    public function addTagInfo()
    {
        $input = \Input::all();
      //  dd($input['TagName']);

        try
        {
            $newProduct = $this->tag->createTagInfo($input);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($newProduct);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function showTagByProductId($productId)
    {
        try
        {
            $tagList = $this->tag->showTagsForProduct($productId);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($tagList);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }


    }

    public function updateTagInfo()
    {
        $input = \Input::all();
        //  dd($input['TagName']);

        try
        {
            $tagInfo = $this->tag->updateTagInfo( $input);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($tagInfo);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function showAllTags()
    {
        try
        {
            $tagInfo = $this->tag->all();

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($tagInfo);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function getProductsByTag($tagId)
    {
        try
        {
            $tagInfo = $this->tag->getProductsByTag($tagId);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($tagInfo);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function deleteTagInfo()
    {
        $input = \Input::get('TagId');
        //  dd($input['TagName']);

        try
        {
            $newProduct = $this->tag->find($input)->delete();

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($newProduct);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }

    public function addTags()
    {
        $inputData = \Input::all();
        //addTags
        //dd($inputData);

        try
        {
            $newProduct = $this->tag->associateTagsForProduct($inputData);

            return $this->setStatusCode(\Config::get("const.api-status.success"))
                ->makeResponse($newProduct);

        } catch (Exception $ex)
        {
            return $this->setStatusCode(\Config::get("const.api-status.system-fail"))
                ->makeResponseWithError("System Failure !", $ex);
        }

    }




}
