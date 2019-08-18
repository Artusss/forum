<?php
use Illuminate\Database\Seeder;
class DecisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= App\Topic::all()->count(); $i++){
            factory(App\Decision::class, 15)->create([
                'topic_id' => $i,
            ]);
        }
    }
}
