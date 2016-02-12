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

        public function __construct()
        {
            /*// Apply the jwt.auth middleware to all methods in this controller
            $this->middleware('jwt.auth',
                [
                    'except' => ['index', 'categoryView', 'addCategory',
                        'editCategory', 'productView', 'addProduct', 'editProduct'
                    ]
                ]);
            $this->product = new Product();*/

            $this->authCheck = $this->RequestAuthentication();
        }

        public function index()
        {
            /* $data = ['menu'=>'dynamic menu'];*/
            return view('admin.index');
        }


        // Category view

        public function categoryView()
        {

            //$authCheck = $this->RequestAuthentication();

            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-view');

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function addCategory()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-add');


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }

        }

        public function editCategory()
        {

            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-edit');

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        // Product view
        public function productView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.product-view');

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
//

        }

        public function addProduct()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.product-add');


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
//

        }

        public function editProduct($id)
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.product-add')->with('id',$id);


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
//


        }

        public function storeView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.stores');


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
//

        }

        public function tagView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.tag-view');


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
//

        }
        // Room view
        public function roomsView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $Rooms = Room::all();
                return \View::make('admin.rooms.room-view', ['Rooms' => $Rooms]);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }//

        }

        public function addRoom()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $room = new Room();
                return view('admin.rooms.room-add')->with('room',$room);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }

        }

        public function editRoom($id)
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $room = Room::find($id);
                return view('admin.rooms.room-add')->with('room',$room);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }

        }
    }
