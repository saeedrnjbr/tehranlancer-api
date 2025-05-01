<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Event;
use App\Models\Freelancer;
use App\Models\Product;
use App\Models\User;

class DashboardController extends BaseController
{

    public function index()
    {
        return view("admin.dashboard.index",[
            "users" => User::count(),
            "courses" => Course::count(),
            "freelancers" => Freelancer::count(),
            "products" => Product::count(),
        ]);
    }
}
