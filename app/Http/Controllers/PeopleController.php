<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\People;
use App\Trade;
use App\Http\Requests\PeopleAddRequest;
use App\Http\Requests\PeopleEditRequest;
use Illuminate\Support\Facades\URL;

class PeopleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listing
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $trade_id = $request->input('trades');
        $location = $request->input('location');
        $people = People::with('trades');
        
        if($trade_id) {
            $people->whereHas('trades', function($q) use ($trade_id) {
                $q->whereTradeId($trade_id);
            });

        }
        if($location) {
            $people->where('address', 'LIKE', '%' . $location . '%');
        }
        $people = $people->paginate(15);
        $trades = Trade::get()->pluck('name', 'id');
        
        return view('people/index', ['people' => $people, 'location' => $location, 'trade' => $trade_id, 'trades' => $trades]);
    }

    /**
     * Trade people edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $person = People::findOrFail($id);
        $trades = Trade::pluck('name','id');
        $action = URL::route('people/edit/post', ['id' => $person->id]);
        return view('people/edit', ['trades' => $trades, 'person' => $person, 'action' => $action]);
    }

    /**
     * Trade people add
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $trades = Trade::pluck('name','id');
        return view('people/add', ['trades' => $trades]);
    }

    /**
     * Trade people remove
     *
     * @return \Illuminate\Http\Response
     */
    public function remove( $id )
    {
        $people = People::findOrFail($id);
        $people->trades()->detach();
        $people->delete();
        return Redirect()->route('people')->with(['status' => 'Successfully removed trades person']);
    }


    /**
     * Trade people add (post)
     *
     * @return \Illuminate\Http\Response
     */
    public function add_post(PeopleAddRequest $request)
    {
        $person = new People();
        $person->first_name = $request->input('first_name');
        $person->last_name = $request->input('last_name');
        $person->email = $request->input('email');
        $person->address = $request->input('address');
        $person->dob = $request->input('dob');
        $person->phone = $request->input('phone');
        $person->save();
        $person->trades()->attach( $request->input('trades'));
        return Redirect()->route('people')->with(['status' => 'Successfully Added Trades person']);
    }

    /**
     * Trade people edit (post)
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_post($id, PeopleEditRequest $request)
    {
        $person = People::findOrFail($id);
        $person->first_name = $request->input('first_name');
        $person->last_name = $request->input('last_name');
        $person->email = $request->input('email');
        $person->address = $request->input('address');
        $person->dob = $request->input('dob');
        $person->phone = $request->input('phone');
        $person->save();
        $person->trades()->detach();
        $person->trades()->attach( $request->input('trades'));
        return Redirect()->route('people')->with(['status' => 'Successfully Amended Trades person']);
    }

}
