<?php

namespace App\Http\Controllers\Test;

use App\Models\Bank;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Controllers\Imports\RadiusController;

class TestController extends Controller
{


    public function radius()
    {

        
        return 123;
        $lat = 19.52266;
        $lon = 72.91683;

        return (new RadiusController)->fence($lat, $lon);
    }









    public function index()


    {

        DB::table('inventories')
            ->where([
                'bank_id' => 5,
                'blood_component' => 'whole',
                'blood_group' => 'A+',
            ])
            ->increment('units', 1);

            return 123;

        $user = auth()->user();
        $bank = Bank::find($user->banks()->first()->id);

        $bloodComponent = ['whole', 'rbc', 'wbc', 'platelets', 'plasma'];
        $bloodGroup = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'HH'];
        for ($c=0; $c < count($bloodComponent); $c++) { 
            for ($g=0; $g < count($bloodGroup); $g++) { 
                $data[] = [
                    'blood_component' => $bloodComponent[$c],
                    'blood_group' => $bloodGroup[$g],
                ];
            }
        }
        //dd($data);
        $bank->inventories()->createMany($data);
    }

    public function encrypt()
    {
        $donor = Donor::find(10);

        //dd($donor);
        return $donor->contact;

        
    }

    public function roles()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);

        dd($role1);
    }

    public function test()
    {
        $users = User::select('name', 'email')->where('id', '1')->get();
        // dd($users);
        session()->put('ses1', 'value of session 1');
        session()->put('ses2', 'value of session 2');
        // session()->invalidate();
        $sv = 'session var';
        return view('test', compact('users', 'sv'));
    }
}
