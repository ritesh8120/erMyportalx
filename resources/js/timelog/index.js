let timeLog = {
    init:function()
    {
        timeLog.timelogList();
    },

    timelogList:function(){
        let timelogList = $('#timelogList');
        let urlLink = timelogList.data('url');
        timelogList.DataTable({
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
                    d.page = parseInt(timelogList.DataTable().page.info().page) + 1;
                    d.search = timelogList.DataTable().search();
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
                        "data": "employee",
                        "name": "employee",
                        "targets": "employee",
                    },
                    {
                        "data": "task",
                        "name": "task",
                        "targets": "task",
                    },
                    {
                        "data": "description",
                        "name": "description",
                        "targets": "description",
                    },
                    {
                        "data": "working_hours",
                        "name": "working_hours",
                        "targets": "working_hours",
                    },
                    {
                        "data": "date",
                        "name": "date",
                        "targets": "date",
                    },
                ]
        });
    }
};

$(function(){
    timeLog.init();
});