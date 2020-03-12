<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\{Role, Permission};

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Role::with('permissions')->get();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $this->authorize('create');
    $input = collect($request->validate([
      'name' => 'required|string|min:2',
      'grant_all_permissions' => ''
    ]));
    $role = Role::create($input->only('name')->all());
    if ($input['grant_all_permissions'] === true)
      $role->givePermissionTo(Permission::get());
    return ['role' => $role, 'message' => 'Role added successfully.'];
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
  public function update(Request $request, Role $role)
  {
    $input = collect($request->validate([
      'name' => 'required|string|min:2',
      'permissions' => '',
      'grant_all_permissions' => ''
    ]));
    $role->name = $input['name'];
    if ($input['grant_all_permissions'] === true) {
      $role->syncPermissions(Permission::get());
    } else {
      $role->syncPermissions(array_map(function ($permission) {
        return $permission['name'];
      }, $input['permissions']));
    }
    $role->save();
    return ['role' => $role, 'message' => 'Role updated successfully.'];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // $this->authorize('delete', $id);
    Role::destroy($id);
    return ['message' => 'Role deleted successfully.'];
  }

  public function revokePermission($roleId, $permissionId)
  {
    $role = Role::find($roleId);
    $permission = Permission::find($permissionId);
    $role->revokePermissionTo($permission);
    return ['role' => $role, 'message' => 'Permission revoked successfully.'];
  }
}
