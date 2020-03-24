<?php

// 书籍相关
Route::prefix('book')->group(function ()
{
    // 书籍分类
    Route::prefix('type')->namespace('Book')->group(function ()
    {
        // 列表展示、添加、修改与删除
        Route::match(['post', 'put'], '/handles', 'BookTypeController@iSave')->name('book.type.iSave');
        Route::delete('/handles', 'BookTypeController@iDelete')->name('book.type.iDelete');
        Route::get('/handles', 'BookTypeController@iGet')->name('book.type.iGet');
    });
});
