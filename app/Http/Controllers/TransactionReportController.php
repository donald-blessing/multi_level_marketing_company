<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class TransactionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $query = Order::query()->with([
            'purchaser',
            'orderItems',
        ]);


        if (request()->has('distributor')) {
            $query = $query->whereHas('purchaser', function (Builder $query) {
                $query->whereHas('referredBy', function (Builder $query) {
                    $query
                        ->where('first_name', 'like', '%' . request('distributor') . '%')
                        ->orWhere('last_name', 'like', '%' . request('distributor') . '%');
                });
            });
        }


        if (request()->has('date_from')) {
            $date_from = date('Y-m-d', strtotime(request('date_from')));
            $date_to = date('Y-m-d', strtotime(request('date_to', now())));
            $query = $query->whereBetween('order_date', [$date_from, $date_to]);
        }


        $query = $query->orderBy('order_date', 'asc');

        $totalCommission = 0;
        foreach ($query->get() as $order) {
            $totalCommission += $order->getCommission();
        }

        $orders = $query->paginate();
        return view('transaction-report.index', compact('orders', 'totalCommission'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        $order = Order::query()->find($id);
        return view('transaction-report.show', compact('order'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function rank(): View|Factory|Application
    {
        $distributors = User::query()->whereHas('referredDistributors', function (Builder $query) {
            $query->has('orders');
        })->get();
        $ranks = $distributors->map(function ($distributor) {
            $totalSales = $distributor->referredDistributors->map(function ($distributor) {
                return $distributor->order->getTotal();
            })->sum();

            return collect([
                'name' => "$distributor->first_name $distributor->last_name",
                'total_sales' => $totalSales,
            ]);
        })->sortBy([
            ['total_sales', 'desc'],
        ])->take(100)
            ->values()->all()
            ->paginate(15);

        return view('transaction-report.rank', compact('ranks'));
    }


}
