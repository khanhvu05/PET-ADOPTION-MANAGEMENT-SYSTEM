<?php
$users = \App\Models\User::role('user')->get();
foreach($users as $user) {
    $user->syncRoles(['customer']);
}
\Spatie\Permission\Models\Role::where('name', 'user')->delete();
echo "Role user deleted and users migrated.\n";
