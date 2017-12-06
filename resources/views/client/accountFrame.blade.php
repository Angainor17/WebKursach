@extends("layouts.app", ["title"=>$title])

@section("content")

    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
           href="{{url("/admin/article")}}"
           role="tab"
           aria-controls="v-pills-home" aria-selected="true" onclick="">{{trans('app.articles')}}</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="{{url("/admin/product")}}"
           role="tab"
           aria-controls="v-pills-profile" aria-selected="true">{{trans('app.products')}}</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="{{url("/admin/nutritionstrategy")}}"
           role="tab"
           aria-controls="v-pills-messages" aria-selected="true">{{trans('app.nutritionStrategy')}}</a>
    </div>

    @yield('innerContent')

@endsection