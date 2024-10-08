<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeController extends Controller
{
    const PATH_VIEW = 'employes.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employe::latest('id')->paginate(10);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => 'required|email|max:150',
            'phone'           => [
                'required',
                'string',
                'max:15',
                Rule::unique('employes')
            ],
            'date_of_birth'   => [],
            'hire_date'       => [],
            'salary'          => [],
            'is_active'       => [
                'nullable',
                Rule::in([0, 1]),
            ],
            'department_id'   => [],
            'manager_id'      => [],
            'address'         => 'required|max:255',
            'profile_picture' => 'nullable|image|max:5000',
        ]);

        try {

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employes', $request->file('profile_picture'));
            }

            Employe::query()->create($data);

            return redirect()
                ->route('employes.index')
                ->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employe $employe)
    {
        $data = $request->validate([
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => 'required|email|max:150',
            'phone'           => [
                'required',
                'string',
                'max:15',
                Rule::unique('employes')->ignore($employe->id)
            ],
            'date_of_birth'   => [],
            'hire_date'       => [],
            'salary'          => [],
            'is_active'       => [
                'nullable',
                Rule::in([0, 1]),
            ],
            'department_id'   => [],
            'manager_id'      => [],
            'address'         => 'required|max:255',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        try {

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employes', $request->file('profile_picture'));
            }

            $currenprofile_picture = $employe->profile_picture;
            $employe->update($data);

            if ($request->hasFile('profile_picture')
                && !empty($currenprofile_picture)
                && Storage::exists($currenprofile_picture)
            ) {
                Storage::delete('profile_picture');
            }

            return back()
                ->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //xóa mềm
    public function destroy(Employe $employe)
    {
        try {
            $employe->delete();

            return back()
                ->with('success', true);

        } catch (\Throwable $th) {
            return back()
                ->route('employees.index')
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * FORCE Remove the specified resource from storage.
     */
    public function forceDestroy(Employe $employe)
    {
        try {
            $employe->forceDelete();

            if (!empty($employe->profile_picture) && Storage::exists($employe->profile_picture)) {
                Storage::delete($employe->profile_picture);
            }
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
