<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order\ServiceOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $OrderList = $this->orderQuery($request)->paginate(15);
        $data = [
            'title' => 'Order List',
            'service_orders' => $OrderList,
        ];

        return view('backend.order.index')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        ini_set('max_execution_time', '300');
        $service_orders = $this->orderQuery($request)->get();
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('backend.order.pdf', compact('service_orders'));
            return $pdf->download('Orders Report.pdf');
        }

    }

    /**
     * @return Application|Factory|View
     */
    public function show(Request $request, $id)
    {
         $serviceOrder = ServiceOrder::getOrderById($id);

        $data = [
            'title' => ' View Invoice',
            'service_order' => $serviceOrder,
        ];
        return view('backend.order.invoice')->with($data);
    }

    /**
     * @param Request $request
     * @return Builder|mixed
     */
    private function orderQuery(Request $request)
    {
        return ServiceOrder::serviceOrderWithRelation()->orderBy('id', 'desc')
            ->when(!empty(request('search')), function ($q) use ($request) {
                return $q->where('invoice_number', '=', $request->search);
            })->when(!empty(request('status')), function ($q) use ($request) {
                return $q->where('service_orders.order_status', '=', $request->status);
            })->when(!empty(request('date_filter')), function ($q) use ($request) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;
                if ($request->has('start_date') && $request->has('end_date') && !empty($request->start_date) && !empty($request->end_date)) {
                    return $this->dateRangeFilter($q, 'created_at', $startDate, $endDate);
                }
                return $this->dateRangeFilter($q);
            });
    }
}
