<?php

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;
use App\Entities\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Sentinel::findRoleBySlug(User::SUPER_ADMIN))
            return;

        // Adding role super admin
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Admin',
            'slug' => User::SUPER_ADMIN
        ]);

        $permissions = config('permissions');
        $all = [];
        foreach ($permissions as $perms) {
            foreach ($perms as $perm) $all[$perm] = true;
        }
        $role->permissions = $all;
        $role->save();


        // Create super admin
        $user = Sentinel::registerAndActivate(array(
            'id'            => Uuid::generate()->string,
            'email'         => 'hello@endgame.dev',
            'first_name'    => 'End',
            'last_name'     => 'Game',
            'password'      => '123456'
        ));
        $role->users()->attach($user);

        Activation::create($user);
    }
}
