
<!doctype html>
<head>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    

<div class="container">
<p>My memo</p>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
        <div class="top">
                
        </div>
    </div>
</div>


<form class="mb-2 mt-4 text-center" method="POST" action="/">
@csrf
    <input class="form-control my-2 mr-5" type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <div class="d-flex justify-content-center">
        <button class="btn btn-info my-2" type="submit">検索</button>
        <button class="btn btn-secondary my-2 ml-5">
            <a href="/" class="text-white">
                クリア
            </a>
        </button>
    </div>
</form>

<div class="create">
    <!--<a href="/create-page">タスクを追加</a>-->
    <button type="button" class="btn btn-info-create" onclick="location.href='/create-page'">CREATE</button>
</div>

<div class="row mt-5">

<?php $count = 0; ?>

@foreach($memos as $memo)

<?php $count++; ?>
<img src="{{ asset('image/OPEN.png') }}" alt="" data-toggle="modal" data-target="#exampleModalLong{{$count}}" data-whatever="{{$memo->id}}">
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{$count}}" data-whatever="{{$memo->id}}">Launch demo modal</button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong{{$count}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="menu">
                        <form method="POST" action="/delete">
                        @csrf
                            <input type="hidden" name="id" value="{{$memo->id}}">
                            <input type="submit" name="destroy" value="Delete">
                        </form>
                    </div>
                <!-- if($memo->id == 1)                 -->
                    <h1>＜Title＞</h1>
                    <p1>{{$memo->title}}</h1>
                    <h2>＜サブタイトル＞</h2>
                    <p2>{{$memo->sub_title}}</h2>
                    <h3>＜画像＞</h3>
                    <img src="{{ asset('storage/images/' . $memo->image)}}" class="photo">
                    <h3>＜テキスト＞</h3>
                    <p3>{{$memo->text}}</p>
                <!-- endif -->
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-edit" onclick="location.href='/edit-page/{{$memo->id}}'">EDIT</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    

</body>
</html>