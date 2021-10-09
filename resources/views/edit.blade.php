<!doctype html>
<head>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/create.css') }}" rel="stylesheet">
</head>
<body>
<h1>CREATE</h1>                                                                                                 
<div>
    
    <form method="POST" action="/edit" enctype="multipart/form-data">
        @csrf
        <h1>タイトル</h1>
        <h1><input type="text" name="title" value="{{$memo->title}}"></h1>
        <h2>サブタイトル</h2>
        <h2><input type="text" name="sub_title" value="{{$memo->sub_title}}"></h2>
        <h3>画像</h3>
        <h3><input id="image" type="file" name="image" value="{{ asset('storage/images/' . $memo->image)}}"></h3>
        <h3>テキスト</h3>
        <h3><input type="text" name="text" value="{{$memo->text}}"></h3>
        
        <input type="hidden" name="id" value="{{$memo->id}}">
        <input type="submit" name="edit" value="修正">
    </form>
    <a href="/">戻る</a>
</div>
</body>
</html>