$admin = App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('12345678'),
    'role' => 'admin'
]);

php artisan make:migration add_role_to_users_table --table=users
