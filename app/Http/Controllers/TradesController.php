<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\TradeAddRequest;
use App\Http\Requests\TradeEditRequest;
use App\Trade;
use Illuminate\Support\Facades\URL;
class TradesController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades = DB::table('trades')->paginate(15);
        return view('trades/index', ['trades' => $trades]);
    }

    /**
     * Trade add
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('trades/add');
    }

    /**
     * Trade edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $trade = Trade::findOrFail($id);
        $action = URL::route('trades/edit/post', ['id' => $trade->id]);
        return view('trades/edit', ['trade' => $trade, 'action' => $action]);
    }

    /**
     * Trade edit (post)
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_post( $id, TradeEditRequest $request)
    {
        $trade = Trade::findOrFail($id);
        $trade->name = $request->input('name');
        $trade->save();
        return Redirect()->route('trades')->with(['status', 'Successfully Amended Trade']);
    }


    /**
     * Trade add (post)
     *
     * @return \Illuminate\Http\Response
     */
    public function add_post(TradeAddRequest $request)
    {
        $person = new Trade();
        $person->name = $request->input('name');
        $person->save();
        return Redirect()->route('trades')->with(['status', 'Successfully Added Trade']);
    }

    /**
     * Trade remove
     *
     * @return \Illuminate\Http\Response
     */
    public function remove( $id )
    {
        $trade = Trade::findOrFail($id);
        $trade->delete();
        return redirect('/admin/trades')->with(['status' => 'Successfully removed trade']);
    }
}


