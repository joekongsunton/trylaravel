<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class SubscriptionController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        
        $user = $req->user();
        if ($user->subscribed('main')) {
            //
            return "vous etes deja abonné";
        }
        else{
            return view('subscription');
        }
    }

    public function store(Request $req)
    {  
        //$user = User::find(1);
        //$user = Auth::user();
        $user = $req->user();
        if ($user->subscribed('main')) {
            //
            return "vous etes deja abonné";
        }
        else{
            //return $user;
            $creditCardToken = $req['stripeToken'];
            //return $user;
            $user->newSubscription('main', 'monthly')->create($creditCardToken); // sans coupons
            //$user->newSubscription('main', 'monthly')->withCoupon('CP5')->create($creditCardToken);// avec le coupon de 5 franc créé sur stripe et nommé "CP5"
        }
        

    }
}
