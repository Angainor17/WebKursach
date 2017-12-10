@extends("admin.frame")

@section("title", trans('app.adminNutritionStrategyPage'))

@section("content")
    <script>
        $(document).ready(function () {

        });

        function saveBtnClick() {
            var jsonData = JSON.stringify(getData());
            $.ajax({
                url: "/admin/updateNs",
                type: "POST",
                dataType: "json",
                data: jsonData
            });
        }

        function getData() {
            var resultList = [];

            var mainList = $(".listItem").toArray();

            mainList.forEach(function (item, i, arr) {
                var result = {
                    title: $(item).find(".header").text(),
                    titleId: $(item).find(".headerId").attr("name"),
                    trainingTypeId: "",
                    ageFrom: "",
                    ageTo: "",
                    bodyTypes: ""
                };

                var ageFrom = $(item).find("[name=ageFrom]").val();
                var ageTo = $(item).find("[name=ageTo]").val();

                result.ageFrom = ageFrom;
                result.ageTo = ageTo;


                var trainTypeCheckBox = $(item).find(".trainTypeCb").toArray();

                var trainingType = "";
                trainTypeCheckBox.forEach(function (item, i, arr) {
                    if ($(item).prop("checked")) {
                        trainingType += $(item).val();
                    }
                });
                result.trainingTypeId = trainingType;
                var bodyTypes = [];

                var viewBodyTypes = $(item).find(".innerListItem").toArray();

                viewBodyTypes.forEach(function (item, i, arr) {
                    var bodyTypeItem = {
                        typeId: "",
                        portion: ""
                    };
                    bodyTypeItem.typeId = $(item).find("#typeId").attr('name');
                    var potionsView = $(item).find(".portionListItem").toArray();
                    var portions = [];
                    //portions.push("");
                    potionsView.forEach(function (item, i, arr) {
                        var value = $(item).find(".form-control").val();
                        portions.push(value);
                    });

                    bodyTypeItem.portion = portions;
                    bodyTypes.push(bodyTypeItem);
                });

                result.bodyTypes = bodyTypes;
                resultList.push(result);
            });
            return resultList;
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

                        <div class="headerId" name="{{$mainListItem->titleId}}" style="display: none">

                        </div>


                        <div id="{{$mainListItem->trainingTypeId}}Area" class="hideArea">
                            <div class="form-group row">
                                <div class="input-group" style="margin-top: 20px">
                                    <span class="input-group-addon"
                                          style="width: auto">{{trans('app.ageFromLabel')}}</span>
                                    <select class="form-control" style="width: 10px" name="ageFrom">
                                        @include("spinner",['selection'=>$mainListItem->ageFrom])
                                    </select>

                                    <span class="input-group-addon"
                                          style="width: auto">{{trans('app.ageToLabel')}}</span>
                                    <select class="form-control" style="width: 10px" name="ageTo">
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
                                        <input type="checkbox" class="trainTypeCb"
                                               value="2" {{\App\Http\BusinessModel\TrainingType::isSelected($mainListItem->trainingTypeId,'2')}}> {{trans('app.dry')}}
                                    </label>


                                    <label class="form-check-label">
                                        <input type="checkbox" class="trainTypeCb"
                                               value="3" {{\App\Http\BusinessModel\TrainingType::isSelected($mainListItem->trainingTypeId,'3')}}>
                                        {{trans('app.stamina')}}
                                    </label>

                                </div>
                            </div>

                            @foreach($mainListItem->bodyTypes as $bodyTypeItem )
                                <div class="innerListItem">
                                    <div style="display: none" id="typeId" name="{{$bodyTypeItem->typeId}}"></div>
                                    {{trans('app.bodyType')}} {{$bodyTypeItem->typeTitle}}

                                    @foreach($bodyTypeItem->portion as $portionItem)
                                        @if(!empty($portionItem))
                                            <div class="portionListItem">

                                                <div class="input-group">
                                                    <span class="input-group-addon"
                                                          style="width: auto">{{trans('app.portionSizeLabel')}}</span>
                                                    <input id="inputPortionSize" type="text"
                                                           class="form-control" style="width: 100px"
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