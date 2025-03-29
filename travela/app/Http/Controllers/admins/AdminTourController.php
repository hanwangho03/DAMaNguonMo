<?php

namespace App\Http\Controllers\admins;
use App\Models\Tour;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTourController extends Controller
{
    private $adminTour;
    public function __construct(){
        $this->adminTour = new Tour();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tours()
    {
        $tours = $this->adminTour->getAllTours_Admin();
        //dd ($tours);
        return view("admin.tours", compact('tours'));
    }
}
