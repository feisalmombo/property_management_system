<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenant;
use App\Property;
use App\ActivityLog;
use DB;
use Auth;
use Carbon\Carbon;

class TenantController extends Controller
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
            if (\Auth::user()->can('view_tenant')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $users = Auth::user()->id;

        // return json_encode($users);

        $tenantData = DB::table('tenants')
            ->join('properties', 'tenants.property_id', '=', 'properties.id')
            // ->join('users', 'tenants.user_id', '=', 'users.id')

            ->select('tenants.id', 'tenants.full_name', 'tenants.email', 'tenants.phone_number', 'tenants.tin', 'tenants.nida_number',
            'tenants.nida_attachment', 'tenants.lease_start', 'tenants.lease_end', 'tenants.lease_attachment', 'tenants.total_amount',
            'tenants.amount_paid', 'tenants.payment_date', 'tenants.receipt_attachment', 'tenants.status AS paid',
            'properties.property_name', 'properties.property_location', 'properties.type', 'properties.status', 'tenants.created_at')
            ->get();

        // return json_encode($tenantData);

        return view('manageTenant.viewTenant')->with('tenantDatas', $tenantData);
    }


    public function overdue()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_overdue')) {
                return $next($request);
            }
            return redirect()->back();
        });

        // $overdue = Tenant::where('lease_end', '<', now())->get();

        $tenantData = DB::table('tenants')
            ->join('properties', 'tenants.property_id', '=', 'properties.id')

            ->select('tenants.id', 'tenants.full_name', 'tenants.email', 'tenants.phone_number', 'tenants.tin', 'tenants.nida_number',
            'tenants.nida_attachment', 'tenants.lease_start', 'tenants.lease_end', 'tenants.lease_attachment', 'tenants.total_amount',
            'tenants.amount_paid', 'tenants.payment_date', 'tenants.receipt_attachment', 'tenants.status AS paid',
            'properties.property_name', 'properties.property_location', 'properties.type', 'properties.status', 'tenants.created_at')
            ->where('lease_end', '<', now())
            ->get();

        return view('manageTenant.viewOverdue')->with('tenantDatas', $tenantData);

    }


    public function expiresoon()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_expiresoon')) {
                return $next($request);
            }
            return redirect()->back();
        });
            // $expiringSoon = Tenant::whereBetween('lease_end', [now(), now()->addDays(7)])->get();

            $tenantData = DB::table('tenants')
            ->join('properties', 'tenants.property_id', '=', 'properties.id')

            ->select('tenants.id', 'tenants.full_name', 'tenants.email', 'tenants.phone_number', 'tenants.tin', 'tenants.nida_number',
            'tenants.nida_attachment', 'tenants.lease_start', 'tenants.lease_end', 'tenants.lease_attachment', 'tenants.total_amount',
            'tenants.amount_paid', 'tenants.payment_date', 'tenants.receipt_attachment', 'tenants.status AS paid',
            'properties.property_name', 'properties.property_location', 'properties.type', 'properties.status', 'tenants.created_at')
            ->whereBetween('lease_end', [now(), now()->addDays(7)])
            ->get();

        return view('manageTenant.viewExpiresoon')->with('tenantDatas', $tenantData);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_tenant')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $tenant = DB::table('tenants')->get();

        $fetchallproperty = DB::table('properties')
        ->select('id', 'property_name')
        ->get();

        // return json_encode($fetchallproperty);

        return view('manageTenant.createTenant')->with('fetchallproperties', $fetchallproperty);
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
            if (\Auth::user()->can('create_tenant')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $this->validate(request(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'property_id' => 'required',
            'lease_start' => 'required',
            'total_amount' => 'required',
            'amount_paid' => 'required',
            'payment_date' => 'required',
            'status' => 'required',

            'nida_attachment' => 'nullable|file|mimes:pdf',
            'lease_attachment' => 'nullable|file|mimes:pdf',
            'receipt_attachment' => 'nullable|file|mimes:pdf',

        ]);

        $property =  Property::where('property_name', $request->property_id)->first();

        // return json_encode($property);

        $lease_end = Carbon::parse($request->lease_start)->addMonths(6);

        $tenant = new Tenant();
        $tenant->full_name = $request->full_name;
        $tenant->email = $request->email;
        $tenant->phone_number = $request->phone_number;
        $tenant->tin = $request->tin;
        $tenant->nida_number = $request->nida_number;

        if ($request->hasFile('nida_attachment')) {
        $tenant->nida_attachment = $request->file('nida_attachment')->store('nida', 'public');
        }

        // $tenant->nida_attachment = $request->nida_attachment->store('nida', 'public');
        $tenant->property_id = $property->id;

        $tenant->lease_start = $request->lease_start;
        $tenant->lease_end = $lease_end;

        if ($request->hasFile('lease_attachment')) {
        $tenant->lease_attachment = $request->file('lease_attachment')->store('lease', 'public');
        }
        // $tenant->lease_attachment = $request->lease_attachment->store('lease', 'public');

        $tenant->total_amount = $request->total_amount;
        $tenant->amount_paid = $request->amount_paid;
        $tenant->payment_date = $request->payment_date;

        if ($request->hasFile('receipt_attachment')) {
        $tenant->receipt_attachment = $request->file('receipt_attachment')->store('receipt', 'public');
        }
        // $tenant->receipt_attachment = $request->receipt_attachment->store('receipts', 'public');
        $tenant->status = $request->status;
        $st = $tenant->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to insert Tenant data');
        } else {
            return redirect('/view/tenants')->with('message', 'Tenant is successfully added');
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
            if (\Auth::user()->can('edit_tenat')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $tenant = Tenant::findOrFail($id);

        $fetchallproperty = DB::table('properties')
        ->select('id', 'property_name')
        ->get();

        return view('manageTenant.editTenant')->with('tenants', $tenant)->with('fetchallproperties', $fetchallproperty);
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
            if (\Auth::user()->can('update_tenant')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $tenant = Tenant::findOrFail($id);

        $this->validate(request(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'property_id' => 'required',
            'lease_start' => 'required',
            'total_amount' => 'required',
            'amount_paid' => 'required',
            'payment_date' => 'required',
            'status' => 'required',

            'nida_attachment' => 'nullable|file|mimes:pdf',
            'lease_attachment' => 'nullable|file|mimes:pdf',
            'receipt_attachment' => 'nullable|file|mimes:pdf',
        ]);

        $property =  Property::where('property_name', $request->property_id)->first();

        // return json_encode($property);

        $lease_end = Carbon::parse($request->lease_start)->addMonths(6);



        $tenant->full_name = $request->full_name;
        $tenant->email = $request->email;
        $tenant->phone_number = $request->phone_number;
        $tenant->tin = $request->tin;
        $tenant->nida_number = $request->nida_number;

        if ($request->hasFile('nida_attachment')) {
        $tenant->nida_attachment = $request->file('nida_attachment')->store('nida', 'public');
        }

        // $tenant->nida_attachment = $request->nida_attachment->store('nida', 'public');
        $tenant->property_id = $property->id;

        $tenant->lease_start = $request->lease_start;
        $tenant->lease_end = $lease_end;

        if ($request->hasFile('lease_attachment')) {
        $tenant->lease_attachment = $request->file('lease_attachment')->store('lease', 'public');
        }
        // $tenant->lease_attachment = $request->lease_attachment->store('lease', 'public');

        $tenant->total_amount = $request->total_amount;
        $tenant->amount_paid = $request->amount_paid;
        $tenant->payment_date = $request->payment_date;

        if ($request->hasFile('receipt_attachment')) {
        $tenant->receipt_attachment = $request->file('receipt_attachment')->store('receipt', 'public');
        }
        // $tenant->receipt_attachment = $request->receipt_attachment->store('receipts', 'public');
        $tenant->status = $request->status;

        // return json_encode($tenant);
        $st = $tenant->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update Tenant data');
        } else {
            return redirect('/view/tenants')->with('message', 'Tenant is successfully updated');
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
            if (\Auth::user()->can('delete_tenant')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $uid = \Auth::id();
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
        ActivityLog::where('changetype', 'Delete Tenant')->update(['user_id' => $uid]);


        $request->session()->flash('message', 'Tenant is successfully deleted');
        return back();
    }
}
