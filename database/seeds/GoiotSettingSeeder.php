<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GoiotSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goiot_setting')->insert([
            'host' => 'broker.goiot.id',
            'deviceid' => 'WATER-02',
            'clientid' => '6035344a5f3168660eb24382#rsg_local#',
            'username' => 'ardhi-jpa',
            'password' => '5eb26354a44e97082cc4ccfa',
            'port' => '1883',
            'keepalive' => '0',
            'ph_tag' => 'ph_water1',
            'tss_tag' => 'tss_water1',
            'amonia_tag' => 'amonia_water1',
            'cod_tag' => 'cod_water1',
            'flowmeter_tag' => 'flowmeter_water1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 0,
        ]);
    }
}
