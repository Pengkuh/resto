<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reservation;
use App\Models\ResTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    public function index()
    {
        return view('User/index');
    }

    public function Booking()
    {
        $table = ResTable::get();
        return view('User/booking', ['table' => $table]);
    }

    public function Reserved(Request $request)
    {

        $res_table = $request->res_table_name;
        $datetime =  $request->datetime;
        $res_visitor =  $request->visitor;

        $table = ResTable::get();
        $Lunch = Product::where('product_category', "Lunch")->get();
        $Breakfast = Product::where('product_category', "Breakfast")->get();
        $Dinner = Product::where('product_category', "Dinner")->get();


        return view('User/list-menu', ['table' => $table, 'Lunch' => $Lunch, 'Breakfast' => $Breakfast, 'Dinner' => $Dinner, 'res_table' => $res_table, 'res_visitor' => $res_visitor, 'datetime' => $datetime]);
    }

    public function Checkout(Request $request)
    {

        // dd($request->all());
        $id = Auth()->user()->id;
        $res_user = User::where('id', $id)->first();
        $datetime =  $request->datetime;

        $res_visitor =  $request->res_total_visitor;

        $res_table = ResTable::where('table_name', $request->res_table_name)->first();
        $res_product = Product::where('product_code', $request->product_code)->first();
        $res_id =        "RS"    . date("dmyhms", strtotime($datetime)) . $res_user->id . $res_table->table_name . $res_product->product_code . date("hms");
        $total_bill  = ($res_product->product_price * $res_visitor) + $res_table->table_price;

        \Midtrans\Config::$serverKey = 'SB-Mid-server-yEqFuG4Fhstft4wp_YJQQUJG';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $res_id,
                'gross_amount' => $total_bill,
            ),
            'customer_details' => array(
                'first_name' => $res_user->name,
                'last_name' => "",
                'email' =>  $res_user->email,
                'phone' =>  $res_user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('User/checkout', ['res_id' => $res_id, 'res_table' => $res_table, 'res_product' => $res_product, 'res_visitor' => $res_visitor, 'res_user' => $res_user, 'total_bill' => $total_bill, 'datetime' => $datetime, 'snapToken' => $snapToken]);
    }


    public function PayBill(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = Auth()->user()->id;
        $res_user = User::where('id', $id)->first();

        $data =   ((json_decode(stripslashes($request->json), true)));

        if ($data['status_code'] == "200") {

            $post = [
                'res_id' => $request->res_id,
                'res_name_user' => $request->res_name_user,
                'res_phone_user' => $request->res_phone_user,
                'res_email_user' => $request->res_email_user,
                'res_total_visitor' => $request->res_total_visitor,
                'res_table_name' => $request->res_table_name,
                'res_table_price' => $request->res_table_price,
                'res_table_category' => $request->res_table_category,
                'res_product_name' => $request->res_product_name,
                'res_product_price' => $request->res_product_price,
                'res_product_category' => $request->res_product_category,
                'res_method_payment' => $data['payment_type'],
                'res_name_payment' => $data['va_numbers']['0']['bank'],
                'res_code_payment' => $data['va_numbers']['0']['va_number'],
                'res_total' => $request->res_total,
                'res_status' => "Paid",
                'created_at' => date('Y-m-d H:i:s', strtotime($request->datetime)),
                "updated_at" => date('Y-m-d H:i:s'),
            ];

            $update = DB::table('res_tables')
                ->where('table_name', $request->res_table_name)
                ->update([
                    'table_status' => "Reserved",
                    'user_id' => $res_user->id,
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);

            // dd($post);
            $store = Reservation::create($post);

            $text = "Terima Kasih Telah Melakukan Reservasi Atas nama $res_user->name pada *" .
                date("d-M-Y  H:m:s", strtotime($request->datetime)) .
                "* Dengan Reservation Id *" . $request->res_id . "* " .
                "Dengan Kode Meja *" . $request->res_table_name . "* " .
                "Dan Status Pembayaran Telah Lunas Sebesar *Rp.$request->res_total" .
                "* Kami Tunggu Kehadirannya";
            $token = "B58s8FPu34t#KnhMvkYd";
            // dd($message);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $res_user->phone,
                    'message' => $text,
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token" //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            if ($store) {
                Session::flash('status', 'success');
                Session::flash('message', 'Reserved Table Success');
            }



            return redirect('/booking');
        }



        return view('notif', ['data' => $data]);
    }

    public function Reservation(Request $request)
    {
        $id = Auth()->user()->id;
        $user = User::where('id', $id)->first();

        $reservation = Reservation::where('res_name_user', $user->name)->get();
        return view('User/reservation', ['user' => $user, 'reservation' => $reservation]);
    }

    public function detailReservation($res_id)
    {
        $id = Auth()->user()->id;
        $user = User::where('id', $id)->first();

        $reservation = Reservation::where('res_id', $res_id)->first();
        // dd($reservation);
        return view('User/detail-reservation', ['user' => $user, 'reservation' => $reservation]);
    }




    public function about()
    {
        return view('Base/about');
    }
    public function services()
    {
        return view('Base/services');
    }
    public function projects()
    {
        return view('Base/projects');
    }
    public function contact()
    {
        return view('Base/contact');
    }

    public function sendMessage(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'subject' => 'required|max:100',
            'message' => 'required|max:255',
            'phone' => 'required|max:15',
        ]);

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => "not acting",
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];

        $db = DB::table('messages')->insert($user);

        if ($db) {
            Session::flash('status', 'success');
            Session::flash('message', "Your message success to sending thank you");
        };

        return redirect()->back();
    }
}
