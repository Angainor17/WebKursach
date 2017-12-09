@extends("admin.frame")

@section("title", trans('app.adminNutritionStrategyPage'))

@section("content")
    <script>
        $(document).ready(function () {

        });

        function saveBtnClick() {
            getData();
        }

        //
        function getData() {
            var resultList = [];


            var mainList = $(".listItem").toArray();

            mainList.forEach(function (item, i, arr) {
                var result = {
                    title: $(".header").innerHTML,
                    trainingTypeId: ""
                };
                var trainTypeCheckBox = $(item).children(".trainTypeCb").toArray();

                var trainingType = "";
                trainTypeCheckBox.forEach(function (item, i, arr) {
                    alert(i + "here")
                    if ($(item).attr("checked")) {
                        trainingType += $(item).val();
                    }
                });
                alert("" + trainingType);

            });

        }

    </script>

    <style>
        #listView {
            padding-left: 3%;
            padding-right: 3%;
            margin-left: 6%;
            padding-top: 50px;
            margin-right: 6%;
            display: block;
            text-align: center;
        }

        .portionListItem {
            border: 1px solid #80837e;
            text-align: left;
            margin: 7px;
            background-color: #f5f5f5;
            font-size: 14px;
            padding: 10px;
        }

        .listItem {
            border: 2px solid #b9b9b9;
            text-align: left;
            margin: 20px;
            font-size: 16px;
            padding: 20px;
        }

        .innerListItem {
            border: 2px solid #80837e;
            text-align: left;
            margin: 20px;
            background-color: #e6e6e6;
            font-size: 16px;
            padding: 20px;
        }

        .header {
            padding-left: 15px;
            border: solid 1px gray;
            background-color: #ffeeba;
        }

        .trainTypeCb {

        }

    </style>

    <div>
        <button type="button" onclick="saveBtnClick()"
                class="btn btn-primary btn-lg btn-block">{{trans('app.saveBtn')}}</button>
        <form>
            <div id="listView">

                <?php
                $list = json_decode($jsonList)
                ?>

                @foreach($list as $mainListItem)
                    <div class="listItem">
                        <div class="header">
                            {{$mainListItem->title}}
                        </div>

                        <div id="{{$mainListItem->trainingTypeId}}Area" class="hideArea">
                            <div class="form-group row">
                                <div class="input-group" style="margin-top: 20px">
                                    <span class="input-group-addon"
                                          style="width: auto">{{trans('app.ageFromLabel')}}</span>
                                    <select class="form-control" style="width: 10px">
                                        @include("spinner",['selection'=>$mainListItem->ageFrom])
                                    </select>

                                    <span class="input-group-addon"
                                          style="width: auto">{{trans('app.ageToLabel')}}</span>
                                    <select class="form-control" style="width: 10px">
                                        @include("spinner",['selection'=>$mainListItem->ageTo])
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="trainTypeCb"
                                               value="1" {{\App\Http\BusinessModel\TrainingType::isSelected($mainListItem->trainingTypeId,'1')}}>
                                        {{trans('app.mass')}}
                                    </label>


                                    <label class="form-check-label">
                                        <input type="checkbox"
                                               value="2" {{\App\Http\BusinessModel\TrainingType::isSelected($mainListItem->trainingTypeId,'2')}}> {{trans('app.dry')}}
                                    </label>


                                    <label class="form-check-label">
                                        <input type="checkbox"
                                               value="3" {{\App\Http\BusinessModel\TrainingType::isSelected($mainListItem->trainingTypeId,'3')}}>
                                        {{trans('app.stamina')}}
                                    </label>

                                </div>
                            </div>

                            @foreach($mainListItem->bodyTypes as $bodyTypeItem )
                                <div class="innerListItem">
                                    {{trans('app.bodyType')}} {{$bodyTypeItem->typeTitle}}

                                    @foreach($bodyTypeItem->portion as $portionItem)
                                        @if(!empty($portionItem))
                                            <div class="portionListItem">

                                                <div class="input-group">
                                                    <span class="input-group-addon"
                                                          style="width: auto">{{trans('app.portionSizeLabel')}}</span>
                                                    <input id="inputPortionSize" type="text"
                                                           class="form-control is-valid" style="width: 100px"
                                                           placeholder="0" value="{{$portionItem->size}}"
                                                           pattern="\d+(\.\d{2})?" required>

                                                    <span class="input-group-addon"
                                                          style="width: auto">{{trans('app.portionTypeLabel')}}:</span>

                                                    <span class="input-group-addon"
                                                          style="width: auto">{{$portionItem->type}}</span>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>


@endsection