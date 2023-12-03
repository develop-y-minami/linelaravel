{{--baseレイアウトを継承--}}
@extends('layouts.base')

{{--タイトルを設定--}}
@section('title', 'トップ')

{{--CSS：固有--}}
@push('css')
@endpush

{{--JavaScript：固有--}}
@push('js')
    <script src="{{ asset('js/apis/line-api.js') }}"></script>
@endpush

{{--表示コンテンツ：トップページ--}}
@section('page')
    <div>
        
    </div>
@endsection