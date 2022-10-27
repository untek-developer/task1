<?php

use App\Cars;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class InsertData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new User();
        $user->name = 'user1';
        $user->password = Hash::make('userpassword');
        $user->email = 'user1@something.com';
        $user->api_token = 'wnxnNrP/buVMxe1miiQ8w.JXBrhOC5zeMuYUTNAjZV.MySSA80yTG';
        $user->save();

        $user = new User();
        $user->name = 'user2';
        $user->password = Hash::make('userpassword');
        $user->email = 'user2@something.com';
        $user->api_token = 'kqmQ20JdZ7YwUU9rcWuoboJ42qTBpV2y11yu.8m3xGbF7EI';
        $user->save();

        $car = new Cars();
        $car->title = 'Hyundai Solaris';
        $car->save();

        $car = new Cars();
        $car->title = 'Toyota Camry';
        $car->save();

        $car = new Cars();
        $car->title = 'Toyota Land Cruiser';
        $car->save();

        $car = new Cars();
        $car->title = 'Toyota Mark II';
        $car->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
