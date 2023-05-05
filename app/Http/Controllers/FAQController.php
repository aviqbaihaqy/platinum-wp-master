<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\FAQ;

class FAQController extends Controller
{
    protected $viewDirectory;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->viewDirectory = 'faqs';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::all();

        return view($this->viewDirectory . '.index', compact(['faqs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewDirectory . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            
        ]);

        $type = 'error';

        try {
            $faq = new FAQ($request->all());

            $faq->save();

            $type = 'success';
            $message = 'Succeeded creating a new faq!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to create a new faq! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = FAQ::findOrFail($id);
        
        return view($this->viewDirectory . '.view', compact(['faq']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);

        return view($this->viewDirectory . '.edit', compact(['faq']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation
        $request->validate([

        ]);

        $type = 'error';

        try {
            $faq = FAQ::findOrFail($id);
            
            $faq->fill($request->all());
            
            $faq->save();

            $type = 'success';
            $message = 'Succeeded updating a faq data!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update a faq data! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = 'error';

        try {
            $faq = FAQ::findOrFail($id);

            $faq->delete();

            $type = 'success';
            $message = 'Succeeded deleting a faq data!';
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a faq data! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}