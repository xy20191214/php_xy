<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;

use App\Library\Base\Controller,
    App\Model\Book\BookType;

class BookTypeController extends Controller
{
    public $booktype;

    public function __construct(BookType $booktype)
    {
        $this->booktype = $booktype;
    }

    public function handles(Request $request)
    {
        // 操作指针
        $func = $this->outs($request->getMethod());
        $request->id = $request->id ?? 0;
        $request->uid = 10000;
        $request->func = $func;

        // 添加 && 修改标题不能为空
        if ($func == 'adds')
        {
            $request->pid = $request->pid ?? '';
            if (! $request->title) return $this->result(10000);
        }

        return $this->result(200, $this->booktype->$func($request));
    }
}
