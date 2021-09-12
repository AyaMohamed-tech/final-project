<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('admin.notifications', compact('notifications'));
    }

    public function show($id)
    {
        $notification = \DB::table('notifications')->where('id', $id)->update([
            'read_at' => \Carbon\Carbon::now()
        ]);

        return redirect('/admin/notifications')->with('id', $id);
    }
}
