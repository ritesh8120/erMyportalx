let employee = {
    init:function(){
        employee.employeeList();
    },
    employeeList:function(){
        let employeeList = $('#employeeList');
        let urlLink = employeeList.data('url');
        employeeList.DataTable({
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "responsive": {
                "details": false 
            }, 
            "ajax": {
                url: urlLink,
                type: 'GET',
                data: function (d) {
                    d.size = d.length;
                    d.sortColumn = d.columns[d.order[0]['column']]['name'];
                    d.sortDirection = d.order[0]['dir'];
                    d.page = parseInt(employeeList.DataTable().page.info().page) + 1;
                    d.search = employeeList.DataTable().search();
                },
                dataSrc: function (d) {
                    d.recordsTotal = d.meta.total;
                    d.recordsFiltered = d.meta.total;
                    return d.data;

                },
            },
            "order": [0, "desc"],
            "columnDefs":
                [
                    {
                        "data": 'id',
                        "name": "id",
                        "targets": 'id',
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // adds id to serial no
                        },
                    },
                    {
                        "data": "name",
                        "name": "name",
                        "targets": "name",
                    },
                    {
                        "data": "email",
                        "name": "email",
                        "targets": "email",
                    },
                    {
                        "data": 'id',
                        "name": 'actions',
                        "targets": 'actions',
                        'orderable': false,
                        'class': 'dtr-hidden text-center',
                        "render": function(data, type, full, meta) {           
                            var action = `<button type="button" class="btn btn-success">UPDATE</button>
                            <button type="button" class="btn btn-danger">DELETE</button>`;
                            return action;
                        }
                    }
                ]
        });
    }
};

$(function(){
    employee.init();
});