<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Psy\debug;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $announcement;

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
        $announcements = Announcement::all()
            ->where('announcement_status_id', AnnouncementStatus::ACTIVE);


        return view('home')->with('announcements', $announcements);
    }
}
