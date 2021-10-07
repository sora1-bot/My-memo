<!doctype html>
<head>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/create.css') }}" rel="stylesheet">
</head>
<body>
<h1>CREATE</h1>                                                                                                 
    <div>
        
        <form method="POST" action="/create" enctype="multipart/form-data">
            @csrf
            <h1>タイトル</h1>
            <p1><input type="text" name="title"></p1>
            <h2>サブタイトル</h2>
            <p2><input type="text" name="sub_title"></p2>
            <h3>画像</h3>
            <h3><input id="image" type="file" name="image"></h3>
            <h3>テキスト</h3>
            <!--<p3><input type="text" name="text"></p3>-->
            <p3><textarea name="text"  cols="30" rows="10"></textarea></p3>
            
            <input type="submit" class="text" name="create" value="追加">
        </form>
        <a href="/">戻る</a>
    </div>
</body>
</html>