<?php

namespace App\Http\Controllers;

use App\Repo;
use Illuminate\Http\Request;
use Github\Client;



class RepoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		//$data = Repo::all();
		$data = Repo::paginate(15);
		
		return view('repolist', ['result'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
       $client = new Client();
	   
	   $result = false;
		
		
		$repos = $client->api('user')->repositories('symfony');
		
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
			$result = true;
		}
		
	   return view('reposave', ['result'=> $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repo  $repo
     * @return \Illuminate\Http\Response
     */
    public function show(Repo $repo)
    {
        //
    }
	
	 public function search(Request $request)
    {
       

		$data = Repo::where('rempname', 'LIKE', '%'. $request->input('query') .'%')->get();
		
		 //var_dump(  $data );
		 
		
		return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repo  $repo
     * @return \Illuminate\Http\Response
     */
    public function edit(Repo $repo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repo  $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repo $repo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repo  $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repo $repo)
    {
        //
    }
}
