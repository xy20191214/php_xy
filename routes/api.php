<?php

// 笔记相关
Route::prefix('book')->group(function ()
{
    // 书籍目录
    Route::prefix('catalog')->namespace('Book')->group(function ()
    {
        // 列表展示、添加、修改与删除
        Route::post('/handle', 'BookCatalogController@write')->name('book.catalog.write');
        Route::delete('/handle', 'BookCatalogController@remove')->name('book.catalog.remove');
        Route::get('/handle', 'BookCatalogController@read')->name('book.catalog.read');
    });
});
