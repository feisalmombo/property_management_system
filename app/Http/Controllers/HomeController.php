<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Role;
use Auth;
use DB;
use App\User;
use App\Property;
use App\Tenant;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // DEVELOPER SIDE
            $permissionCount = DB::select('SELECT COUNT(*) as "permissionCount" FROM permissions');

            $roleCount = DB::select('SELECT COUNT(*) as "roleCount" FROM roles');

            $userCount = DB::select('SELECT COUNT(*) as "userCount" FROM users');

            $propertyregisteredCount = DB::select('SELECT COUNT(*) as "propertyregisteredCount" FROM properties');

            $tenantregisteredCount = DB::select('SELECT COUNT(*) as "tenantregisteredCount" FROM tenants');

            $systemusers= User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->get();
                $chart = Charts::database($systemusers, 'bar', 'highcharts')
                ->setTitle('All Users Chart')
                ->setElementLabel("Users")
                ->setDimensions(1000, 500)
                ->setResponsive(true)
                ->groupByMonth(date('Y'), true);


            $piechartproperties= Property::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
                $piechart = Charts::database(Property::all(), 'bar', 'highcharts')
                ->setTitle('All Properties Chart')
                ->setElementLabel("Total")
                ->setDimensions(1000, 500)
                ->setResponsive(false)
                ->groupByYear();
            // DEVELOPER SIDE


            $expiringSoon = Tenant::whereBetween('lease_end', [now(), now()->addDays(7)])->count();

            $overdue = Tenant::where('lease_end', '<', now())->count();

            // $tenants = Tenant::with('property')->get();



            return view('home')
            ->with('permissionCount', $permissionCount)
            ->with('userCount', $userCount)
            ->with('roleCount', $roleCount)
            ->with('propertyregisteredCount', $propertyregisteredCount)
            ->with('tenantregisteredCount', $tenantregisteredCount)
            ->with('chart', $chart)
            ->with('expiringSoon', $expiringSoon)
            ->with('overdue', $overdue)
            ->with('piechart', $piechart)
            ;
    }
}
