<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Announcement::class, 'announcement');
    }

    public function index()
    {
        return view('announcements.index');
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', [
            'announcement' => $announcement,
        ]);
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', [
            'announcement' => $announcement,
        ]);
    }
}
