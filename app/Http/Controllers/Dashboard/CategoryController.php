<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Factory|View|Application
    {
        $categories = Category::query()->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::get();
        if($categories)
        {
            if(count($categories) == 5)
            {
                return redirect()->route('categories.index')->withErrors('Cannot add more than 5 categories');
            }
        }
        return view('dashboard.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->withMessage('Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
