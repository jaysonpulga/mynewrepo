@extends('beautymail::templates.ark')

       
@section('content') 


    @include('beautymail::templates.ark.contentStart')
	
	<h1>Hi {!! $name !!}, </h1>	
	
	<br>
	<br>

    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:18px;line-height:1.5em;margin-top:0;">
		You are receiving this email to invite you for a new campaign.
	</p>
	
     <p class="secondary">{!! $bodyMessage !!}</p>
	 
	<center>	
		<a href='{{$urlpath}}' style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1" target="_blank" data-saferedirecturl="https://www.google.com/url?q={{$urlpath}}">Link to our site</a>
	 </center>
	 
	 <br>
 
	 <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:17px;line-height:1.5em">
	 Thank you for using our site,
	 </p>
	 <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:17px;line-height:1.5em;">
	 Regards,
	 <br>
    	{{ env('APP_NAME') }} Team
	 </p>

	 
	 
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0;border-collapse:collapse;table-layout:auto;padding:0">
    <tbody>
	<tr style="padding:0">
        <td align="center" valign="middle" class="m_1031465621739065501close-text" style="word-break:break-word;border-collapse:collapse!important;font-size:14px;border-top-width:1px;border-top-color:#ccc;border-top-style:solid;padding:30px 0 0">
        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px">
			If you having any concern or  suggestion  you may email us at 
          <br>
        <a rel="noopener noreferrer" href="mailto:support@<?php echo env('SUPPORT_MAIL_TO') ?>" style="color:#00b2b2;text-decoration:none" target="_blank">support@<?php echo env('SUPPORT_MAIL_TO') ?></a>
       </td>
	</tr>
    </tbody>
	</table>
	 


    @include('beautymail::templates.ark.contentEnd')

 
   

@stop