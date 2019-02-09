<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [ 'name' => 'PHP'],
            [ 'name' => 'Laravel'],
            [ 'name' => 'JS' ],
            [ 'name' => 'Vue'],
            [ 'name' => '小程序'],            
            [ 'name' => '公众号'],            
            [ 'name' => '服务器' ],            
            [ 'name' => '项目'],        
            [ 'name' => '其他'],        
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
