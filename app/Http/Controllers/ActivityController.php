<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function getHistory()
    {
        return response()->json(Activity::all());
    }
}
