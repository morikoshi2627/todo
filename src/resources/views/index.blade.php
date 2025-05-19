@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- 完了バー -->
<div class="todo__alert">
@if(session('message'))
  <div class="todo__alert--success">
  {{ session('message') }}
  </div>
  @endif
  <!-- エラーメッセージの表示 -->
   @if ($errors->any())
   <div class="todo__alert--danger">
     <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
       </ul>
     </div>
   @endif
</div>
<!-- 完了バーより下の要素 -->
<div class="todo__content">
  <!-- 中級⭐️追加 -->
<div class="section__title">
  <h2>新規作成</h2>
</div>
  <!-- textフィールド -->
  <form class="create-form" action="/todos" method="post">
  @csrf
  <!-- 中級⭐️valueにoldメソッドでｏｋの入力内容を保持 -->
    <div class="create-form__item">
      <input class="create-form_item-input" type="text" name="content" value="{{ old('content') }}">
      <select class="create-form__item-select" name="category_id">
      <option value="">カテゴリ</option>
      @foreach ($categories as $category)
      <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
      @endforeach
    </select>
    </div>
    <!-- 作成ボタンのクラス -->
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
  <!-- 中級⭐️todo検索、カテゴリ、検索ボタン -->
    <div class="section__title">
    <h2>Todo検索</h2>
  </div>
  <form class="search-form" action="/todos/search" method="get">
    @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
      <select class="search-form__item-select" name="category_id">
      @foreach ($categories as $category)
      <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
      @endforeach
      </select>
    </div>
    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>
  <!-- ｔｅｓｔの更新、削除ゾーン -->
  <div class="todo-table">    
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <!-- 中級⭐️サブタイトル -->
        <th class="todo-table__header">
         <span class="todo-table__header-span">Todo</span>
         <span class="todo-table__header-span">カテゴリ</span> 
      </th>
      </tr>
  <!-- test 更新、削除ゾーン -->
  @foreach ($todos as $todo)    
  <tr class="todo-table__row">
        <td class="todo-table__item">
        <!-- 更新機能の実装　Todoデータを更新 -->
        <form class="update-form" action="/todos/update" method="POST">
        @method('PATCH')
        @csrf
            <div class="update-form__item">
            <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content'] }}">
            <input type="hidden" name="id" value="{{ $todo['id'] }}">
            </div>
            <!-- 中級⭐️ -->
           <div class="update-form__item">
             <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
            </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="todo-table__item">
          <form class="delete-form" action="/todos/delete" method="post">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
            <input type="hidden" name="id" value="{{ $todo['id'] }}">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
</div>
