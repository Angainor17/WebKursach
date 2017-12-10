@extends("layouts.app", ["title"=>$title])

@section("content")

    <script>
        function addInCart(id) {
            if ($("#buyBtn").text() == "{{trans('app.inCartLabel')}}") {
                $("#buyBtn").text("{{trans('app.alreadyInCartLabel')}}");
                $.ajax({
                    url: "/addToCart",
                    type: "POST",
                    data: {
                        idProduct: id
                    }
                });
            }
        }
    </script>

    <style>
        #mainField {
            margin-left: 10%;
            margin-right: 10%;
            position: relative;
            background-color: white;
            padding-bottom: 60px;

        }

        .row {
            padding: inherit;
            margin: 3%;

        }

        .title {
            font-size: 22px;
            display: inline-block;
            font-family: "sans-serif";
            margin-right: 20px;

        }

        .text {
            font-size: 14px;
            display: inline-block;
        }

        .buyArea {
            position: absolute;
            right: 5%;
            top: 8%;

            padding-left: 15px;
            padding-right: 15px;
            padding-top: 15px;
            border: 1px solid gray;
            width: auto;
            height: auto;
        }

        #mainField img {
            height: 300px;
            position: absolute;
            right: 0;
            top: 0;
            margin-top: 15%;
        }


    </style>

    <div id="mainField">
        <img src="{{asset("/uploads/" . $item->imageId)}}">

        <div class="row">
            <div class="title">{{trans('app.nameLabel')}}:</div>
            <div class="text">{{$item->name}}</div>
        </div>

        <div class="row">
            <div class="title">{{trans('app.producerLabel')}}:</div>
            <div class="text">{{$item->producer}}</div>
        </div>

        <div class="row">
            <div class="title">{{trans('app.categoryLabel')}}:</div>
            <div class="text">{{\App\Http\BusinessModel\CategoryType::toString($item->category)}}</div>
        </div>

        <div class="row">
            <div class="title">{{trans('app.age')}}:</div>
            <div class="text">{{trans('app.age1') . $item->ageFrom . trans('app.ageTo'). $item->ageTo}}</div>
        </div>

        <div class="row">
            <div class="title">{{trans('app.portionHeader')}}:</div>
            <br>
            <div class="text">{{trans('app.portion1') . $item->portionTotal . trans('app.portion2'). $item->portionSize . ' '
             . \App\Http\BusinessModel\PortionType::toString($item->potionType)}}</div>
            <br>
            <div class="text">{{trans('app.break'). $item->breakTime. trans('app.break2'). $item->breakTime.'  '.trans('app.daysLabel')}}</div>
        </div>

        <div class="row">
            <div class="title">{{trans('app.description')}}:</div>
            <br>
            <div class="text">{{$item->description}}</div>
        </div>

        <div class="buyArea">
            @if($item->instock <=0)
                {{trans('app.instockNo')}}
            @else()
                {{trans('app.instockHas')}}
            @endif

            @if(!Auth::guest())
                <button class="btn btn success" onclick="addInCart('{{$item->id}}')"
                        id="buyBtn">{{$buyButtonText}}</button>
            @endif
        </div>
    </div>

@endsection