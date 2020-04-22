<?php

namespace App\Http\Controllers;

use App\Model\offer_deny;
use Illuminate\Http\Request;

class OfferDenyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
	
	
	public function deny(Request $request,$id="")
    {
		$user_id =  $request->user()->id;
	   
	   	$offer_deny = new offer_deny();
		$offer_deny->offer_id  	= $id;
		$offer_deny->user_id  	= $user_id;
		$offer_deny->save();
		
		echo 'success';
	   
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\offer_deny  $offer_deny
     * @return \Illuminate\Http\Response
     */
    public function show(offer_deny $offer_deny)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\offer_deny  $offer_deny
     * @return \Illuminate\Http\Response
     */
    public function edit(offer_deny $offer_deny)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\offer_deny  $offer_deny
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, offer_deny $offer_deny)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\offer_deny  $offer_deny
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer_deny $offer_deny)
    {
        //
    }
}
