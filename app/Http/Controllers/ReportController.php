<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InventoryChange;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{

    // REPORT DASHBOARD
    public function index()
    {
        $todaySales = Sale::whereDate('created_at', today())
            ->sum('total_amount');


        $monthlyRevenue = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');


        $productsSold = \App\Models\SaleItem::sum('quantity');


        $sales = Sale::with('items.product')->get();


        $totalRevenue = 0;
        $totalCost = 0;


        foreach($sales as $sale){

            foreach($sale->items as $item){

                $totalRevenue += $item->price * $item->quantity;

                $totalCost += $item->product
                    ? $item->product->buying_price * $item->quantity
                    : 0;
            }
        }


        $profit = $totalRevenue - $totalCost;


        return view('admin.reports.index',compact(
            'todaySales',
            'monthlyRevenue',
            'profit',
            'productsSold'
        ));
    }



    // FILTERED REPORT
    public function filtered(Request $request)
    {

        $query = Sale::with('items.product','cashier');

        $inventoryQuery = InventoryChange::with('product','user');


        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
            $inventoryQuery->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
            $inventoryQuery->whereDate('created_at', '<=', $request->to);
        }


        $sales = $query->latest()->get();

        $inventoryChanges = $inventoryQuery->latest()->get();



        return view('admin.reports.filtered',
            compact(
                'sales',
                'inventoryChanges'
            )
        );
    }




    // PROFIT REPORT
    public function profit()
    {

        $sales = Sale::with('items.product')->get();


        $totalRevenue = 0;
        $totalCost = 0;


        foreach($sales as $sale){

            foreach($sale->items as $item){


                $totalRevenue += 
                    $item->price * $item->quantity;


                if($item->product){

                    $totalCost += 
                    $item->product->buying_price *
                    $item->quantity;

                }

            }

        }



        $profit = $totalRevenue - $totalCost;



        return view('admin.reports.profit',
            compact(
                'totalRevenue',
                'totalCost',
                'profit'
            )
        );

    }





    // TOP PRODUCTS
    public function topProducts()
    {

        $products = Product::withSum(
            'saleItems as total_sold',
            'quantity'
        )
        ->orderByDesc('total_sold')
        ->take(10)
        ->get();


        return view(
            'admin.reports.top-products',
            compact('products')
        );

    }





    // DAILY BUSINESS REPORT
    public function daily()
    {

        $today = Carbon::today();



        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $sales = Sale::with([
            'items.product',
            'cashier'
        ])
        ->whereDate('created_at',$today)
        ->latest()
        ->get();




        $total = $sales->sum(function($sale){

            return $sale->items->sum(function($item){

                return $item->price * $item->quantity;

            });

        });





        /*
        |--------------------------------------------------------------------------
        | INVENTORY CHANGES
        |--------------------------------------------------------------------------
        */

        $inventoryChanges = InventoryChange::with([
            'product',
            'user'
        ])
        ->whereDate('created_at',$today)
        ->latest()
        ->get();






        /*
        |--------------------------------------------------------------------------
        | NEW PRODUCTS
        |--------------------------------------------------------------------------
        */

        $newProducts = Product::whereDate(
            'created_at',
            $today
        )
        ->latest()
        ->get();







        /*
        |--------------------------------------------------------------------------
        | STOCK INCREASED
        |--------------------------------------------------------------------------
        */

        $stockIn = $inventoryChanges->filter(function($item){

            return $item->new_quantity >
                   $item->old_quantity;

        });







        /*
        |--------------------------------------------------------------------------
        | STOCK DECREASED
        |--------------------------------------------------------------------------
        */

        $stockOut = $inventoryChanges->filter(function($item){

            return $item->new_quantity <
                   $item->old_quantity;

        });







        /*
        |--------------------------------------------------------------------------
        | LOW STOCK
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::whereBetween(
            'quantity',
            [1,5]
        )
        ->get();






        /*
        |--------------------------------------------------------------------------
        | OUT OF STOCK
        |--------------------------------------------------------------------------
        */

        $outOfStockProducts = Product::where(
            'quantity',
            0
        )
        ->get();






        return view(
            'admin.reports.daily',
            compact(
                'sales',
                'total',
                'inventoryChanges',
                'newProducts',
                'stockIn',
                'stockOut',
                'lowStockProducts',
                'outOfStockProducts'
            )
        );

    }







    // EXPORT DAILY PDF
    public function exportDailyPdf()
{
    $today = now()->format('Y-m-d');


    $sales = Sale::with(['items.product','cashier'])
        ->whereDate('created_at',$today)
        ->latest()
        ->get();


    $inventoryChanges = InventoryChange::with(['product','user'])
        ->whereDate('created_at',$today)
        ->latest()
        ->get();



    $newProducts = Product::whereDate('created_at',$today)
        ->latest()
        ->get();



    $stockIn = $inventoryChanges->filter(function($item){

        return $item->new_quantity > $item->old_quantity;

    });



    $stockOut = $inventoryChanges->filter(function($item){

        return $item->new_quantity < $item->old_quantity;

    });



    $lowStockProducts = Product::where('quantity','<=',5)
        ->where('quantity','>',0)
        ->get();



    $outOfStockProducts = Product::where('quantity',0)
        ->get();



    $total = $sales->sum(function($sale){

        return $sale->items->sum(function($item){

            return $item->price * $item->quantity;

        });

    });



    $pdf = Pdf::loadView(
        'admin.reports.daily-pdf',
        [
            'sales'=>$sales,
            'inventoryChanges'=>$inventoryChanges,
            'newProducts'=>$newProducts,
            'stockIn'=>$stockIn,
            'stockOut'=>$stockOut,
            'lowStockProducts'=>$lowStockProducts,
            'outOfStockProducts'=>$outOfStockProducts,
            'total'=>$total
        ]
    );


    return $pdf->download(
        'daily_business_report_'.$today.'.pdf'
    );
}


}