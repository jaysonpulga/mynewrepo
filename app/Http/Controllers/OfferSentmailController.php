<?php

namespace App\Http\Controllers;

use App\offer_sentmail;
use App\OfferSettings;
use Illuminate\Http\Request;

class OfferSentmailController extends Controller
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
	
	
	
	
	
	public function Notification(Request $request)
	{
		
		$user_id =  $request->user()->id;
		$data = offer_sentmail::notification($user_id);
		return response()->json($data);
		
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
     * @param  \App\offer_sentmail  $offer_sentmail
     * @return \Illuminate\Http\Response
     */
    public function show(offer_sentmail $offer_sentmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\offer_sentmail  $offer_sentmail
     * @return \Illuminate\Http\Response
     */
    public function edit(offer_sentmail $offer_sentmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer_sentmail  $offer_sentmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, offer_sentmail $offer_sentmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\offer_sentmail  $offer_sentmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer_sentmail $offer_sentmail)
    {
        //
    }
}
