<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function get() 
    { 
        if (auth()->check()) {
            // return view('site.home');
            return redirect()->route('dashboard', [
                'month' => date('m'),
                'year' => date('Y'),
            ]);
        } else {
            return app(UserController::class)->loginPage();
        }
    }

    public function dashboard(Request $request)
    {
        if (!empty($request)){
        $month = $request->input('month', date('m'));
            $year = $request->input('year', date('Y'));
            $current_tickets = Ticket::whereMonth('solved_at', $month)->whereYear('solved_at', $year)->get();
        } else {
            $current_tickets = Ticket::whereBetween('solved_at', [now()->startOfMonth(), now()->endOfMonth()])->get();
        }

        $all_tickets = Ticket::all();

        $data = [];
        
        $data['current_tickets_solved_on_time'] = count($current_tickets) > 0
            ? round(($current_tickets
                ->where('status_id', 3)
                ->filter(fn($t) => $t->solved_at && $t->deadline && $t->solved_at <= $t->deadline)->count() / $current_tickets->where('status_id', 3)->count()) * 100, 2)
            : 0;

        $data['all_tickets_solved_on_time'] = count($all_tickets) > 0
            ? round(($all_tickets
                ->where('status_id', 3)
                ->filter(fn($t) => $t->solved_at && $t->deadline && $t->solved_at <= $t->deadline)->count() / $all_tickets->where('status_id', 3)->count()) * 100, 2)
            : 0;

        $data['current_tickets_delayed'] = count($current_tickets) > 0
            ? round($current_tickets
                ->where('status_id', 3)
                ->filter(fn($t) => $t->solved_at && $t->deadline && $t->solved_at >= $t->deadline)->count())
            : 0;

        $data['all_tickets_delayed'] = count($all_tickets) > 0
            ? round($all_tickets
                ->where('status_id', 3)
                ->filter(fn($t) => $t->solved_at && $t->deadline && $t->solved_at >= $t->deadline)->count())
            : 0;

        $data['avg_days_to_solve'] = $all_tickets->where('status_id', 3)->count() > 0
            ? round($all_tickets->where('status_id', 3)->avg(fn($t) => $t->solved_at->diffInDays($t->created_at)), 2)
            : 0;
        

        $data['total_tickets'] = count($all_tickets);

        $data['current_total_tickets'] = count($current_tickets);

        $data['new_tickets'] = count($all_tickets->where('status_id', 1));
        $data['pending_tickets'] = count($all_tickets->where('status_id', 2));
        $data['solved_tickets'] = count($all_tickets->where('status_id', 3));

        info($current_tickets->where('status_id', 3)->where('solved_at', '<=', 'deadline')->count());


        return view('site.dashboard.index', compact('data'));
    }
}
