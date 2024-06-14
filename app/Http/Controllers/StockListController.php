<?php

namespace App\Http\Controllers;

use App\Models\StockList;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Log;

class StockListController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'lists' => Auth::user()->lists,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'description' => 'required|min:3|max:500',
        ]);

        Auth::user()->lists()->create([
            'name' => $request->name,
            'description' => $request->description,
            'tag' => (new \Visus\Cuid2\Cuid2(10))->toString(),
        ]);

        return redirect()->route('lists.index');
    }

    public function show(): void
    {
    }

    public function edit(): void
    {
    }

    public function update(): void
    {
    }

    public function destroy(Request $request, StockList $list): RedirectResponse
    {
        Log::info($list);

        if ($request->user()->cannot('delete', $list)) {
            Log::info("failed authorisation");
            return back()->withErrors('Resource does not exist');
        }

        $list->delete();

        return redirect()->route('lists.index');
    }
}
