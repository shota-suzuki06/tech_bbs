<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ secure_asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    <title>TECH BBS</title>
</head>
<body>
<div id="app">
    <header class="navbar is-primary is-mobile">
        <div class="navbar-brand">
            <span class="navbar-item">
                <span class="is-size-4">TECH BBS</span>
            </span>
        </div>
        <div class="navbar-end">
            <span class="navbar-item">
                <span class="is-size-6">IT技術について投稿できる掲示板です</span>
            </span>
        </div>
    </header>

    <div class="form-wrapper columns is-centered is-mobile">
        <form id="form" action="/" method="POST">
            @csrf
            <div class="error-msg">
                @if($errors->has('title'))
                    <div>
                        <p class="has-text-danger has-text-centered">タイトルが入力されてません</p>
                    </div>
                @endif
                @if($errors->has('content'))
                    <div>
                        <p class="has-text-danger has-text-centered">記事内容が入力されてません</p>
                    </div>
                @endif
            </div>
            <div class="column">
                <label class="label">タイトル</label>
                <div class="control">
                    <input id="title" name="title" class="input" type="text" placeholder="タイトル" required>
                </div>
            </div>
            <div class="column">
                <label class="label">記事内容</label>
                <div class="control">
                    <textarea id="content" name="content" class="textarea" placeholder="記事内容" required></textarea>
                </div>
            </div>
            <div class="btns field column is-grouped is-mobile">
                <div class="control">
                    <button type="submit" class="button is-primary">投稿する</button>
                </div>
                <div class="control">
                    <input type="reset" value="キャンセル" class="button is-primary is-light">
                </div>
            </div>
        </form>
    </div>

    <hr>

    @foreach($articles as $article)
    <div class="article-wrapper columns is-centered is-mobile">
        <div class="box column is-half">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong id="title_{{$article -> id}}">{{ $article->title }}</strong> <small>{{ $article->created_at }}</small>
                            <br>
                            <span id="content_{{$article -> id}}">{{ $article->content }}
                        </p>
                        <div class="buttons is-right">
                            <button class="button is-warning is-light" @click="openEditModal({{ $article -> id }})">編集</button>
                            <button class="button is-danger is-light" @click="openDeleteModal({{ $article -> id }})">削除</button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    @endforeach

    <div class="modal" v-bind:class="edit_modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
            <p id="title" class="modal-card-title">編集</p>
        </header>
        <section class="modal-card-body">
        <form id="edit-form"class="edit-form" action="/" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="id" name="id" value="{{ $article -> id }}">
            <div class="column">
                <label class="label">タイトル</label>
                <div class="control">
                    <input id="edit_title" name="title" class="input is-full" type="text" placeholder="タイトル" required>
                </div>
            </div>
            <div class="column">
                <label class="label">記事内容</label>
                <div class="control">
                    <textarea id="edit_content" name="content" class="textarea" placeholder="記事内容" required></textarea>
                </div>
            </div>
            <div class="btns field column is-grouped is-mobile">
                <div class="control">
                    <button type="submit" class="button is-primary">編集する</button>
                </div>
                <div class="control">
                    <input type="reset" value="キャンセル" class="button is-primary is-light" @click="closeModal">
                </div>
            </div>
        </form>
        </section>
        <footer class="modal-card-foot">
        </footer>
        </div>
    </div>

    <div class="modal" v-bind:class="delete_modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
            <p id="titles" class="modal-card-title">Modal title</p>
        </header>
        <section class="modal-card-body">
            <p id="contents"></p>
            <hr>
            <p>こちらの記事を削除しますか？</p>
            <form action="/" method="POST">
                @method('DELETE')
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $article -> id }}">
                <div class="buttons is-right">
                    <button class="button is-danger is-light">はい</button>
                    <a class="button" @click="closeModal">いいえ</a>
                </div>
            </form>
        </section>
        <footer class="modal-card-foot">
        </footer>
        </div>
    </div>

<script src="{{ secure_asset('/js/vue.min.js') }}"></script>
<script src="{{ secure_asset('/js/index.js') }}"></script>
</div>
</body>
</html>