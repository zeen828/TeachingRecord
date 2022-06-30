<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
// use App\Entities\Items\Item;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();

            // 數字
            // $table->bigIncrements('bigIncrements');// bigint
            // $table->unsignedBigInteger('unsignedBigInteger');// bigint
            // $table->bigInteger('bigInteger');// bigint <= 9223372036854776000
            // $table->increments('increments');// int
            // $table->unsignedInteger('unsignedInteger');// int
            // $table->integer('integer');// int <= 2147483647
            // $table->mediumIncrements('mediumIncrements');// mediumint
            // $table->unsignedMediumInteger('unsignedMediumInteger');// mediumint
            // $table->mediumInteger('mediumInteger');// mediumint <= 8388607
            // $table->smallIncrements('smallIncrements');// smallint <= 65535
            // $table->unsignedSmallInteger('unsignedSmallInteger');// smallint <= 65535
            // $table->smallInteger('smallInteger');// smallint <= 32767
            // $table->tinyIncrements('tinyIncrements');// tinyint <= 255
            // $table->unsignedTinyInteger('unsignedTinyInteger');// tinyint <= 255
            // $table->tinyInteger('tinyInteger');// tinyint <= 127
            // $table->foreignId('foreignId');// bigint

            // 做Model關聯用的
            // $table->morphs('morphs');// varchar(255)+bigint
            // $table->foreignIdFor(User::class);// bigint
            // $table->nullableMorphs('nullableMorphs');// varchar(255)+bigint
            // $table->nullableUuidMorphs('nullableUuidMorphs');// varchar(255)+char(36)

            // 小數浮點數
            // $table->binary('binary');// blob
            // $table->boolean('boolean');// tinyint(1)
            // $table->decimal('decimal', $precision = 8, $scale = 2);// decimal(8,2)	
            // $table->unsignedDecimal('unsignedDecimal', $precision = 8, $scale = 2);// decimal(8,2)	
            // $table->double('double', 8, 2);// double(8,2)
            // $table->float('float', 8, 2);// double(8,2)

            // 文字
            // $table->char('char', 100);// char(100)
            // $table->enum('enum', ['easy', 'hard']);// enum
            // $table->lineString('lineString');// linestring
            // $table->longText('longText');// longtext
            // $table->mediumText('mediumText');// mediumtext
            // $table->multiLineString('multiLineString');// multilinestring
            // $table->string('string', 100);// varchar(100)
            // $table->text('text');// text
            // $table->tinyText('tinyText');// tinytext
            // $table->uuidMorphs('uuidMorphs');// varchar(255)
            // $table->uuid('uuid');// char(36)
            // $table->ipAddress('ipAddress');// varchar(45)
            // $table->macAddress('macAddress');// varchar(17)
            // $table->foreignUuid('foreignUuid');// char(36)

            // 時間
            // $table->dateTimeTz('dateTimeTz', $precision = 0);// datetime,2022-06-28 01:25:28
            // $table->dateTime('dateTime', $precision = 0);// datetime,2022-06-28 01:25:28
            // $table->date('date');// date,2022-06-02
            // $table->timeTz('timeTz', $precision = 0);// time,09:29:09            
            // $table->time('time', $precision = 0);// time,09:29:09
            // $table->timestampTz('timestampTz', $precision = 0);// timestamp,2022-06-28 01:33:46
            // $table->timestamp('timestamp', $precision = 0);// timestamp,2022-06-28 01:33:46
            // $table->nullableTimestamps(0);// created_at,timestamp + updated_at,timestamp,2022-06-01 09:35:53
            // $table->timestampsTz($precision = 0);// created_at,timestamp + updated_at,timestamp,2022-06-01 09:35:53
            // $table->timestamps($precision = 0);// created_at,timestamp + updated_at,timestamp,2022-06-01 09:35:53
            // $table->softDeletesTz($column = 'softDeletesTz', $precision = 0);// timestamp
            // $table->softDeletes($column = 'softDeletes', $precision = 0);// timestamp
            // $table->year('year');//year,2022

            // 座標用
            // $table->multiPoint('multiPoint');// multipoint
            // $table->multiPolygon('multiPolygon');// multipolygon
            // $table->point('point');// point
            // $table->polygon('polygon');// polygon
            // $table->geometryCollection('geometryCollection');// geomcollection
            // $table->geometry('geometry');// geometry
            // $table->json('json');// json
            // $table->jsonb('jsonb');// json
            // $table->rememberToken();// varchar(100)
            // $table->set('set', ['strawberry', 'vanilla']);// set('strawberry', 'vanilla')

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
