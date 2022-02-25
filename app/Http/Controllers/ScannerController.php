<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ScannerController extends Controller
{
    public function scan($type = 'regular')
    {
        return view('pages.scanner.scan', compact('type'));
    }

    public function file($type = 'regular')
    {
        return view('pages.scanner.file', compact('type'));
    }

    public function storeScan(Request $request)
    {
        $request->validate([
            'screenshot' => 'required',
            'type' => 'required|in:regular,confirm',
        ]);

        $image = $request->screenshot;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = auth()->id() . '-' . time() . '.' . 'png';
        Storage::disk('public')->put('screenshots/'.$imageName, base64_decode($image));

        $scanner = auth()->user()->scanners()
            ->create([
                'type' => $request->type,
                'method' => 'scan',
                'image' => $imageName
            ]);

        if($scanner->type == 'confirm') $scanner->user->activatePrize($scanner->id);

        return $request->type == 'regular' ? redirect('?event=register_check&method=scan#main-prize') : redirect('?event=register_check#check-success');
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image',
            'type' => 'required|in:regular,confirm',
        ]);

        if($request->hasFile('screenshot'))
        {
            $imageName = auth()->id() . '-pic-' . time() . '.' . $request->file('screenshot')->getClientOriginalExtension();
            $file = Storage::disk('public')->putFileAs('screenshots', $request->file('screenshot'), $imageName);

            $output = shell_exec('python3 /var/www/twixebaaz/storage/app/public/screenshots/twix.py '.$imageName);

            if($output != null)
            {
                $result = floatval($output);

                if($result > 0.70)
                {
                    $scanner = auth()->user()->scanners()
                        ->create([
                            'type' => $request->type,
                            'method' => 'file',
                            'image' => $imageName
                        ]);

                    if($scanner->type == 'confirm') $scanner->user->activatePrize($scanner->id);

                    return 1;
                }
                else{
                    Storage::disk('public')->delete('screenshots/'.$imageName);
                    return 0;
                }
            }
            else{
                Storage::disk('public')->delete('screenshots/'.$imageName);
                return 0;
            }
        }
        else{
            return 0;
        }
    }
}
