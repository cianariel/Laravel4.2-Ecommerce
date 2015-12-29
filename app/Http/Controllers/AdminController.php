<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
  //  use App\Models\Product;

    class AdminController extends ApiController {

        /**
         * Display a listing of the resource.
         *
         */

       /* public function __construct()
        {
            // Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                [
                    'except' => ['index', 'categoryView', 'addCategory',
                        'editCategory', 'productView', 'addProduct', 'editProduct'
                    ]
                ]);
            $this->product = new Product();
        }*/

        public function index()
        {
            /* $data = ['menu'=>'dynamic menu'];*/
            return view('admin.index');
        }


        // Category view

        public function categoryView()
        {
            return view('admin.category-view');
        }

        public function addCategory()
        {
            return view('admin.category-add');
        }

        public function editCategory()
        {
            return view('admin.category-edit');

        }

        // Product view
        public function productView()
        {
            return view('admin.product-view');
        }

        public function addProduct()
        {
            return view('admin.product-add');
        }

        public function editProduct($id)
        {
          //  $product = $this->product->where('id', $id)->first();

            return view('admin.product-add')->with('id',$id);
        }
    }
