<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\Room;
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

        public function storeView()
        {
            return view('admin.stores');
        }

        public function tagView()
        {
            return view('admin.tag-view');
        }
        // Room view
        public function roomsView()
        {
            $Rooms = Room::all();
            return \View::make('admin.rooms.room-view', ['Rooms' => $Rooms]);
        }

        public function addRoom()
        {
            $room = new Room();
            return view('admin.rooms.room-add')->with('room',$room);
        }

        public function editRoom($id)
        {
            $room = Room::find($id);
            return view('admin.rooms.room-add')->with('room',$room);
        }
    }
