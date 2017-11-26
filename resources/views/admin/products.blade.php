@extends("admin.frame")

@section("title", "Products")

@section("content")

    <script>
        $(document).ready(function () {
            doOnStart();
        });

        function doOnStart() {
            $("#form").submit(function (event) {
                event.preventDefault();
                addProductEvent();
                return false;
            });

        }

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
                    cleanAllFields();
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/product/add",
                type: "POST",
                data: jsonBody,
                dataType: "json",
                success: function (result) {
                    cleanAllFields();
                    refreshTable();
                }
            });

            function refreshTable() {
                $('#products-table').DataTable().ajax.reload();
            }

            function cleanAllProductsFields() {
                $('#inputTitleRu').val("");
            }

        }

    </script>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form">
            <div class="form-group row">
                <div class="input-group">
                    <span class="input-group-addon">Name Ru</span>

                    <input type="text" class="form-control is-valid" id="inputNameRu" placeholder="Name Ru"
                           pattern=".{1,100}" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Name En</span>

                    <input type="text" class="form-control is-valid" id="inputNameEn" placeholder="Name En"
                           pattern=".{1,100}" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Producer</span>

                    <input type="text" class="form-control is-valid" id="inputProducer" placeholder="Producer"
                           pattern=".{1,100}" required>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description Ru</label>
                <textarea class="form-control is-valid" id="inputDescriptionRu" rows="3" maxlength="1000"
                          required></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" style="margin-right: 20px">Description En</label>
                <textarea class="form-control is-valid" id="inputDescriptionEn" rows="3" maxlength="1000"
                          required></textarea>
            </div>

            <div class="form-group row"
                 style="margin-top: 20px;margin-bottom: 20px;">
                <span class="input-group-addon">Product image file: </span>

                <input type="file" class="btn btn-default" id="inputImageFile" required>
            </div>


            <div class="form-group row">
                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Age Range From</span>
                    <select class="form-control" style="width: 10px" id="inputAgeFrom" required>
                        @include("spinner")
                    </select>

                    <span class="input-group-addon">to</span>
                    <select class="form-control" style="width: 10px" id="inputAgeTo" required>
                        @include("spinner")
                    </select>
                </div>
            </div>


            <div class="form-group row" style="margin-top: 20px">
                <div class="input-group">
                    <span class="input-group-addon">Cost</span>
                    <input id="inputCost" type="text" class="form-control is-valid" name="msg" placeholder="0.00 RUB"
                           pattern="\d+(\.\d{2})?" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Discount</span>
                    <input id="inputDiscount" type="text" class="form-control is-valid" name="msg" placeholder="0.00 %"
                           pattern="\d+(\.\d{2})?" required>
                </div>


                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Category</span>
                    <select id="inputCategory" class="form-control is-valid" required>
                        <option value="1" selected>Protein</option>
                        <option value="2">Vitamin</option>
                        <option value="3">Tonik</option>
                    </select>
                </div>


                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Portion Size</span>
                    <input id="inputPortionSize" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="\d+(\.\d{2})?" required>

                    <span class="input-group-addon">Portion Type</span>
                    <select id="inputPortionType" class="form-control " required>
                        <option value="1" selected>ML</option>
                        <option value="2">GR</option>
                        <option value="3">PCs</option>
                    </select>


                    <span class="input-group-addon">Portions Total</span>
                    <input id="inputPortionTotal" class="form-control is-valid" placeholder="0"
                           pattern="^[0-9]+$" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Max time to consume</span>
                    <input id="inputMaxTime" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="^[0-9]+$" required>
                    <span class="input-group-addon">days</span>

                    <span class="input-group-addon">Brake after consuming</span>
                    <input id="inputBreakTime" type="text" class="form-control is-valid" style="width: 100px"
                           placeholder="0"
                           pattern="^[0-9]+$" required>
                    <span class="input-group-addon">days</span>
                </div>

                <div class="input-group" style="margin-top: 20px;width: 200px ">
                    <span class="input-group-addon">Instock</span>
                    <input id="inputInstock" type="text" class="form-control is-valid" name="msg" placeholder="0"
                           pattern="^[0-9]+$" required>
                </div>

            </div>


            <div class="form-group row" style="margin-bottom: 20px">
                <div style="float: left; margin-bottom: 50px">
                    <p>
                        <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>
                        <button id="addBtn" type="submit" class="btn btn-outline-primary" style="margin-left: 10px">
                            Add
                        </button>

                        <button style="margin-left: 10px" id="addEditBtn" type="button" class="btn btn-outline-primary">
                            Edit
                        </button>
                    </p>
                </div>
            </div>

        </form>
    </div>


    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Producer</th>
            <th>Category</th>
            <th>Cost</th>
            <th>Discount</th>
            <th>Portions</th>
        </tr>
        </thead>

    </table>
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


    </script>

@endsection