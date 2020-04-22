<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\URL;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
		'App\Console\Commands\CheckNotification',
		'App\Console\Commands\WebSocketServer'
		
    ];

	




    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
		
		$schedule->command('check:notification')
                   ->everyMinute()
				   ->sendOutputTo(public_path().'/tasks/log22.txt');

		
		/*
		$schedule->command('websocket:init')
                   ->everyMinute()
				   ->sendOutputTo(public_path().'/tasks/logwebsocket.txt');				   
		*/
		
		
        // $schedule->command('inspire')
        //          ->hourly();
		
		
		/*
		$schedule->call('App\Http\Controllers\frontend\Cronjob_forCustomerController@testkomuna')
				->everyMinute()
				->sendOutputTo(public_path().'/tasks/log.txt');	
		
		*/
		
		
	    $schedule->call('App\Http\Controllers\frontend\Cronjob_forCustomerController@testkomuna')
				->everyMinute()
				->sendOutputTo(public_path().'/tasks/testkomuna.txt');	
		
	
		$route1 = $this->checkifproductreview_is_available();
		$schedule->exec('curl '.$route1)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkifproductreview_is_available.txt'); 
		
		$route2 = $this->checkifcampign_isready_tocontinue();
		$schedule->exec('curl '.$route2)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkifcampign_isready_tocontinue.txt'); 
		
		 
		$route3 = $this->checkifoffer_isreadyfortommorow();
		$schedule->exec('curl '.$route3)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkifoffer_isreadyfortommorow.txt'); 
		
		$route4 = $this->checkifoffer_ismissedtoactive();
		$schedule->exec('curl '.$route4)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkifoffer_ismissedtoactive.txt');
		
		$route5 = $this->checkif_productisdelivered();
		$schedule->exec('curl '.$route5)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkif_productisdelivered.txt');
		
		$route6 = $this->checkif_productreturn_isdelivered();
		$schedule->exec('curl '.$route6)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/checkif_productreturn_isdelivered.txt');  
		
		
		$backend1 = $this->active_campaign();
		$schedule->exec('curl '.$backend1)->everyMinute()
        ->sendOutputTo(public_path().'/tasks/backend/active_campaign.txt');
			
    }
	
	
	public function active_campaign()
	{
		 $urlpath = URL::current();
		 return $urlpath.'/active_campaign';
	} 
	
	
	public function checkifproductreview_is_available()
	{
		
		$urlpath = URL::current();
		return $urlpath.'/checkifproductreview_is_available';
		
	}
	
	

	
	public function checkifcampign_isready_tocontinue()
	{
		$urlpath = URL::current();
		return $urlpath.'/checkifcampign_isready_tocontinue';
	}
	
	public function checkifoffer_isreadyfortommorow()
	{
		$urlpath = URL::current();
		return $urlpath.'/checkifoffer_isreadyfortommorow';
	}
	
	
	public function checkifoffer_ismissedtoactive()
	{
		$urlpath = URL::current();
		return $urlpath.'/checkifoffer_ismissedtoactive';
	}
	 
	public function checkif_productisdelivered()
	{
		$urlpath = URL::current();
		return $urlpath.'/checkif_productisdelivered';
	} 
	 
	public function checkif_productreturn_isdelivered()
	{
		$urlpath = URL::current();
		return $urlpath.'/checkif_productreturn_isdelivered';
	} 
	 
	 
	

	/*
	*
	*backend cronjob
	*/
	 

	 
	 
	 

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
