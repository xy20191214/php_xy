<?php

// 书籍相关
Route::prefix('book')->group(function ()
{
    // 书籍分类
    Route::prefix('type')->group(function ()
    {
        // 列表展示、添加、修改与删除
        Route::match(['get', 'post', 'detele', 'put'], '/handles', 'Book\BookTypeController@handles')->name('book.type.handles');
    });
});
