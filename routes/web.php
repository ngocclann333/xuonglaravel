<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/baitap1', function () {
    $bai1 = DB::table('users as u')
        ->select('u.name', DB::raw('SUM(o.amount) as total_spent'))
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->groupBy('u.name')
        ->having('total_spent', '>', 1000);
    //dd($bai1->toRawSql());

    $bai2 = DB::table('orders')
        ->select(
            DB::raw('DATE(order_date) AS date'),
            DB::raw('COUNT(*) AS orders_count'),
            DB::raw('SUM(total_amount) AS total_sales')
        )
        ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
        ->groupBy(DB::raw('DATE(order_date)'));
    //dd($bai2->toRawSql());

    $bai3 = DB::table('products as p')
        ->select('p.product_name')
        ->whereNotExists(function ($pro) {
            $pro->select(DB::raw(1))
                ->from('orders as o')
                ->whereColumn('o.product_id', 'p.id');
        });
    //dd($bai3->toRawSql());

    $bai4 = DB::table(DB::raw("(SELECT product_id, SUM(quantity) AS total_sold FROM sales GROUP BY product_id) AS sales_cte"))
        ->join('products as p', 'sales_cte.product_id', '=', 'p.id')
        ->select('p.product_name', 'sales_cte.total_sold')
        ->where('sales_cte.total_sold', '>', 100);
    //dd($bai4->toRawSql());

    $bai5 = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select('users.name', 'products.product_name', 'orders.order_date')
        ->where('orders.order_date', '>=', DB::raw('NOW()-INTERVAL 30 DAY'));
    //dd($bai5->toRawSql());

    $bai6 = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select(
            DB::raw("DATE_FORMAT(orders.order_date, '%Y-%m') AS order_month"),
            DB::raw('SUM(order_items.quantity * order_items.price) AS total_revenue')
        )
        ->where('orders.status', 'completed')
        ->groupBy(DB::raw("order_month"))
        ->orderBy('order_month', 'DESC');
    //dd($bai6->toRawSql());

    $bai7 = DB::table('products')
        ->leftJoin('order_items', 'products_id', '=', 'order_items.product_id')
        ->select(DB::raw('products.product_name'))
        ->where('order_items.product_id', 'IS NULL');
    //dd($bai7->toRawSql());

    $bai8 = DB::table('products as p')
        ->join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) AS max_revenue'))
        ->groupBy('p.category_id', 'p.product_name')
        ->orderBy('max_revenue', 'DESC');
    //dd($bai8->toRawSql());

    $bai9 = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order_items.quantity * order_items.price) AS total_value'))
        ->groupBy('orders.id', 'users.name', 'orders.order_date')
        ->havingRaw('total_value > (
        SELECT AVG(total) FROM (
            SELECT SUM(quantity * price) AS total FROM order_items GROUP BY order_id
        ) as avg_order_value
    )');
    //dd($bai9->toRawSql());

    $bai10 = DB::table('products as p')
        ->join('order_item as oi', 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw('SUM(oi.quantity) as total_sold'))
        ->groupBy('p.category_id', 'p.product_name')
        ->havingRaw('total_sold = (
        SELECT MAX(sub.total_sold)
        FROM (
            SELECT p.product_name, SUM(oi.quantity) AS total_sold
            FROM order_items as oi
            JOIN products as p ON p.product_id = oi.product_id
            WHERE p.category_id = p.category_id
            GROUP BY p.product_name
        ) as sub
    )');
    //dd($bai10->toRawSql());
});


Route::resource('sales',SaleController::class);
Route::resource('expenses',ExpensesController::class);
Route::resource('fin',FinancialReportController::class);

