<?php

namespace App\Http\Controllers;

use App\Keywords;
use Illuminate\Http\Request;

class KeywordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = Keywords::paginate(6);
        
        return view('keywords.index')
            ->with('keywords', $keywords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keywords.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Keywords::create($request->all());
        
        return redirect()->action('KeywordsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keywords  $keywords
     * @return \Illuminate\Http\Response
     */
    public function show(Keywords $keywords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keywords  $keywords
     * @return \Illuminate\Http\Response
     */
    public function edit(Keywords $keyword)
    {
        return view('keywords.edit')
            ->with('keyword' , $keyword);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keywords  $keywords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keywords $keyword)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $keyword->update($request->all());

        return redirect()->action('KeywordsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keywords  $keywords
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keywords $keyword)
    {
        $keyword->delete();

        return redirect()->action('KeywordsController@index');
    }
}
