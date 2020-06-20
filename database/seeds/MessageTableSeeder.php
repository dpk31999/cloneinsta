<?php

use Illuminate\Database\Seeder;
use App\MessageGroup;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 30;
        factory(MessageGroup::class, $count)->create();
    }
}
