<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\SubCategory;

class SubCategoryController extends Controller
{
    protected $viewDirectory;

    public function __construct()
    {
        $this->middleware('auth');

        $this->viewDirectory = 'subcategories';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();

        return view($this->viewDirectory.'.index', compact(['subcategories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewDirectory.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            
        ]);

        $type = 'error';

        try {
            $subcategory = new SubCategory($request->all());

            $subcategory->save();

            $type = 'success';
            $message = 'Succeeded creating a new subcategory!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to create a new subcategory! : '.$e->getMessage();
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
        $subcategory = SubCategory::findOrFail($id);
        
        return view($this->viewDirectory.'.view', compact(['subcategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        return view($this->viewDirectory.'.edit', compact(['subcategory']));
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
        //validation
        $request->validate([

        ]);

        $type = 'error';

        try {
            $subcategory = SubCategory::findOrFail($id);
            
            $subcategory->fill($request->all());
            
            $subcategory->save();

            $type = 'success';
            $message = 'Succeeded updating a subcategory data!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update a subcategory data! : '.$e->getMessage();
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
            $subcategory = SubCategory::findOrFail($id);

            $subcategory->delete();

            $type = 'success';
            $message = 'Succeeded deleting a subcategory data!';
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a subcategory data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}