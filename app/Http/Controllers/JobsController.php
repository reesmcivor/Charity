<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\People;
use App\Job;
use App\Http\Requests\JobAddRequest;
use App\Http\Requests\JobEditRequest;
use Illuminate\Support\Facades\URL;

class JobsController extends Controller
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
     * Jobs Overview
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $jobs = Job::with('people');
        $filterDate = null;
        if($filterDate = $request->input('filter_date')) {
            $monthRequestedAr = explode("-", $filterDate);
            list($requestedYear, $requestedMonth) = $monthRequestedAr;
            $jobs->whereYear('date', '=', $requestedYear);
            $jobs->whereMonth('date', '=', $requestedMonth);
        }
        for ($i = 0; $i <= 12; $i++) {
            $month = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $months[ $month  . '-01' ] = $month;
        }
        $jobs = $jobs->paginate(15);
        return view('job/index', ['jobs' => $jobs, 'months' => $months, 'filter_date' => $filterDate]);
    }

    /**
     * Job edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $job= Job::findOrFail($id);
        $people = People::pluck('first_name','id');
        $action = URL::route('jobs/edit/post', ['id' => $job->id]);
        return view('job/edit', ['job' => $job, 'people' => $people, 'action' => $action]);
    }

    /**
     * Job add
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $people = People::get()->pluck('full_name','id');
        $action = URL::route('jobs/add/post');
        return view('job/add', ['people' => $people, 'action' => $action]);
    }

    /**
     * Job remove
     *
     * @return \Illuminate\Http\Response
     */
    public function remove( $id )
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return Redirect()->route('jobs')->with(['status' => 'Successfully removed job']);
    }


    /**
     * Job Add (Post)
     *
     * @return \Illuminate\Http\Response
     */
    public function add_post(JobAddRequest $request)
    {
        $job = new Job();
        $job->people_id = $request->input('people_id');
        $job->title = $request->input('title');
        $job->location = $request->input('location');
        $job->description = $request->input('description');
        $job->date = $request->input('date');
        $job->save();
        return Redirect()->route('jobs')->with(['status' => 'Successfully Added Job']);
    }

    /**
     * Job Edit (Post)
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_post($id, JobEditRequest $request)
    {
        $job = Job::findOrFail($id);
        $job->people_id = $request->input('people_id');
        $job->title = $request->input('title');
        $job->location = $request->input('location');
        $job->description = $request->input('description');
        $job->date = $request->input('date');
        $job->save();
        return Redirect()->route('jobs')->with(['status' => 'Successfully Amended Job']);
    }
}
