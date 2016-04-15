<?php

    namespace App\Http\Controllers;

    use App\Models\Role;
    use Illuminate\Http\Request;

    use App\Http\Requests;

    use App\Models\Room;
    use App\Models\HomeHero;
    use App\Models\Giveaway;


    class AdminController extends ApiController {

        /**
         * Display a listing of the resource.
         *
         */

        public function __construct()
        {
            // check authentication with role 'admin' (default parameter)
            $this->authCheck = $this->RequestAuthentication(array('admin','editor'));
          //  $this->authCheck['method-status'] = 'success-with-http';
          //  dd($this->authCheck);

        }

        public function index()
        {
            return view('admin.index');
        }

        // User view

        public function userList()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.user-list-view')->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function userEdit($id=null)
        {

            $roleModel = new Role();
            $roles = $roleModel->get();

            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                if($id == null)
                    return view('admin.user-add')->with('roles',$roles)->with('userData' , $this->authCheck);
                else
                    return view('admin.user-add')->with('id',$id)->with('roles',$roles)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }


        // Category view

        public function categoryView()
        {

            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-view')->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function addCategory()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-add')->with('userData' , $this->authCheck);


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }

        }

        public function editCategory()
        {

            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.category-edit')->with('userData' , $this->authCheck);

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
                return view('admin.product-view')->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function addProduct()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
               // dd($this->authCheck['user-data']['name']);
                return view('admin.product-add')
                    ->with('userName',$this->authCheck['user-data']['name'])->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function editProduct($id)
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.product-add')->with('userData' , $this->authCheck)
                    ->with('userName',$this->authCheck['user-data']['name'])
                    ->with('id',$id);


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }

        public function storeView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.stores')->with('userData' , $this->authCheck);


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }
        }

        public function tagView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                return view('admin.tag-view')->with('userData' , $this->authCheck);


            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }
        // Room view
        public function roomsView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $Rooms = Room::all();
                return \View::make('admin.rooms.room-view', ['Rooms' => $Rooms])->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }

        }
        
        public function addRoom()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $room = new Room();
                return view('admin.rooms.room-add')->with('room',$room)->with('userData' , $this->authCheck);

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
                return view('admin.rooms.room-add')->with('room',$room)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }

        }
        //Home Hero View
        public function homeHeroView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $Rooms = HomeHero::all();
                return \View::make('admin.homehero.home-hero-list', ['homeheros' => $Rooms])->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }
        }
        public function addHomeHero()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $homehero = new HomeHero();
                return view('admin.homehero.home-hero-add')->with('homehero',$homehero)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
        }
        public function editHomeHero($id)
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $homehero = HomeHero::find($id);
                return view('admin.homehero.home-hero-add')->with('homehero',$homehero)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
        }
        //Giveaway View
        public function giveawayView()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $giveaways = Giveaway::all();
                return \View::make('admin.giveaway.giveaways-list', ['giveaways' => $giveaways])->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');
            }
        }
        public function addGiveaway()
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $giveaway = new Giveaway();
                return view('admin.giveaway.giveaway-add')->with('giveaway',$giveaway)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
        }
        public function editGiveaway($id)
        {
            if ($this->authCheck['method-status'] == 'success-with-http')
            {
                $giveaway = Giveaway::find($id);
                return view('admin.giveaway.giveaway-add')->with('giveaway',$giveaway)->with('userData' , $this->authCheck);

            } elseif ($this->authCheck['method-status'] == 'fail-with-http')
            {
                return \Redirect::to('login');

            }
        }
    }
