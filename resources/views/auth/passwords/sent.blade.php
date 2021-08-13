@extends('layouts.app')
@section('title', 'パスワード再設定メール送信完了')
@section('content')

            <div class="blue-board">
                <div class="header">
                </div>
                <div  class="man-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="">パスワード再設定の案内メールを送信しました。<br>（まだパスワード再設定は完了しておりません）<br>届きましたメールに記載されている<br>『パスワード再設定URL』をクリックし、<br>パスワードの再設定を完了させてください。</p>
                    <div class="btn-wrap">
                    <a type="button" class="btn btn-back" href="/">トップに戻る</a>
                    </div>
                    </div>
            </div>

@endsection
