<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_billing_detail;
use Carbon\Carbon;
use App\Mail\SentInvoice;
use App\Mail\SendEmail;
use Auth;
use PDF;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $total_users = User::count();
        $orders_by_user=Order::where('user_id',Auth::id())->get();
        return view('home', compact('users', 'total_users', 'orders_by_user'));
    }
    public function userinsert(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'created_at' => Carbon::now()
        ]);
        return back()->with('use_status', 'User Added Successfully!');
    }

public function downloadinvoice($invoice_id){
    $data =Order::find($invoice_id);

    $pdf=PDF::loadView('pdf.invoice',compact('data'));
        // return  $pdf->download('invoice.pdf'); for direct download
        return  $pdf->stream('invoice.pdf'); //onno tab a open hobe thn dwnload krte chaile parbo

}
public function sendinvoice($invoice_id){
    Mail::to(Auth::user()->email)->send(new SentInvoice($invoice_id));
}
public function sendemail(Request $request){
        Mail::to($request->email)->send(new SendEmail($request->message));
}
}
