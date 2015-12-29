<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Application static data
        |--------------------------------------------------------------------------
        |
        */

        'user-registration-info' => [
            'next-project-focus'    => ['Bathroom', 'Garage', 'Laundry-Room'],
            'project-starting-time' => ['3-months', '6-months'],
            'desired-service'       => ['Architects', 'Interior-Designers', 'Roofing-Gutters'],

        ],


        'parent-id-not-exist'    => 'Parent ID does not exist !',
        'category-delete-exists' => 'Can\'t delete category as product exists in that category !',
        'category-delete'        => 'Category deleted successfully',
        'category-updated'       => 'Category updated successfully',
        'category-not-exist'     => 'Category not exits!',

        // API response status.
        'api-status'             => [
            'success'                => 200,
            'success-with-variation' => 210,
            'validation-fail'        => 400,
            'app-failure'            => 410,
            'system-fail'            => 500
        ],

        // Category Static Blog Name for Category
        'blog-name'              => 'blog',

        // Product message
        'product'                => [
            'permalink-exist'        => 'No product exists with this permalink',
            'can-not-create-product' => 'Can not create product with this permalink!',
            'product-added' => 'Successfully product added',
            'product-not-found' => 'No product found with the provided ID',
        ],
    ];
