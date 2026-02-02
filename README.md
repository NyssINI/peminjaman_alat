$admin = App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('12345678'),
    'role' => 'admin'
]);
