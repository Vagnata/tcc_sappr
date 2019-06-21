<?php

namespace App\Http\Controllers;

use App\Domain\Models\AnnouncementStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Psy\debug;
use App\Domain\Repositories\AnnouncementRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $announcement;

    private $announcementRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->announcementRepository = new AnnouncementRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter['announcement_status_id'] =  AnnouncementStatus::ACTIVE;
        $announcements = $this->announcementRepository->findAll($filter);

        return view('home')->with('announcements', $announcements);
    }
}
