<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    //Index
    public function Index()
    {
        return view("user.pageindex");
    }

    //PageAbout
    public function About()
    {
        return view("user.page-about");
    }

    //Activity
    public function activityIndex()
    {
        return view("user.pageindexactivity");
    }

   


    //Background -> Coal Crowd
    public function coalcrowdIndex()
    {
        return view("user.page-index-coal-crowd");
    }
    //Background -> Coal Permit
    public function coalpermitIndex()
    {
        return view("user.page-index-coal-permit");
    }

    //Background ->Regulation
    public function regulationIndex()
    {
        return view("user.page-index-regulation");
    }

    //Background -> Benchmark Price
    public function benchmarkpriceIndex()
    {
        return view("user.page-index-benchmark-price");
    }
    //Background -> Coal Production
    public function coalproductionIndex()
    {
        return view("user.page-index-coal-production");
    }
    //Background -> Coal Consumption
    public function coalconsumptionIndex()
    {
        return view("user.page-index-coal-consumption");
    }
    //Background -> Mining and Deforestation
    public function mininganddeforestationIndex()
    {
        return view("user.page-index-mining-and-deforestation");
    }

    //Action
    public function actionIndex()
    {
        return view("user.pageindexaction");
    }

    public function actionDetail($locale, $id, $slug)
    {
        return view('user.pagedetailaction', compact('locale', 'id', 'slug'));
    }

    //Data -> Check PLTU
    public function checkpltuIndex()
    {
        return view("user.page-index-check-pltu");
    }
}
