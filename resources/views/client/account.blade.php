@extends('client.accountFrame',['title'=> trans('app.accountPage')])

@section('innerContent')
    <script>
        $(document).ready(function () {
            menuActive();
            initFields();

            $("#form").submit(function (event) {
                event.preventDefault();
                refreshAccData();
                return false;
            });
        });

        function initFields() {
            $("#inputGender").val("{{$gender}}");

            $('#type1').prop('checked', "{{$trainingType}}" === "1");
            $('#type2').prop('checked', "{{$trainingType}}" === "2");
            $('#type3').prop('checked', "{{$trainingType}}" === "3");

            $('#typeBody1').prop('checked', "{{$bodyType}}" === "1");
            $('#typeBody2').prop('checked', "{{$bodyType}}" === "2");
            $('#typeBody3').prop('checked', "{{$bodyType}}" === "3");

            $("[name='true']").prop("checked", true);
            $("[name='false']").prop("checked", false);
        }

        function menuActive() {
            $('#account').addClass("active");
        }

        function refreshAccData() {
            alert("Refresh Acc Data");
            var age = $("#inputAge").val();
            var name = $("#inputName").val();
            var email = $("#inputEmail").val();
            var weight = $("#inputWeight").val();
            var gender = $("#inputGender").val();
            var gender = $("#inputGender").val();
            var gender = $("#inputGender").val();
        }

    </script>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form" enctype="multipart/form-data">

            <div class="input-group" style="margin-top: 20px">
                <span class="input-group-addon" style="width: auto">{{trans('app.nameLabel')}}</span>

                <input type="text" class="form-control is-valid" value="{{$name}}" id="inputName" pattern=".{1,100}"
                       required>
            </div>

            <div class="input-group" style="margin-top: 20px">
                <span class="input-group-addon" style="width: auto">{{trans('app.emailAddressLabel')}}</span>

                <input type="text" class="form-control is-valid" value="{{$email}}" id="inputEmail" pattern=".{1,100}"
                       required style="width: 500px">
            </div>


            <div class="form-group row">
                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.age')}}</span>
                    <select class="form-control" style="width: 140px" id="inputAge">
                        @include("spinner",['selection'=>$age])
                    </select>
                </div>
            </div>


            <div class="input-group" style="margin-top: 20px; width: 50%">
                <span class="input-group-addon" style="width: auto">{{trans('app.weight')}}</span>

                <input type="text" class="form-control is-valid" value="{{$weight}}" id="inputWeight" pattern=".{1,100}"
                       required>
            </div>

            <div class="input-group" style="margin-top: 20px">
                <span class="input-group-addon" style="width: auto">{{trans('app.gender')}}</span>
                <select id="inputGender" class="form-control " required>
                    <option value="1" selected>{{trans('app.male')}}</option>
                    <option value="2">{{trans('app.female')}}</option>
                </select>
            </div>

            <div style="margin-top: 35px">
                <div class="form-check form-check-inline">
                    @for($i=1; $i<8; $i++)
                        <label class="form-check-label">
                            <input id="day{{$i}}" type="checkbox"
                                   name="{{\App\Http\BusinessModel\WeekDay::isSelected($trainingSchedule,$i)}}"
                                   class="trainTypeCb" value="{{$i}}">{{\App\Http\BusinessModel\WeekDay::getString($i)}}
                        </label>
                    @endfor
                </div>
            </div>

            <div style="margin-top: 30px">
                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="type1" type="radio" class="trainTypeCb" name="inlineRadioOptions"
                               value="1" {{\App\Http\BusinessModel\TrainingType::isSelected($trainingType,'1')}}>
                        {{trans('app.mass')}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="type2" type="radio" name="inlineRadioOptions"
                               value="2" {{\App\Http\BusinessModel\TrainingType::isSelected($trainingType,'2')}}> {{trans('app.dry')}}
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="type3" type="radio" name="inlineRadioOptions"
                               value="3" {{\App\Http\BusinessModel\TrainingType::isSelected($trainingType,'3')}}>
                        {{trans('app.stamina')}}
                    </label>
                </div>
            </div>
            <div style="margin-top: 30px">
                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="typeBody1" type="radio" name="inlineRadioOptions1"  value="1" >
                        {{trans('app.ectomorph')}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="typeBody2" type="radio" name="inlineRadioOptions1" value="2" > {{trans('app.endomorph')}}
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-input">
                        <input id="typeBody3" type="radio" name="inlineRadioOptions1" value="3" >
                        {{trans('app.mezomorph')}}
                    </label>
                </div>
            </div>

            <button type="submit" id="submit"  class="btn btn-outline-primary" style="width:200px;border:1px solid darkgray; margin-left: 10px">{{trans('app.saveBtn')}}</button>
        </form>
    </div>

@endsection