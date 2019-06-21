<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $announcementService;

    public function __construct()
    {
        $this->announcementService = new AnnouncementService();
    }

    public function welcome(Request $request)
    {
        $announcements = $this->announcementService->findBy($request->all());

        return view('welcome')->with('announcements', $announcements);
    }
}
