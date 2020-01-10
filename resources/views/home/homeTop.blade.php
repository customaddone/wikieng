@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <!--  まずは適当にボックスを並べる -->
    <main>
        <div class="row">
            <div class="main-image">
                あ
            </div>

            <div class="content">
                あ
            </div>

            <div class="content">
                あ
            </div>

            <div class="content">
                あ
            </div>

            <div class="content-footer">
                あ
            </div>
        </div>
    </main>

    <!-- 他のscssはheader,footerでくくっているので下記のcssとコンフリクトしない -->
    <script src="/js/homeTop.js" type="text/javascript"></script>

    @component('components.footer')
    @endcomponent
@endsection
