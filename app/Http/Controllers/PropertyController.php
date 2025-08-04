<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use DB;
use Auth;
use App\ActivityLog;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_property')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $propertyData = DB::table('properties')->get();


        return view('manageProperty.viewProperty')->with('propertyDatas', $propertyData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_property')) {
                return $next($request);
            }
            return redirect()->back();
        });

        return view('manageProperty.createProperty');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_property')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $this->validate(request(), [
            'property_name' => 'required|string|max:255',
            'property_location' => 'required|string|max:255',
        ]);

        $property = new Property();
        $property->property_name = $request->property_name;
        $property->property_location = $request->property_location;
        $property->type = $request->type;
        $property->status = $request->status;
        $st = $property->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to insert Property data');
        } else {
            return redirect('/view/properties')->with('message', 'Property is successfully added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('edit_property')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $property = Property::findOrFail($id);

        return view('manageProperty.editProperty')->with('properties', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('edit_property')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $property = Property::findOrFail($id);
        $this->validate(request(), [
            'property_name' => 'required|string|max:255',
            'property_location' => 'required|string|max:255',
        ]);

        $property->property_name = $request->property_name;
        $property->property_location = $request->property_location;
        $property->type = $request->type;
        $property->status = $request->status;
        $st = $property->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update Property data');
        } else {
            return redirect('/view/properties')->with('message', 'Property is successfully updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('delete_property')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $uid = \Auth::id();
        // return json_encode($uid);
        $property = Property::findOrFail($id);
        $property->delete();
        ActivityLog::where('changetype', 'Delete Property')->update(['user_id' => $uid]);

        $request->session()->flash('message', 'Property is successfully deleted');
        return back();
    }
}
