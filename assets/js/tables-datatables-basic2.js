"use strict";
let fv, offCanvasEl;

  $(function () {
    var l,
      t,
      e = $(".datatables-basic"),
      a = $(".dt-complex-header"),
      s = $(".dt-row-grouping"),
      n = $(".dt-multilingual"),
      r =
        (e.length &&
          ((l = e.DataTable({
            ajax: assetsPath + "json/table-datatable.json",
            order: [[2, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
              {
                extend: "collection",
                className:
                  "btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light",
                text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                buttons: [
                  {
                    extend: "print",
                    text: '<i class="ti ti-printer me-1" ></i>Print',
                    className: "dropdown-item",
                    exportOptions: {
                      columns: [3, 4, 5, 6, 7],
                      format: {
                        body: function (e, t, a) {
                          var s;
                          return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                              (s = ""),
                              $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                  ? (s += t.lastChild.firstChild.textContent)
                                  : void 0 === t.innerText
                                  ? (s += t.textContent)
                                  : (s += t.innerText);
                              }),
                              s);
                        },
                      },
                    },
                    customize: function (e) {
                      $(e.document.body)
                        .css("color", config.colors.headingColor)
                        .css("border-color", config.colors.borderColor)
                        .css("background-color", config.colors.bodyBg),
                        $(e.document.body)
                          .find("table")
                          .addClass("compact")
                          .css("color", "inherit")
                          .css("border-color", "inherit")
                          .css("background-color", "inherit");
                    },
                  },
                  {
                    extend: "csv",
                    text: '<i class="ti ti-file-text me-1" ></i>Csv',
                    className: "dropdown-item",
                    exportOptions: {
                      columns: [3, 4, 5, 6, 7],
                      format: {
                        body: function (e, t, a) {
                          var s;
                          return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                              (s = ""),
                              $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                  ? (s += t.lastChild.firstChild.textContent)
                                  : void 0 === t.innerText
                                  ? (s += t.textContent)
                                  : (s += t.innerText);
                              }),
                              s);
                        },
                      },
                    },
                  },
                  {
                    extend: "excel",
                    text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                    className: "dropdown-item",
                    exportOptions: {
                      columns: [3, 4, 5, 6, 7],
                      format: {
                        body: function (e, t, a) {
                          var s;
                          return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                              (s = ""),
                              $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                  ? (s += t.lastChild.firstChild.textContent)
                                  : void 0 === t.innerText
                                  ? (s += t.textContent)
                                  : (s += t.innerText);
                              }),
                              s);
                        },
                      },
                    },
                  },
                  {
                    extend: "pdf",
                    text: '<i class="ti ti-file-description me-1"></i>Pdf',
                    className: "dropdown-item",
                    exportOptions: {
                      columns: [3, 4, 5, 6, 7],
                      format: {
                        body: function (e, t, a) {
                          var s;
                          return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                              (s = ""),
                              $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                  ? (s += t.lastChild.firstChild.textContent)
                                  : void 0 === t.innerText
                                  ? (s += t.textContent)
                                  : (s += t.innerText);
                              }),
                              s);
                        },
                      },
                    },
                  },
                  {
                    extend: "copy",
                    text: '<i class="ti ti-copy me-1" ></i>Copy',
                    className: "dropdown-item",
                    exportOptions: {
                      columns: [3, 4, 5, 6, 7],
                      format: {
                        body: function (e, t, a) {
                          var s;
                          return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                              (s = ""),
                              $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                  ? (s += t.lastChild.firstChild.textContent)
                                  : void 0 === t.innerText
                                  ? (s += t.textContent)
                                  : (s += t.innerText);
                              }),
                              s);
                        },
                      },
                    },
                  },
                ],
              },
             
            ],
            responsive: {
              details: {
                display: $.fn.dataTable.Responsive.display.modal({
                  header: function (e) {
                    return "Details of " + e.data().full_name;
                  },
                }),
                type: "column",
                renderer: function (e, t, a) {
                  a = $.map(a, function (e, t) {
                    return "" !== e.title
                      ? '<tr data-dt-row="' +
                          e.rowIndex +
                          '" data-dt-column="' +
                          e.columnIndex +
                          '"><td>' +
                          e.title +
                          ":</td> <td>" +
                          e.data +
                          "</td></tr>"
                      : "";
                  }).join("");
                  return !!a && $('<table class="table"/><tbody />').append(a);
                },
              },
            },
          })),
          $("div.head-label").html(
            '<h5 class="card-title mb-0">DataTable with Buttons</h5>'
          )),
        101);
    fv.on("core.form.valid", function () {
      var e = $(".add-new-record .dt-full-name").val(),
        t = $(".add-new-record .dt-post").val(),
        a = $(".add-new-record .dt-email").val(),
        s = $(".add-new-record .dt-date").val(),
        n = $(".add-new-record .dt-salary").val();
      "" != e &&
        (l.row
          .add({
            id: r,
            full_name: e,
            post: t,
            email: a,
            start_date: s,
            salary: "$" + n,
            status: 5,
          })
          .draw(),
        r++,
        offCanvasEl.hide());
    }),
      $(".datatables-basic tbody").on("click", ".delete-record", function () {
        l.row($(this).parents("tr")).remove().draw();
      }),
      a.length &&
        a.DataTable({
          ajax: assetsPath + "json/table-datatable.json",
          columns: [
            { data: "full_name" },
            { data: "email" },
            { data: "city" },
            { data: "post" },
            { data: "salary" },
            { data: "status" },
            { data: "" },
          ],
          columnDefs: [
            {
              targets: -2,
              render: function (e, t, a, s) {
                var a = a.status,
                  n = {
                    1: { title: "Current", class: "bg-label-primary" },
                    2: { title: "Professional", class: " bg-label-success" },
                    3: { title: "Rejected", class: " bg-label-danger" },
                    4: { title: "Resigned", class: " bg-label-warning" },
                    5: { title: "Applied", class: " bg-label-info" },
                  };
                return void 0 === n[a]
                  ? e
                  : '<span class="badge ' +
                      n[a].class +
                      '">' +
                      n[a].title +
                      "</span>";
              },
            },
            {
              targets: -1,
              title: "Actions",
              orderable: !1,
              render: function (e, t, a, s) {
                return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
              },
            },
          ],
          dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          displayLength: 7,
          lengthMenu: [7, 10, 25, 50, 75, 100],
        }),
      s.length &&
        ((t = s.DataTable({
          ajax: assetsPath + "json/table-datatable.json",
          columns: [
            { data: "" },
            { data: "full_name" },
            { data: "post" },
            { data: "email" },
            { data: "city" },
            { data: "start_date" },
            { data: "salary" },
            { data: "status" },
            { data: "" },
          ],
          columnDefs: [
            {
              className: "control",
              orderable: !1,
              targets: 0,
              searchable: !1,
              render: function (e, t, a, s) {
                return "";
              },
            },
            { visible: !1, targets: 2 },
            {
              targets: -2,
              render: function (e, t, a, s) {
                var a = a.status,
                  n = {
                    1: { title: "Current", class: "bg-label-primary" },
                    2: { title: "Professional", class: " bg-label-success" },
                    3: { title: "Rejected", class: " bg-label-danger" },
                    4: { title: "Resigned", class: " bg-label-warning" },
                    5: { title: "Applied", class: " bg-label-info" },
                  };
                return void 0 === n[a]
                  ? e
                  : '<span class="badge ' +
                      n[a].class +
                      '">' +
                      n[a].title +
                      "</span>";
              },
            },
            {
              targets: -1,
              title: "Actions",
              orderable: !1,
              searchable: !1,
              render: function (e, t, a, s) {
                return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
              },
            },
          ],
          order: [[2, "asc"]],
          dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          displayLength: 7,
          lengthMenu: [7, 10, 25, 50, 75, 100],
          drawCallback: function (e) {
            var t = this.api(),
              a = t.rows({ page: "current" }).nodes(),
              s = null;
            t.column(2, { page: "current" })
              .data()
              .each(function (e, t) {
                s !== e &&
                  ($(a)
                    .eq(t)
                    .before(
                      '<tr class="group"><td colspan="8">' + e + "</td></tr>"
                    ),
                  (s = e));
              });
          },
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function (e) {
                  return "Details of " + e.data().full_name;
                },
              }),
              type: "column",
              renderer: function (e, t, a) {
                a = $.map(a, function (e, t) {
                  return "" !== e.title
                    ? '<tr data-dt-row="' +
                        e.rowIndex +
                        '" data-dt-column="' +
                        e.columnIndex +
                        '"><td>' +
                        e.title +
                        ":</td> <td>" +
                        e.data +
                        "</td></tr>"
                    : "";
                }).join("");
                return !!a && $('<table class="table"/><tbody />').append(a);
              },
            },
          },
        })),
        $(".dt-row-grouping tbody").on("click", "tr.group", function () {
          var e = t.order()[0];
          (2 === e[0] && "asc" === e[1]
            ? t.order([2, "desc"])
            : t.order([2, "asc"])
          ).draw();
        }));
    n.length &&
      n.DataTable({
        ajax: assetsPath + "json/table-datatable.json",
        columns: [
          { data: "" },
          { data: "full_name" },
          { data: "post" },
          { data: "email" },
          { data: "start_date" },
          { data: "salary" },
          { data: "status" },
          { data: "" },
        ],
        columnDefs: [
          {
            className: "control",
            orderable: !1,
            targets: 0,
            searchable: !1,
            render: function (e, t, a, s) {
              return "";
            },
          },
          {
            targets: -2,
            render: function (e, t, a, s) {
              var a = a.status,
                n = {
                  1: { title: "Current", class: "bg-label-primary" },
                  2: { title: "Professional", class: " bg-label-success" },
                  3: { title: "Rejected", class: " bg-label-danger" },
                  4: { title: "Resigned", class: " bg-label-warning" },
                  5: { title: "Applied", class: " bg-label-info" },
                };
              return void 0 === n[a]
                ? e
                : '<span class="badge ' +
                    n[a].class +
                    '">' +
                    n[a].title +
                    "</span>";
            },
          },
          {
            targets: -1,
            title: "Actions",
            orderable: !1,
            searchable: !1,
            render: function (e, t, a, s) {
              return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
            },
          },
        ],
        language: {
          url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
        },
        displayLength: 7,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [7, 10, 25, 50, 75, 100],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (e) {
                return "Details of " + e.data().full_name;
              },
            }),
            type: "column",
            renderer: function (e, t, a) {
              a = $.map(a, function (e, t) {
                return "" !== e.title
                  ? '<tr data-dt-row="' +
                      e.rowIndex +
                      '" data-dt-column="' +
                      e.columnIndex +
                      '"><td>' +
                      e.title +
                      ":</td> <td>" +
                      e.data +
                      "</td></tr>"
                  : "";
              }).join("");
              return !!a && $('<table class="table"/><tbody />').append(a);
            },
          },
        },
      }),
      setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm"),
          $(".dataTables_length .form-select").removeClass("form-select-sm");
      }, 300);
  });
