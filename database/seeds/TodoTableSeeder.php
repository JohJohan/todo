<?php

use Illuminate\Database\Seeder;
use App\Todo;
use Carbon\Carbon;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $todo                = 'todo' + $i;
            $todo                = new Todo();
            $todo->id            = $i;
            $todo->title 		 = str_random(10);
            $todo->description 	 = str_random(100);
            // $todo->created_at    = Carbon::now()->format('Y-m-d H:i:s');
            $todo->save();
        }
    }
}
