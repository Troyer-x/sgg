<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function create()
    {
        $departments = Department::all(); 
        return view('departments.upsert', compact('departments'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            Department::create([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id', null),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/home')->with('error', __('departments.create_error'));
        }
        DB::commit();

        return redirect('/home')->with('success', __('departments.create_success'));
    }

    public function edit(Department $department)
    {
        //Gets all departments but ignores the current one.
        $departments = Department::where('id', '!=', $department->id)->get();
        return view('departments.upsert', compact('departments', 'department'));
    }

    public function update(Request $request, Department $department)
    {

        $request->validate([
            'name' => 'required|string|max:255'
        ]);
 
        DB::beginTransaction();
        try {
            //If parent_id is not set, set it to null
            $request->merge(['parent_id' => $request->input('parent_id', null)]);
            $department->update($request->only(['name', 'parent_id']));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/home')->with('error', __('departments.update_error'));
        }
        DB::commit();
        return redirect('/home')->with('success', __('departments.update_success'));
    }

    public function destroy(Department $department)
    {

        DB::beginTransaction();
        try {
            //If department has parent, set all children to parent
            if ($department->parent_id) {
                $department->children()->update(['parent_id' => $department->parent_id]);
            }
            //Detach all users from department
            $department->users()->detach();
            $department->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/home')->with('error',  __('departments.delete_error'));
        }
        DB::commit();

        return redirect('/home')->with('success', __('departments.delete_success'));
    }

    public function manageUsers(Department $department)
    {
        $users = $department->users;
        //Get users that are not in the department
        $usersNotInDepartment = DB::table('users')
            ->whereNotIn('id', $users->pluck('id'))
            ->get();
        return view('departments.manage_users', compact('department', 'users', 'usersNotInDepartment'));
    }

    public function addUser(Department $department) {
        $department->users()->attach(request('user_id'));
        return redirect()->back()->with('success', __('departments.user_added_successfully'));
    }

    public function removeUser(Department $department, User $user) {
        $department->users()->detach($user->id);
        return redirect()->back()->with('success', __('departments.user_removed_successfully'));
    }

    public function hierarchy()
    {
        $departments = Department::with('children')->whereNull('parent_id')->get();

        $hierarchy = $this->getHierarchy($departments);

        return view('departments.hierarchy', compact('hierarchy'));
    }

    //Recursive function to get the hierarchy of departments
    protected function getHierarchy($departments)
    {
        $result = [];

        foreach ($departments as $department) {
            $children = $this->getHierarchy($department->children);

            $result[] = [
                'id' => $department->id,
                'name' => $department->name,
                'children' => $children,
            ];
        }

        return $result;
    }

}
