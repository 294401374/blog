<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		[
	    		'links_name' => '友情连接后盾',
	            'links_title' =>'php网站',
	            'links_url' => 'http://www.houdun.com',
	            'links_order'=>1,
            ],
            [
				'links_name' => '后盾论坛',
	            'links_title' =>'php资料库',
	            'links_url' => 'http://www.houdun.com',
	            'links_order'=>1,
            ]
    	];
        DB::table('links')->insert($data);
    }

}
