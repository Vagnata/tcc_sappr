<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcementService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->announcementService = new AnnouncementService();
    }

    public function list(Request $request)
    {
        $announcements = $this->announcementService->findByUser($request->all());

        return view('announcement.list')->with('announcements', $announcements);
    }

    public function showForm(Request $request)
    {
        if ($request->route('id')) {
            return 'edição';
        } else {
            return view('announcement.form');
        }
    }
}
