@extends('layouts.default')

@section('head')
    <script type="text/javascript">var condition_number = "{{ $condition_number }}"</script>
    @component('components.head')
        @slot('title')
            自動校正サービス
        @endslot
        @slot('css')
            app
        @endslot
        @slot('js')
            app
        @endslot
    @endcomponent
@endsection

@section('header')
    @component('components.header')
        @slot('h1')
            自動校正サービス
        @endslot
    @endcomponent
@endsection

@section('content')
    <form method="POST" action="/" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div id="submit_type">
            {{ Form::radio('submit_type', 'file', true, ['id' => 'submit_type_file'])}}
            {{ Form::label('submit_type_file', 'ファイルをアップロードする') }}
            {{ Form::radio('submit_type', 'text', false, ['id' => 'submit_type_text'])}}
            {{ Form::label('submit_type_text', 'テキストを入力する') }}
        </div>
        <div id="upload_file" class="{{ $hide_upload_file }}">
            <p>校正するテキストファイルをアップロードしてください。</p>
            {{ Form::file('file', ['id' => 'file']) }}
        </div>
        <div id="sentence" class="{{ $hide_sentence }}">
            <p>校正する文章を入力してください。</p>
            {{ Form::textarea('sentence', old('sentence' ), ['placeholder' => 'ここに入力', 'cols' => '100px', 'rows' => '10px']) }}
        </div>
        <div id="conditions">
            <div class="description">
                <p>校正したい文字を入力してください。</p>
                <div>
                    <p id="erase" class="button">校正条件を全消去</p>
                </div>
                <div>
                    <p>校正前</p>
                    <p>校正後</p>
                </div>
            </div>
            <div id="inputs">
                @for ($i = 1; $i <= $condition_number; $i++)
                    <p>{{ $i }}</p>
                    {{ Form::text("before_str$i", old("before_str$i")) }}
                    {{ Form::text("after_str$i", old("after_str$i")) }}
                    <br />
                @endfor
            </div>
            <p id="add" class="button">入力ボックス追加</p>
            <p id="delete" class="button">入力ボックス削除</p>
        </div>
        {{ Form::submit('校正する') }}
    </form>
    <p>ここに校正前の文章が出ます。</p>
    <p id="before_rep">{!! nl2br($before_rep) !!}</p>
    <p>ここに校正後の文章が出ます。</p>
    <p id="after_rep">{!! nl2br($after_rep) !!}</p>
@endsection
