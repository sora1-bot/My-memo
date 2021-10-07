<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Memo;

class MemoController extends Controller
{
    //
    public function index(Request $request)
    {
        //検索
        $search = $request->input('search');

        $query = Memo::query();

        if ($search !== null) {

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('title', 'like', '%'.$value.'%')->orwhere('sub_title', 'like', '%'.$value.'%')->orwhere('text', 'like', '%'.$value.'%');
            }

            $memos = $query->get();

            return view('index')
            ->with([
                "memos" => $memos,
                'search' => $search,
            ]);
        }

        $memos = Memo::orderBy('created_at', 'asc')->get();

        return view('index', [
            "memos" => $memos
        ]);
    }

    public function createPage()
    {
        return view('create');
    }

    public function create(Request $request)
    {
        $memo = new Memo();
        $memo->title = $request->title;
        $memo->sub_title = $request->sub_title;
        $memo->image = '';
        $memo->text = $request->text;
        
        if(request('image')){
            $filename=request()->file('image')->getClientOriginalName();
            $memo->image = $filename;
            $inputs['image']=request('image')->storeAs('public/images', $filename);
        }
        $memo->save();
        return redirect('/');
    }

    // タスク編集画面を表示
    public function editPage($id)
    {
        $memo = Memo::find($id);
        return view('edit', [
           "memo" => $memo
        ]);
    }

    //タスクを更新
    public function edit(Request $request)
    {
       Memo::find($request->id)->update([
           'title' => $request->title,
           'sub_title' => $request->sub_title,
           //違う可能性大
            'image' => $request->image,
            'text' => $request->text,
        ]);
        return redirect('/');
    }

    //削除画面表示
    public function deletePage($id)
    {        
        $memo = Memo::find($id);
        return view('delete', [           
            "memo" => $memo
        ]);
    }    

    //削除
    public function delete(Request $request)
    {
        Memo::find($request->id)->delete();
        return redirect('/');
    }
}

