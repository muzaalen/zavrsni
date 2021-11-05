<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Http\Controllers\Controller;
use App\Page;
use App\Http\Requests\WorkWithPage;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct() {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdminOrEditor()) {
            $pages = Page::paginate(5);
        } else {
            $pages = Auth::user()->pages()->paginate(5);
        }
        return view('admin.pages.index' , ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create')->with(['model' => new Page()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkWithPage $request)
    {
        
        //dd(Auth::user());
        //dd($request->all());

        /*echo "<pre>";
        print_r($request->all());
        die;*/


        
        /*Auth::user()->pages()->save(new Page(
            $request->only(['title','url','content','file_path'])));*/



            /*$request->validate([
                'title' => 'required',
                'url' => 'required',
                'content' => 'required',
                'user_id' => 'required',
                'file_path' => 'nullable'
            ]);*/


            $page = New Page;

            $page->title = $request->title;
            $page->url = $request->url;
            $page->content = $request->content;
            $page->user_id = Auth::user()->id;



            if ($request->file('file_path')!=null) {
            $page->file_path = $request->file_path->store('photos','public');
            }



            $page->save();

            

            return redirect()->route('pages.index')->with('status' , 'Page created.');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
    if ((Auth::user()->isAdminOrEditor()) || (Auth::user()->id == $page->user_id)) {
        return view('admin.pages.edit' , ['model' => $page]); 
        } else {
    
    return redirect()->route('pages.index');}
    }


    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(WorkWithPage $request, Page $page)
    {
        if (Auth::user()->cant('update' , $page)) {
            return redirect()->route('pages.index');
        }

        $page->fill($request->only([
            'title','url','content', 'file_path']));

            if ($request->file('file_path')!=null) {
                $page->file_path = $request->file_path->store('photos','public');
                }

        

        $page->save();

        return redirect()->route('pages.index')->with('status' , 'Page updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    /*ako delete ne radi (a neće naravno) onda iskoristi svoju brljažu iz edita*/
    /*{
        if (Auth::user()->cant('delete' , $page)) {
            return redirect()->route('pages.index');
        }
        return view('admin.pages.edit' , ['model' => $page]);
    }*/



    /*{ if(Auth::user()->hasAnyRole('admin'))

    {
        $page = Page::find($id);

        if($page) {
            $page->delete();
            return redirect()->route('admin.pages.index')->with('success', 'Page has been deleted');
        }

    }
    else {
        return redirect()->route('admin.pages.index')->with('warning', 'This page cannot be deleted');
    }*/
    
    {if ((Auth::user()->isAdminOrEditor()) || (Auth::user()->id == $page->user_id)) {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted.');
         
        } else {
    
    return redirect()->route('pages.index');}
    }


}

