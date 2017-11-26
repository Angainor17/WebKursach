@extends("admin.frame")

@section("title", "Products")

@section("content")

    <script>
        $(document).ready(function () {
            doOnStart();
        });

        function doOnStart() {
            loadDropDown();
        }

        function loadDropDown() {
            var dropDownFrom = $('#ageFromSelect');
            var dropDownTo = $('#ageToSelect');

            for (var i = 1; i <= 100; i++) {
                var newOption = document.createElement('option');
                newOption.value = i;
                newOption.innerHTML = "" + i;
//                newOption.Text = i;
//                newOption.value = i;
                dropDownFrom.innerHTML += '<option value=0>i</option>';
                dropDownTo.appendChild(newOption);
            }
        }
    </script>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name Ru</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNameRu" placeholder="Name Ru">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name En</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNameEn" placeholder="Name En">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description Ru</label>
                <textarea class="form-control" id="inputDescriptionRu" rows="3"></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description En</label>
                <textarea class="form-control" id="inputDescriptionEn" rows="3"></textarea>
            </div>


            <label>Product image file input</label>
            <input type="file" class="form-control-file" id="inputImageFile">

            <div class="col-sm-2 ">
                <label class="col-sm-2 " style="float: left">Age From</label>
                <select class="form-control" style="margin-bottom: 20px;width: 100px" id="ageFromSelect">
                    @include("spinner")
                </select>
                <label class="col-sm-2 " style="float: left">Age To</label>
                <select class="form-control" style="margin-bottom: 90px;width: 100px" id="ageToSelect">
                    @include("spinner")
                </select>
            </div>

            <div class="form-group row" style="margin-bottom: 20px">
                <div style="float: left; margin-bottom: 50px">
                    <p>
                        <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>

                        <button style="margin-left: 30px" id="addEditBtn" type="button"
                                class="btn btn-outline-primary">Add/Edit
                        </button>
                    </p>
                </div>
            </div>

        </form>
    </div>


    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Type</th>
        </tr>
        </thead>

    </table>
    <script>
        $(function () {
            table = $('#articles-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: '/admin/article/list'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'short', name: 'short'},
                    {data: 'full', name: 'full'},
                    {data: 'date', name: 'date'},
                    {data: 'type', name: 'type'},
                ]
            });
        });
    </script>

@endsection