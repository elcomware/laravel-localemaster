<?php

namespace Elcomware\LocaleMaster\Http;

use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class LocaleController extends Controller
{
    public function index(): Factory|View|Application
    {
        $locales = Locale::all();

        return view('locale.index', compact('locales'));
    }

    public function create(): Factory|View|Application
    {
        return view('locale.create');
    }

    public function store(LocaleRequest $request): RedirectResponse
    {

        $currency = Locale::create($request->validated());

        return redirect()->route('locales.index')
            ->with('success', 'Locale added successfully.');
    }

    public function edit(Locale $language): Factory|View|Application
    {
        // Fetch existing language data (from DB or config)
        return view('locale.edit', compact('language'));
    }

    public function update(LocaleRequest $request, Locale $lang): RedirectResponse
    {
        // Update language data
        $lang->update($request->validated());

        return redirect()->route('locale.index')
            ->with('success', 'Locale updated successfully.');

    }

    public function destroy(Locale $language): RedirectResponse
    {

        $language->delete();

        return redirect()->route('locale.index')
            ->with('success', 'Locale deleted successfully.');

    }

    public function switchLocale($lang): RedirectResponse
    {
        LocaleMaster::setLocale($lang);

        // Redirect back to the previous page
        return redirect()->back();

    }
}
