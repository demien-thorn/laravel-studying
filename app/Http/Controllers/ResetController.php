<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function reset(): RedirectResponse
    {
        Artisan::call(command: 'migrate:fresh --seed');

        foreach (['categories', 'products'] as $folder) {
            Storage::deleteDirectory(directory: $folder);
            Storage::makeDirectory(path: $folder);

            $files = Storage::disk(name: 'reset')->files(directory: $folder);
            foreach ($files as $file) {
                Storage::put(path: $file, contents: Storage::disk(name: 'reset')->get(path: $file));
            }
        }

        session()->flash(key: 'success', value: __(key:'notes.reset'));
        return redirect()->route(route: 'index');
    }
}
