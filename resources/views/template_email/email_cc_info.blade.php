@extends('beautymail::templates.ark')

       
@section('content') 


    @include('beautymail::templates.ark.contentStart')
	
	<h1>Hi {!! $name !!}, </h1>	
	
	<br>
	<br>

    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:18px;line-height:1.5em;margin-top:0;">
    	You are receiving this email because you have requested your credit card information. Please keep your card information safe. You may use the card to purchase more items and to receive your other rebates and bonuses.
	</p>
	
     <p class="secondary">{!! $bodyMessage !!}</p>
	 

	 
	 <br>
 
	 <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:17px;line-height:1.5em">
	 Thank you! Enjoy shopping and get rewarded.
	 </p>
	 <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:17px;line-height:1.5em;">
	 Regards,
	 <br>
	  Shopmonkey.club Team
	 </p>

	 
	 
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0;border-collapse:collapse;table-layout:auto;padding:0">
    <tbody>
	<tr style="padding:0">
        <td align="center" valign="middle" class="m_1031465621739065501close-text" style="word-break:break-word;border-collapse:collapse!important;font-size:14px;border-top-width:1px;border-top-color:#ccc;border-top-style:solid;padding:30px 0 0">
        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px">
			If you having any concern or  suggestion  you may email us at 
          <br>
          <a rel="noopener noreferrer" href="mailto:support@reviewers.club" style="color:#00b2b2;text-decoration:none" target="_blank">support@shopmonkey.club</a>
       </td>
	</tr>
    </tbody>
	</table>
	 


    @include('beautymail::templates.ark.contentEnd')

 
   

@stop