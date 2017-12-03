@extends("admin.frame")

@section("title", "Products")

@section("content")

    <script>
        $(function () {
            table = $('#products-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: '/admin/product/list'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'producer', name: 'producer'},
                    {data: 'category', name: 'category'},
                    {data: 'cost', name: 'cost'},
                    {data: 'discount', name: 'discount'},
                    {data: 'portionsSize', name: 'portionsSize'}
                ]
            });
        });

        function doOnStart() {
            initProductTable();

            $("#form").submit(function (event) {
                event.preventDefault();
                addProductEvent();
                return false;
            });

            $("#editBtn").text({{trans('app.editBtn')}});


            $("#editBtn").click(function () {
                editBtnClickEvent();
            });


            $("#deleteBtn").click(function () {
                deleteProductBtnEvent();
            });

            cleanAllProductsFields();
        }


        $(document).ready(function () {
            doOnStart();
        });

        function initProductTable() {

            $('#products-table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        }

        function deleteProductBtnEvent() {
            if ($('#products-table').DataTable().row('.selected').count() > 0) {
                $.ajax({
                    url: '/admin/product/delete/' + $('#products-table').DataTable().row('.selected').data().id,
                    type: 'GET',
                    success: function (result) {
                        refreshProductTable();
                        $('#products-table').DataTable().row('.selected').remove().draw();
                    }
                });

            }
        }

        function editBtnClickEvent() {
            if (!($("#editBtn").text() == "Edit\n" || $("#editBtn").text() == 'Edit')) {

                setBtnEnable('#addBtn', true);
                setBtnEnable('#deleteBtn', true);
                $("#editBtn").text({{trans('app.editBtn')}});
                updateProductById(editId);
            } else {
                if ($('#products-table').DataTable().row('.selected').count() > 0) {

                    editId = $('#products-table').DataTable().row('.selected').data().id;
                    $.ajax({
                        url: '/admin/product/get/' + editId,
                        type: 'GET',
                        success: function (result) {
                            fillAllProductsFields(JSON.parse(result));
                            $("#editBtn").text({{trans('app.updateBtn')}});
                            scrollUp();
                            setBtnEnable('#addBtn', false);
                            setBtnEnable('#deleteBtn', false);
                        }
                    });
                } else {
                    alert({{trans('app.chooseItemAlert')}});
                }
            }
        }

        function setBtnEnable(id, isEnable) {
            if (isEnable) {
                $(id).prop('disabled', false);
                $(id).attr('class', 'btn btn-outline-primary');
            } else {
                $(id).prop('disabled', true);
                $(id).attr('class', 'btn btn-default');
            }
        }

        function scrollUp() {
            $(window).scrollTop(0);
        }

        var editId = 0;

        function addProductEvent() {
            var formData = new FormData($("#form")[0]);
            $.ajax({
                url: '/admin/uploadFile',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (imageId) {
                    alert(imageId);
                    addProductItem(imageId);
                }
            });
        }

        function updateProductById(id) {
            var body = {
                id: id,
                name: $('#inputNameRu').val(),
                name_en: $('#inputNameEn').val(),
                producer: $('#inputProducer').val(),
                description: $('#inputDescriptionRu').val(),
                description_en: $('#inputDescriptionEn').val(),
                ageFrom: $('#inputAgeFrom').val(),
                ageTo: $('#inputAgeTo').val(),
                cost: $('#inputCost').val(),
                discount: $('#inputDiscount').val(),
                category: $('#inputCategory').val(),
                portionType: $('#inputPortionType').val(),
                portionSize: $('#inputPortionSize').val(),
                portionTotal: $('#inputPortionTotal').val(),
                maxTime: $('#inputMaxTime').val(),
                breakTime: $('#inputBreakTime').val(),
                instock: $('#inputInstock').val()
            };

            $.ajax({
                url: "/admin/product/update",
                type: "POST",
                data: JSON.stringify(body),
                dataType: "json",
                success: function (result) {
                    cleanAllProductsFields();
                    refreshProductTable()
                }
            });
        }

        function addProductItem(imageId) {
            var body = {
                name: $('#inputNameRu').val(),
                name_en: $('#inputNameEn').val(),
                producer: $('#inputProducer').val(),
                description: $('#inputDescriptionRu').val(),
                description_en: $('#inputDescriptionEn').val(),
                ageFrom: $('#inputAgeFrom').val(),
                ageTo: $('#inputAgeTo').val(),
                imageId: imageId,
                cost: $('#inputCost').val(),
                discount: $('#inputDiscount').val(),
                category: $('#inputCategory').val(),
                portionType: $('#inputPortionType').val(),
                portionSize: $('#inputPortionSize').val(),
                portionTotal: $('#inputPortionTotal').val(),
                maxTime: $('#inputMaxTime').val(),
                breakTime: $('#inputBreakTime').val(),
                instock: $('#inputInstock').val()
            };

            var jsonBody = JSON.stringify(body);
            $.ajax({
                url: "/admin/product/add",
                type: "POST",
                data: jsonBody,
                dataType: "json",
                success: function (result) {
                    alert(result);
                    cleanAllProductsFields();
                    refreshProductTable();
                }
            });
        }

        function refreshProductTable() {
            $('#products-table').DataTable().ajax.reload();
        }

        function cleanAllProductsFields() {
            $('#inputNameRu').val("");
            $('#inputNameEn').val("");
            $('#inputProducer').val("");
            $('#inputDescriptionRu').val("");
            $('#inputDescriptionEn').val("");
            $('#inputAgeFrom').val(0);
            $('#inputAgeTo').val(0);
            $('#inputImageFile').val("");
            $('#inputCost').val("");
            $('#inputDiscount').val("");
            $('#inputCategory').val(1);
            $('#inputPortionType').val(1);
            $('#inputPortionSize').val("");
            $('#inputPortionTotal').val("");
            $('#inputMaxTime').val("");
            $('#inputBreakTime').val("");
            $('#inputInstock').val("");
        }

        function fillAllProductsFields(item) {
            $('#inputNameRu').val(item.name);
            $('#inputNameEn').val(item.name_en);
            $('#inputProducer').val(item.producer);
            $('#inputDescriptionRu').val(item.description);
            $('#inputDescriptionEn').val(item.description_en);
            $('#inputAgeFrom').val(item.ageFrom);
            $('#inputAgeTo').val(item.ageTo);
            $('#inputCost').val(item.cost);
            $('#inputDiscount').val(item.discount);
            $('#inputCategory').val(item.category);
            $('#inputPortionType').val(item.portionType);
            $('#inputPortionSize').val(item.portionSize);
            $('#inputPortionTotal').val(item.portionTotal);
            $('#inputMaxTime').val(item.maxTime);
            $('#inputBreakTime').val(item.breakTime);
            $('#inputInstock').val(item.instock);
        }

    </script>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form">
            <div class="form-group row">
                <div class="input-group">
                    <span class="input-group-addon" style="width: auto">{{trans('app.nameRu')}}</span>

                    <input type="text" class="form-control is-valid" id="inputNameRu" placeholder="{{trans('app.nameRu')}}"
                           pattern=".{1,100}" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.nameEn')}}</span>

                    <input type="text" class="form-control is-valid" id="inputNameEn" placeholder="{{trans('app.nameEn')}}"
                           pattern=".{1,100}" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.producerLabel')}}</span>

                    <input type="text" class="form-control is-valid" id="inputProducer" placeholder="{{trans('app.producerLabel')}}"
                           pattern=".{1,100}" required>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{trans('app.descriptionRu')}}</label>
                <textarea class="form-control is-valid" id="inputDescriptionRu" rows="3" maxlength="2000"
                          required></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" style="margin-right: 20px">{{trans('app.descriptionEn')}}</label>
                <textarea class="form-control is-valid" id="inputDescriptionEn" rows="3" maxlength="2000"
                          required></textarea>
            </div>

            <div class="form-group row"
                 style="margin-top: 20px;margin-bottom: 20px;">
                <span class="input-group-addon" style="width: auto">{{trans('app.productImageLabel')}}</span>

                <input type="file" class="btn btn-default" id="inputImageFile" name="file" required>
            </div>


            <div class="form-group row">
                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.ageFromLabel')}}</span>
                    <select class="form-control" style="width: 10px" id="inputAgeFrom" required>
                        @include("spinner")
                    </select>

                    <span class="input-group-addon" style="width: auto">{{trans('app.ageToLabel')}}</span>
                    <select class="form-control" style="width: 10px" id="inputAgeTo" required>
                        @include("spinner")
                    </select>
                </div>
            </div>


            <div class="form-group row" style="margin-top: 20px">
                <div class="input-group">
                    <span class="input-group-addon" style="width: auto">{{trans('app.costLabel')}}</span>
                    <input id="inputCost" type="text" class="form-control is-valid" name="msg" placeholder="0.00 {{trans('app.rub')}}"
                           pattern="\d+(\.\d{2})?" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.discountLabel')}}</span>
                    <input id="inputDiscount" type="text" class="form-control is-valid" name="msg" placeholder="0.00 %"
                           pattern="\d+(\.\d{2})?" required>
                </div>


                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">Category</span>
                    <select id="inputCategory" class="form-control is-valid" required>
                        <option value="1" selected>{{trans('app.protein')}}</option>
                        <option value="2">{{trans('app.vitamin')}}</option>
                        <option value="3">{{trans('app.tonik')}}</option>
                        <option value="4">{{trans('app.aminoacid')}}</option>
                        <option value="5">{{trans('app.gainer')}}</option>
                    </select>
                </div>


                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.portionSizeLabel')}}</span>
                    <input id="inputPortionSize" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="\d+(\.\d{2})?" required>

                    <span class="input-group-addon" style="width: auto">{{trans('app.portionTypeLabel')}}</span>
                    <select id="inputPortionType" class="form-control " required>
                        <option value="1" selected>{{trans('app.ml')}}</option>
                        <option value="2">{{trans('app.gr')}}</option>
                        <option value="3">{{trans('app.pcs')}}</option>
                    </select>


                    <span class="input-group-addon" style="width: auto">{{trans('app.portionTotalLabel')}}</span>
                    <input id="inputPortionTotal" class="form-control is-valid" placeholder="0"
                           pattern="^[0-9]+$" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon" style="width: auto">{{trans('app.maxTimeToConsumeLabel')}}</span>
                    <input id="inputMaxTime" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="^[0-9]+$" required>
                    <span class="input-group-addon" style="width: auto">{{trans('app.daysLabel')}}</span>

                    <span class="input-group-addon" style="width: auto">{{trans('app.brakeAfterConsumingLabel')}}</span>
                    <input id="inputBreakTime" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="^[0-9]+$" required>
                    <span class="input-group-addon" style="width: auto">{{trans('app.daysLabel')}}</span>
                </div>

                <div class="input-group" style="margin-top: 20px;width: 200px ">
                    <span class="input-group-addon" style="width: auto">{{trans('app.instockLabel')}}</span>
                    <input id="inputInstock" type="text" class="form-control is-valid" name="msg" placeholder="0"
                           pattern="^[0-9]+$" required>
                </div>

            </div>


            <div class="form-group row" style="margin-bottom: 20px">
                <div style="float: left; margin-bottom: 50px">
                    <p>
                        <button id="deleteBtn" type="button" class="btn btn-outline-primary">{{trans('app.deleteBtn')}}</button>
                        <button id="addBtn" type="submit" class="btn btn-outline-primary" style="margin-left: 10px">
                            {{trans('app.addBtn')}}
                        </button>

                        <button style="margin-left: 10px" id="editBtn" type="button" class="btn btn-outline-primary">
                            {{trans('app.editBtn')}}
                        </button>
                    </p>
                </div>
            </div>

        </form>
    </div>


    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>{{trans('app.idColumn')}}</th>
            <th>{{trans('app.nameLabel')}}</th>
            <th>{{trans('app.producerLabel')}}</th>
            <th>{{trans('app.categoryLabel')}}</th>
            <th>{{trans('app.costLabel')}}</th>
            <th>{{trans('app.discountLabel')}}</th>
            <th>{{trans('app.portions')}}</th>
        </tr>
        </thead>

    </table>

@endsection