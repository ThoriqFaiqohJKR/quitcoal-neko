<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function mapInput()
    {
        return view('cms.map-input');
    }
    public function index()
    {
        return view('cms.pageindex');
    }  
    
    // login
    public function login()
    {
        return view('cms.pagelogin');
    }
    //about
    public function About()
    {
        return view('cms.page-about');
    }

    //account
    public function accountIndex()
    {
        return view('cms.page-account');
    }

     //Ngopini
    public function ngopiniIndex() 
    {
        return view("cms.pageindexngopini");
    }

    public function ngopiniInsert()
    {
        return view("cms.pageinsertngopini");
    }
    public function ngopiniEdit($locale, $id)
    {
        return view("cms.pageeditngopini", compact('id'));
    }

     //Aktivitas
    public function activityIndex() 
    {
        return view("cms.pageindexaktivitas");
    }

    public function activityInsert()
    {
        return view("cms.pageinsertaktivitas");
    }
    public function activityEdit($locale, $id)
    {
        return view("cms.pageeditaktivitas", compact('id'));
    }

    //background
    //background -> coalcrowd
    public function coalcrowdIndex()
    {
        return view('cms.page-index-coalcrowd');
    }
    public function coalcrowdInsert()
    {
        return view('cms.page-insert-coalcrowd');
    }
    public function coalcrowdEdit($locale, $id)
    {

        return view('cms.page-edit-coalcrowd', compact('id'));
    }

    //background -> coalpermit
    public function coalpermitIndex()
    {
        return view('cms.page-index-coal-permit');
    }

    //background -> regulation
    public function regulationIndex()
    {
        return view('cms.page-index-regulation');
    }
    public function regulationInsert()
    {
        return view('cms.page-insert-regulation');
    }
    public function regulationEdit($locale, $id)
    {

        return view('cms.page-edit-regulation', compact('id'));
    }

    //background -> benchmark price
    public function benchmarkpriceIndex()
    {
        return view('cms.page-index-benchmark-price');
    }

    //background -> coal production
    public function coalproductionIndex()
    {
        return view('cms.page-index-coal-production');
    }

    //background -> coal consumption
    public function coalconsumptionIndex()
    {
        return view('cms.page-index-coal-consumption');
    }
    //background -> mining and deforestation
    public function mininganddeforestationIndex()
    {
        return view('cms.page-index-mining-and-deforestation');
    }

    //coal-ruption -> cases 
    public function casesIndex()
    {
        return view('cms.page-index-cases');
    }
    public function casesInsert()
    {
        return view('cms.page-insert-cases');
    }
    public function casesEdit($locale, $id)
    {

        return view('cms.page-edit-cases', compact('id'));
    }

    //action
    public function actionIndex()
    {
        return view('cms.pageindexaction');
    }
    public function actionInsert()
    {
        return view('cms.pageinsertaction');
    }
    public function actionEdit($locale, $id)
    {

        return view('cms.pageeditaction', compact('id'));
    }
    public function actionPreview($locale, $id)
    {

        return view('cms.pageriviewaction', compact('id'));
    }

    //data -> resource
    public function resourceIndex()
    {
        return view('cms.pageindexresource');
    }
    public function resourceInsert()
    {
        return view('cms.pageinsertresource');
    }
    public function resourceEdit($locale, $id)
    {

        return view('cms.pageeditresource', compact('id'));
    }

    //data Check-pltu
    public function checkpltuIndex()
    {
        return view('cms.page-index-check-pltu');
    }
    public function checkpltuDetail($locale, $id)
    {
        return view('cms.page-detail-check-pltu', compact('id'));
    }


    public function checkpltuInsert()
    {
        return view('cms.page-insert-check-pltu');
    }

    public function checkpltuEdit($locale, $id)
    {
        return view('cms.pageeditcheckpltu',  compact('id'));
    }

    public function detailpltuInsert()
    {
        return view('cms.pageinsertdetailpltu');
    }


}
