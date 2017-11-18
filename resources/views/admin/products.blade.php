@extends("admin.frame")

@section("title", "Products")

@section("content")
    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Short</th>
            <th>Full</th>
            <th>Date</th>
            <th>Type</th>
        </tr>
        </thead>

    </table>

    <script>
        var table;
        $(function () {
            table = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/articleList'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'short', name: 'short'},
                    {data: 'full', name: 'full'},
                    {data: 'date', name: 'date'},
                    {data: 'type', name: 'type'}
                ]
            });
        });

        $(document).ready(function () {
            $('#articles-table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $("#deleteBtn").click(function () {
                    $.ajax({
                        url: '/admin/deletearticle/' + $('#articles-table').DataTable().row('.selected').id,
                        type: 'GET',
                        success: function (result) {

                        }
                    });
                    $('#articles-table').DataTable().row('.selected').remove().draw();
                }
            );
        });
    </script>

@endsection