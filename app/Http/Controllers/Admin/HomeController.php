<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:home');
    }
    public function index()
    {
        $User_option = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 3600,
        ];
        $User_chart = new LaravelChart($User_option);

        $post_option = [
            'chart_title' => 'Posts by dates',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 3600,
        ];

        $Post_chart = new LaravelChart($post_option);


        return view('admin.index', compact('User_chart','Post_chart'));
    }
}
