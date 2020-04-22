<?php


namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Model\frontend\user_mailboxes;
use Illuminate\Http\Request;

class MailboxController extends Controller
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


	public function mailbox(Request $request,$task='')
    {
		return view('frontend.mailbox',array('task'=>$task));
    }
	
	
	public function getDatainbox(Request $request)
    {
		$user_id  =  $request->user()->id;
		$mailbox = user_mailboxes::where('message_type','inbox')->where('user_id',$user_id )->get();
		return response()->json($mailbox);
		
    }
	
	
	public function getDatatrash(Request $request)
    {
		$user_id  =  $request->user()->id;
		$mailbox = user_mailboxes::where('message_type','trash')->where('user_id',$user_id )->get();
		return response()->json($mailbox);
		
    }
	
	
	
	public function get_unread_message(Request $request)
	{
		
		 $user_id  =  $request->user()->id;
		$mailbox = user_mailboxes::where('message_type','inbox')
					->where('user_id',$user_id )
					->where('status','unread')
					->get();		
		return response()->json(array('unread_inbox' =>count($mailbox)));			

	}
	
	
	public function view_message(Request $request,$id='',$type='')
	{
		$user_id  =  $request->user()->id;
		$mailbox = user_mailboxes::where('message_type',$type)
				->where('user_id',$user_id)
				->where('id',$id)
				->first();
				
		user_mailboxes::where('id',$id)->update(['status' => 'read']);
				
		return view('frontend.readmailbox',array('messageData'=>$mailbox));
		
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
     * @param  \App\mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function show(mailbox $mailbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function edit(mailbox $mailbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mailbox $mailbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mailbox  $mailbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(mailbox $mailbox)
    {
        //
    }
}
