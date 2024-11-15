<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
 
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $user = User::create(['name'=> 'admin', 'email'=>'admin@admin.com', 'password'=>'admin']);
        $user->assignRole('admin');
    }
}