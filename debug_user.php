<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Attempting to create user...\n";
    $email = 'test_' . time() . '@example.com';
    $user = User::create([
        'name' => 'Test User',
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => $email,
        'password' => Hash::make('password'),
        'role' => 'viewer',
        'is_active' => true,
    ]);

    echo "User object created. ID: " . $user->id . "\n";

    $check = User::find($user->id);
    if ($check) {
        echo "SUCCESS: User found in database.\n";
    } else {
        echo "FAILURE: User NOT found in database.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
