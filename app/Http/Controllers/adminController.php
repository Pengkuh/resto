<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ResTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index()
    {


        $table = ResTable::get();
        $product = Product::get();
        $reservation = Reservation::get();
        $earn = DB::table('reservations')->sum('res_total');


        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();



        return view('Admin/index', ['table' => $table, 'product' => $product, 'admin' => $admin, 'earn' => $earn]);
    }

    public function reservation()
    {
        date_default_timezone_set('Asia/Jakarta');

        $date = strtotime('now');
        $bill_date = date('m', $date);

        $now = date('M', $date);


        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();

        $reservation = reservation::whereMonth('created_at', $bill_date)->orderBy('id', 'desc')->get();

        return view('Admin/reservation-table', ['reservation' => $reservation, 'now' => $now, 'bill_date' => $bill_date]);
    }

    public function user()
    {
        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();
        $user = User::get();

        return view('Admin/user-table', ['user' => $user, 'admin' => $admin,]);
    }

    public function product()
    {
        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();
        $product = Product::get();

        return view('Admin/product-table', ['product' => $product, 'admin' => $admin,]);
    }

    public function updateProduct(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $product = Product::where('product_code', $request->product_code)->first();


        if ($product->product_images == null) {
            if ($request->file('gambar')) {
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $nama_gambar = "gambar" . "." . $product->product_name . "." . date('Ymd') . "." . $extension;
                $request->file('gambar')->storeAs('product', $nama_gambar);
            } else {
                $nama_gambar = $product->product_image;
            }
        } else {
            $nama_gambar = $product->product_image;
        }

        $product = DB::table('products')
            ->where('id', $request->id)
            ->update([
                'product_code' => $request->product_code,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description,
                'product_category' => $request->product_category,
                'product_image' => $nama_gambar,
                "updated_at" => date('Y-m-d H:i:s'),
            ]);

        return redirect('/product-table');
    }

    public function addProduct(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        // $product = Product::where('product_code', $request->product_code)->first();

        // dd($request->all(), $request->file('gambar'));

        if ($request->file('gambar')) {
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $nama_gambar = "gambar" . "." . date('Ymd') . "." . $extension;
            $request->file('gambar')->storeAs('product', $nama_gambar);
        } else {
            $nama_gambar = $request->product_image;
        }

        $post_product = DB::table('products')
            ->where('id', $request->id)
            ->insert([
                'product_code' => $request->product_code,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description,
                'product_category' => $request->product_category,
                'product_image' => $nama_gambar,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);


        return redirect('/product-table');
    }

    public function detailReservation($res_id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();

        $reservation = reservation::where('res_id', $res_id)->first();

        return view('Admin/detail-reservation', ['reservation' => $reservation, 'admin' => $admin]);
    }

    public function printTable($bill_date)
    {
        date_default_timezone_set('Asia/Jakarta');

        $date = strtotime('now');

        $now = date('M', $date);


        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();

        $reservation = reservation::whereMonth('created_at', $bill_date)->orderBy('id', 'desc')->get();

        return view('Admin/print-table', ['reservation' => $reservation, 'now' => $now, 'bill_date' => $bill_date]);
    }
    public function updateReservation(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        if ($request->status == "Arived") {
            $reservation = DB::table('reservations')
                ->where('res_id', $request->id)
                ->update([
                    'res_status' => $request->status,
                ]);

            return redirect('/reservation-table');
        }

        if ($request->status == "Finish") {

            $query = Reservation::where('res_id', $request->id)->first();


            $reservation = DB::table('reservations')
                ->where('res_id', $request->id)
                ->update([
                    'res_status' => $request->status,
                ]);

            $reservation = DB::table('res_tables')
                ->where('table_name', $query->res_table_name)
                ->update([
                    'table_status' => "Already",
                    'user_id' => null,

                ]);



            return redirect('/reservation-table');
        }

        $date = strtotime('now');
        $bill_date = date('m', $date);

        $id = Auth()->user()->id;
        $admin = Admin::where('id', $id)->first();

        $reservation = reservation::whereMonth('created_at', $bill_date)->orderBy('id', 'desc')->get();
    }
}
