<?php
use Illuminate\Database\Seeder;
class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= App\Category::all()->count(); $i++){
            factory(App\Topic::class, 10)->create([
                'category_id' => $i,
            ]);
        }
    }
}