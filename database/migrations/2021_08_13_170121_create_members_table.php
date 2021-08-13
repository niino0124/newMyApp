<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('会員ID');
            $table->string('name_sei')->comment('氏名（姓）');
            $table->string('name_mei')->comment('氏名（名）');
            $table->string('nickname')->comment('ニックネーム');
            $table->integer('gender')->comment('性別（1=男性、 2=女性）');
            $table->string('password')->comment('パスワード');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->integer('auth_code')->comment('認証コード')->nullable();
            $table->timestamps();
            $table->softDeletes()->comment('削除日時');
            
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
