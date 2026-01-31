<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
  public function up():void{
    Schema::create('users',function(Blueprint $table){
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('emailVerifiedAt')->nullable();
      $table->string('password');
      $table->string('role')->default('user');
      $table->string('address')->nullable();
      $table->string('phone')->nullable();
      $table->rememberToken();
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('password_reset_tokens',function(Blueprint $table){
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('createdAt')->nullable();
    });
    Schema::create('sessions',function(Blueprint $table){
      $table->string('id')->primary();
      $table->foreignId('userId')->nullable()->index();
      $table->string('ipAddress',45)->nullable();
      $table->text('userAgent')->nullable();
      $table->longText('payload');
      $table->integer('lastActivity')->index();
    });
    Schema::create('cache',function(Blueprint $table){
      $table->string('key')->primary();
      $table->mediumText('value');
      $table->integer('expiration');
    });
    Schema::create('cache_locks',function(Blueprint $table){
      $table->string('key')->primary();
      $table->string('owner');
      $table->integer('expiration');
    });
    Schema::create('jobs',function(Blueprint $table){
      $table->id();
      $table->string('queue')->index();
      $table->longText('payload');
      $table->unsignedTinyInteger('attempts');
      $table->unsignedInteger('reserved_at')->nullable();
      $table->unsignedInteger('available_at');
      $table->unsignedInteger('created_at');
    });
    Schema::create('job_batches',function(Blueprint $table){
      $table->string('id')->primary();
      $table->string('name');
      $table->integer('total_jobs');
      $table->integer('pending_jobs');
      $table->integer('failed_jobs');
      $table->longText('failed_job_ids');
      $table->mediumText('options')->nullable();
      $table->integer('cancelled_at')->nullable();
      $table->integer('created_at');
      $table->integer('finished_at')->nullable();
    });
    Schema::create('failed_jobs',function(Blueprint $table){
      $table->id();
      $table->string('uuid')->unique();
      $table->text('connection');
      $table->text('queue');
      $table->longText('payload');
      $table->longText('exception');
      $table->timestamp('failed_at')->useCurrent();
    });
    Schema::create('categories',function(Blueprint $table){
      $table->id();
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('image')->nullable();
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('products',function(Blueprint $table){
      $table->id();
      $table->unsignedBigInteger('categoryId');
      $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
      $table->string('name');
      $table->integer('price');
      $table->integer('stock')->default(0);
      $table->string('image');
      $table->text('description')->nullable();
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('carts',function(Blueprint $table){
      $table->id();
      $table->unsignedBigInteger('userId')->nullable();
      $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
      $table->string('sessionId')->nullable();
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('cart_items',function(Blueprint $table){
      $table->id();
      $table->unsignedBigInteger('cartId');
      $table->foreign('cartId')->references('id')->on('carts')->onDelete('cascade');
      $table->unsignedBigInteger('productId');
      $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
      $table->integer('quantity')->default(1);
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('orders',function(Blueprint $table){
      $table->id();
      $table->unsignedBigInteger('userId');
      $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
      $table->string('status')->default('pending');
      $table->integer('total');
      $table->string('address');
      $table->string('phone');
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
    Schema::create('order_items',function(Blueprint $table){
      $table->id();
      $table->unsignedBigInteger('orderId');
      $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
      $table->unsignedBigInteger('productId');
      $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
      $table->integer('quantity');
      $table->integer('price');
      $table->timestamp('createdAt')->nullable();
      $table->timestamp('updatedAt')->nullable();
    });
  }
  public function down():void{
    Schema::dropIfExists('order_items');
    Schema::dropIfExists('orders');
    Schema::dropIfExists('cart_items');
    Schema::dropIfExists('carts');
    Schema::dropIfExists('products');
    Schema::dropIfExists('categories');
    Schema::dropIfExists('failed_jobs');
    Schema::dropIfExists('job_batches');
    Schema::dropIfExists('jobs');
    Schema::dropIfExists('cache_locks');
    Schema::dropIfExists('cache');
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('users');
  }
};
