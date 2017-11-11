<?php

use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\RepoController;
use App\Repo;

use Github\Client;


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('createRepo', function () {
    
	$user = 'symfony';

	$this->comment( "Delete and create new Database tables --> migrate:refresh");
	$exitCode = Artisan::call('migrate:refresh', [
    '--force' => true,
	]);
	
	$count = 0;
	
	 $client = new Client();
	   
		$this->comment( "Fetch all Repository for user ". $user );
		
		$repos = $client->api('user')->repositories($user);
		
		foreach( $repos as $repo){
			$repodb = new Repo();
			$repodb->repoid =  $repo["id"];
			$repodb->rempname =  $repo["name"];
			$repodb->private =  $repo["private"];
			$repodb->description =  $repo["description"];
			$repodb->url =  $repo["url"];
			$repodb->git_url =  $repo["git_url"];
			$repodb->clone_url =  $repo["clone_url"];
			$repodb->html_url =  $repo["html_url"];
			$repodb->save();
			
			$this->comment( ++$count . " : Repository " . $repo["name"] . " Saved" );
		}
		
		$this->comment('');
		$this->comment( "Total ". $count . " record saved --- Process Complete");
	
})->describe('Display an inspiring quote');
