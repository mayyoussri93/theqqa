($.fn.toggleAttr = function (e, a, t) {
    return this.each(function () {
        var l = $(this);
        l.attr(e) == a ? l.attr(e, t) : l.attr(e, a);
    });
}),
    (function ($) {
        "use strict";
        (AIZ.data = { csrf: $('meta[name="csrf-token"]').attr("content"), appUrl: $('meta[name="app-url"]').attr("content"), fileBaseUrl: $('meta[name="file-base-url"]').attr("content") + "public/" }),
            (AIZ.uploader = {
                data: { selectedFiles: [], selectedFilesObject: [], clickedForDelete: null, allFiles: [], multiple: !1, type: "all", next_page_url: null, prev_page_url: null },
                removeInputValue: function (e, a, t) {
                    var l = a.filter(function (a) {
                        return a !== e;
                    });
                    l.length > 0 ? $(t).find(".file-amount").html(AIZ.uploader.updateFileHtml(l)) : t.find(".file-amount").html(AIZ.local.choose_file), $(t).find(".selected-files").val(l);
                },
                removeAttachment: function () {
                    $(document).on("click", ".remove-attachment", function () {
                        var e = $(this).closest(".file-preview-item").data("id"),
                            a = $(this).closest(".file-preview").prev('[data-toggle="aizuploader"]').find(".selected-files").val().split(",").map(Number);
                        AIZ.uploader.removeInputValue(e, a, $(this).closest(".file-preview").prev('[data-toggle="aizuploader"]')), $(this).closest(".file-preview-item").remove();
                    });
                },
                deleteUploaderFile: function () {
                    $(".aiz-uploader-delete").each(function () {
                        $(this).on("click", function (e) {
                            e.preventDefault();
                            var a = $(this).data("id");
                            (AIZ.uploader.data.clickedForDelete = a),
                                $("#aizUploaderDelete").modal("show"),
                                $(".aiz-uploader-confirmed-delete").on("click", function (e) {
                                    if ((e.preventDefault(), 1 === e.detail)) {
                                        var a = AIZ.uploader.data.allFiles[AIZ.uploader.data.allFiles.findIndex((e) => e.id === AIZ.uploader.data.clickedForDelete)];
                                        $.ajax({
                                            url: AIZ.data.appUrl + "/aiz-uploader/destroy/" + AIZ.uploader.data.clickedForDelete,
                                            type: "DELETE",
                                            dataType: "JSON",
                                            data: { id: AIZ.uploader.data.clickedForDelete, _method: "DELETE", _token: AIZ.data.csrf },
                                            success: function () {
                                                (AIZ.uploader.data.selectedFiles = AIZ.uploader.data.selectedFiles.filter(function (e) {
                                                    return e !== AIZ.uploader.data.clickedForDelete;
                                                })),
                                                    (AIZ.uploader.data.selectedFilesObject = AIZ.uploader.data.selectedFilesObject.filter(function (e) {
                                                        return e !== a;
                                                    })),
                                                    AIZ.uploader.updateUploaderSelected(),
                                                    AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files"),
                                                    (AIZ.uploader.data.clickedForDelete = null),
                                                    $("#aizUploaderDelete").modal("hide");
                                            },
                                        });
                                    }
                                });
                        });
                    });
                },
                uploadSelect: function () {
                    $(".aiz-uploader-select").each(function () {
                        var e = $(this);
                        e.on("click", function (a) {
                            var t = $(this).data("value"),
                                l = AIZ.uploader.data.allFiles[AIZ.uploader.data.allFiles.findIndex((e) => e.id === t)];
                            e.closest(".aiz-file-box-wrap").toggleAttr("data-selected", "true", "false"),
                            AIZ.uploader.data.multiple || e.closest(".aiz-file-box-wrap").siblings().attr("data-selected", "false"),
                                AIZ.uploader.data.selectedFiles.includes(t)
                                    ? ((AIZ.uploader.data.selectedFiles = AIZ.uploader.data.selectedFiles.filter(function (e) {
                                        return e !== t;
                                    })),
                                        (AIZ.uploader.data.selectedFilesObject = AIZ.uploader.data.selectedFilesObject.filter(function (e) {
                                            return e !== l;
                                        })))
                                    : (AIZ.uploader.data.multiple || ((AIZ.uploader.data.selectedFiles = []), (AIZ.uploader.data.selectedFilesObject = [])),
                                        AIZ.uploader.data.selectedFiles.push(t),
                                        AIZ.uploader.data.selectedFilesObject.push(l)),
                                AIZ.uploader.addSelectedValue(),
                                AIZ.uploader.updateUploaderSelected();
                        });
                    });
                },
                updateFileHtml: function (e) {
                    var a = "";
                    if (e.length > 1) a = AIZ.local.files_selected;
                    else a = AIZ.local.file_selected;
                    return e.length + " " + a;
                },
                updateUploaderSelected: function () {
                    $(".aiz-uploader-selected").html(AIZ.uploader.updateFileHtml(AIZ.uploader.data.selectedFiles));
                },
                clearUploaderSelected: function () {
                    $(".aiz-uploader-selected-clear").on("click", function () {
                        (AIZ.uploader.data.selectedFiles = []), AIZ.uploader.addSelectedValue(), AIZ.uploader.addHiddenValue(), AIZ.uploader.resetFilter(), AIZ.uploader.updateUploaderSelected(), AIZ.uploader.updateUploaderFiles();
                    });
                },
                resetFilter: function () {
                    $('[name="aiz-uploader-search"]').val(""), $('[name="aiz-show-selected"]').prop("checked", !1), $('[name="aiz-uploader-sort"] option[value=newest]').prop("selected", !0);
                },
                getAllUploads: function (e, a = null, t = null) {
                    $(".aiz-uploader-all").html('<div class="align-items-center d-flex h-100 justify-content-center w-100"><div class="spinner-border" role="status"></div></div>');
                    var l = {};
                    null != a && a.length > 0 && (l.search = a),
                        null != t && t.length > 0 ? (l.sort = t) : (l.sort = "newest"),
                        $.get(e, l, function (e, a) {
                            "string" == typeof e && (e = JSON.parse(e)),
                                (AIZ.uploader.data.allFiles = e.data),
                                AIZ.uploader.allowedFileType(),
                                AIZ.uploader.addSelectedValue(),
                                AIZ.uploader.addHiddenValue(),
                                AIZ.uploader.updateUploaderFiles(),
                                null != e.next_page_url ? ((AIZ.uploader.data.next_page_url = e.next_page_url), $("#uploader_next_btn").removeAttr("disabled")) : $("#uploader_next_btn").attr("disabled", !0),
                                null != e.prev_page_url ? ((AIZ.uploader.data.prev_page_url = e.prev_page_url), $("#uploader_prev_btn").removeAttr("disabled")) : $("#uploader_prev_btn").attr("disabled", !0);
                        });
                },
                showSelectedFiles: function () {
                    $('[name="aiz-show-selected"]').on("change", function () {
                        $(this).is(":checked") ? (AIZ.uploader.data.allFiles = AIZ.uploader.data.selectedFilesObject) : AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files"), AIZ.uploader.updateUploaderFiles();
                    });
                },
                searchUploaderFiles: function () {
                    $('[name="aiz-uploader-search"]').on("keyup", function () {
                        var e = $(this).val();
                        AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files", e, $('[name="aiz-uploader-sort"]').val());
                    });
                },
                sortUploaderFiles: function () {
                    $('[name="aiz-uploader-sort"]').on("change", function () {
                        var e = $(this).val();
                        AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files", $('[name="aiz-uploader-search"]').val(), e);
                    });
                },
                addSelectedValue: function () {
                    for (var e = 0; e < AIZ.uploader.data.allFiles.length; e++)
                        AIZ.uploader.data.selectedFiles.includes(AIZ.uploader.data.allFiles[e].id) ? (AIZ.uploader.data.allFiles[e].selected = !0) : (AIZ.uploader.data.allFiles[e].selected = !1);
                },
                addHiddenValue: function () {
                    for (var e = 0; e < AIZ.uploader.data.allFiles.length; e++) AIZ.uploader.data.allFiles[e].aria_hidden = !1;
                },
                allowedFileType: function () {
                    "all" !== AIZ.uploader.data.type &&
                    (AIZ.uploader.data.allFiles = AIZ.uploader.data.allFiles.filter(function (e) {
                        return e.type === AIZ.uploader.data.type;
                    }));
                },
                updateUploaderFiles: function () {
                    $(".aiz-uploader-all").html('<div class="align-items-center d-flex h-100 justify-content-center w-100"><div class="spinner-border" role="status"></div></div>');
                    var e = AIZ.uploader.data.allFiles;
                    setTimeout(function () {
                        if (($(".aiz-uploader-all").html(null), e.length > 0))
                            for (var a = 0; a < e.length; a++) {
                                var t = "";
                                t = "image" === e[a].type ? '<img src="' + AIZ.data.fileBaseUrl + e[a].file_name + '" class="img-fit">' : '<i class="la la-file-text"></i>';
                                var l =
                                    '<div class="aiz-file-box-wrap" aria-hidden="' +
                                    e[a].aria_hidden +
                                    '" data-selected="' +
                                    e[a].selected +
                                    '"><div class="aiz-file-box"><div class="card card-file aiz-uploader-select" title="' +
                                    e[a].file_original_name +
                                    "." +
                                    e[a].extension +
                                    '" data-value="' +
                                    e[a].id +
                                    '"><div class="card-file-thumb">' +
                                    t +
                                    '</div><div class="card-body"><h6 class="d-flex"><span class="text-truncate title">' +
                                    e[a].file_original_name +
                                    '</span><span class="ext flex-shrink-0">.' +
                                    e[a].extension +
                                    "</span></h6><p>" +
                                    AIZ.extra.bytesToSize(e[a].file_size) +
                                    "</p></div></div></div></div>";
                                $(".aiz-uploader-all").append(l);
                            }
                        else $(".aiz-uploader-all").html('<div class="align-items-center d-flex h-100 justify-content-center w-100 nav-tabs"><div class="text-center"><h3>No files found</h3></div></div>');
                        AIZ.uploader.uploadSelect(), AIZ.uploader.deleteUploaderFile();
                    }, 300);
                },
                inputSelectPreviewGenerate: function (e) {
                    e.find(".selected-files").val(AIZ.uploader.data.selectedFiles),
                        e.next(".file-preview").html(null),
                        AIZ.uploader.data.selectedFiles.length > 0
                            ? $.post(AIZ.data.appUrl + "/aiz-uploader/get_file_by_ids", { _token: AIZ.data.csrf, ids: AIZ.uploader.data.selectedFiles.toString() }, function (a) {
                                if ((e.next(".file-preview").html(null), a.length > 0)) {
                                    e.find(".file-amount").html(AIZ.uploader.updateFileHtml(a));
                                    for (var t = 0; t < a.length; t++) {
                                        var l = "";
                                        l = "image" === a[t].type ? '<img src="' + AIZ.data.fileBaseUrl + a[t].file_name + '" class="img-fit">' : '<i class="la la-file-text"></i>';
                                        var i =
                                            '<div class="d-flex justify-content-between align-items-center mt-2 file-preview-item" data-id="' +
                                            a[t].id +
                                            '" title="' +
                                            a[t].file_original_name +
                                            "." +
                                            a[t].extension +
                                            '"><div class="align-items-center align-self-stretch d-flex justify-content-center thumb">' +
                                            l +
                                            '</div><div class="col body"><h6 class="d-flex"><span class="text-truncate title">' +
                                            a[t].file_original_name +
                                            '</span><span class="flex-shrink-0 ext">.' +
                                            a[t].extension +
                                            "</span></h6><p>" +
                                            AIZ.extra.bytesToSize(a[t].file_size) +
                                            '</p></div><div class="remove"><button class="btn-close btn-sm btn-link remove-attachment" type="button"><i class="la la-close"></i></button></div></div>';
                                        e.next(".file-preview").append(i);
                                    }
                                } else e.find(".file-amount").html(AIZ.local.choose_file);
                            })
                            : e.find(".file-amount").html(AIZ.local.choose_file);
                },
                editorImageGenerate: function (e) {
                    if (AIZ.uploader.data.selectedFiles.length > 0)
                        for (var a = 0; a < AIZ.uploader.data.selectedFiles.length; a++) {
                            var t = AIZ.uploader.data.allFiles.findIndex((e) => e.id === AIZ.uploader.data.selectedFiles[a]),
                                l = "";
                            "image" === AIZ.uploader.data.allFiles[t].type && ((l = '<img src="' + AIZ.data.fileBaseUrl + AIZ.uploader.data.allFiles[t].file_name + '">'), e[0].insertHTML(l));
                        }
                },
                dismissUploader: function () {
                    $("#aizUploaderModal").on("hidden.bs.modal", function () {
                        $(".aiz-uploader-backdrop").remove(), $("#aizUploaderModal").remove();
                    });
                },
                trigger: function (e = null, a = "", t = "all", l = "", i = !1, o = null) {
                    (e = $(e)), (i = i), (t = t);
                    var n = l;
                    (AIZ.uploader.data.selectedFiles = "" !== n ? n.split(",").map(Number) : []),
                    void 0 !== t && t.length > 0 && (AIZ.uploader.data.type = t),
                    i && (AIZ.uploader.data.multiple = i),
                        $.post(AIZ.data.appUrl + "/aiz-uploader", { _token: AIZ.data.csrf }, function (t) {
                            $("body").append(t),
                                $("#aizUploaderModal").modal("show"),
                                AIZ.plugins.aizUppy(),
                                AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files", null, $('[name="aiz-uploader-sort"]').val()),
                                AIZ.uploader.updateUploaderSelected(),
                                AIZ.uploader.clearUploaderSelected(),
                                AIZ.uploader.sortUploaderFiles(),
                                AIZ.uploader.searchUploaderFiles(),
                                AIZ.uploader.showSelectedFiles(),
                                AIZ.uploader.dismissUploader(),
                                $("#uploader_next_btn").on("click", function () {
                                    null != AIZ.uploader.data.next_page_url && ($('[name="aiz-show-selected"]').prop("checked", !1), AIZ.uploader.getAllUploads(AIZ.uploader.data.next_page_url));
                                }),
                                $("#uploader_prev_btn").on("click", function () {
                                    null != AIZ.uploader.data.prev_page_url && ($('[name="aiz-show-selected"]').prop("checked", !1), AIZ.uploader.getAllUploads(AIZ.uploader.data.prev_page_url));
                                }),
                                $(".aiz-uploader-search i").on("click", function () {
                                    $(this).parent().toggleClass("open");
                                }),
                                $('[data-toggle="aizUploaderAddSelected"]').on("click", function () {
                                    "input" === a ? AIZ.uploader.inputSelectPreviewGenerate(e) : "direct" === a && o(AIZ.uploader.data.selectedFiles), $("#aizUploaderModal").modal("hide");
                                });
                        });
                },
                initForInput: function () {
                    $(document).on("click", '[data-toggle="aizuploader"]', function (e) {
                        if (1 === e.detail) {
                            var a = $(this),
                                t = a.data("multiple"),
                                l = a.data("type"),
                                i = a.find(".selected-files").val();
                            (t = t || ""), (l = l || ""), (i = i || ""), AIZ.uploader.trigger(this, "input", l, i, t);
                        }
                    });
                },
                previewGenerate: function () {
                    $('[data-toggle="aizuploader"]').each(function () {
                        var e = $(this),
                            a = e.find(".selected-files").val();
                        "" != a &&
                        $.post(AIZ.data.appUrl + "/aiz-uploader/get_file_by_ids", { _token: AIZ.data.csrf, ids: a }, function (a) {
                            if ((e.next(".file-preview").html(null), a.length > 0)) {
                                e.find(".file-amount").html(AIZ.uploader.updateFileHtml(a));
                                for (var t = 0; t < a.length; t++) {
                                    var l = "";
                                    l = "image" === a[t].type ? '<img src="' + AIZ.data.fileBaseUrl + a[t].file_name + '" class="img-fit">' : '<i class="la la-file-text"></i>';
                                    var i =
                                        '<div class="d-flex justify-content-between align-items-center mt-2 file-preview-item" data-id="' +
                                        a[t].id +
                                        '" title="' +
                                        a[t].file_original_name +
                                        "." +
                                        a[t].extension +
                                        '"><div class="align-items-center align-self-stretch d-flex justify-content-center thumb">' +
                                        l +
                                        '</div><div class="col body"><h6 class="d-flex"><span class="text-truncate title">' +
                                        a[t].file_original_name +
                                        '</span><span class="ext flex-shrink-0">.' +
                                        a[t].extension +
                                        "</span></h6><p>" +
                                        AIZ.extra.bytesToSize(a[t].file_size) +
                                        '</p></div><div class="remove"><button class="btn-close btn-sm btn-link remove-attachment" type="button"><i class="la la-close"></i></button></div></div>';
                                    e.next(".file-preview").append(i);
                                }
                            } else e.find(".file-amount").html(AIZ.local.choose_file);
                        });
                    });
                },
            }),
            (AIZ.plugins = {
                metismenu: function () {
                    $('[data-toggle="aiz-side-menu"]').metisMenu();
                },
                bootstrapSelect: function (e = "") {
                    $(".aiz-selectpicker").each(function (a) {
                        var t = $(this);
                        if (!t.parent().hasClass("bootstrap-select")) {
                            var l = t.data("selected");
                            void 0 !== l && t.val(l), t.selectpicker({ size: 5, noneSelectedText: AIZ.local.nothing_selected, virtualScroll: !1 });
                        }
                        "refresh" === e && t.selectpicker("refresh"), "destroy" === e && t.selectpicker("destroy");
                    });
                },
                tagify: function () {
                    $(".aiz-tag-input")
                        .not(".tagify")
                        .each(function () {
                            var $this = $(this),
                                maxTags = $this.data("max-tags"),
                                whitelist = $this.data("whitelist"),
                                onchange = $this.data("on-change");
                            (maxTags = maxTags || 1 / 0), (whitelist = whitelist || []), $this.tagify({ maxTags: maxTags, whitelist: whitelist, dropdown: { enabled: 1 } });
                            try {
                                callback = eval(onchange);
                            } catch (e) {
                                var callback = "";
                            }
                            "function" == typeof callback &&
                            ($this.on("removeTag", function () {
                                callback();
                            }),
                                $this.on("add", function () {
                                    callback();
                                }));
                        });
                },
                textEditor: function () {
                    $(".aiz-text-editor").each(function (e) {
                        var a = $(this),
                            t = a.data("buttons"),
                            l = a.data("min-height"),
                            i = a.attr("placeholder"),
                            o = a.data("format");
                        (t = t || [
                            ["font", ["bold", "underline", "italic", "clear"]],
                            ["para", ["ul", "ol", "paragraph"]],
                            ["style", ["style"]],
                            ["color", ["color"]],
                            ["table", ["table"]],
                            ["insert", ["link", "picture", "video"]],
                            ["view", ["fullscreen", "undo", "redo"]],
                        ]),
                            (i = i || ""),
                            (l = l || 200),
                            (o = void 0 !== o && o),
                            a.summernote({
                                toolbar: t,
                                placeholder: i,
                                height: l,
                                callbacks: {
                                    onImageUpload: function (e) {
                                        e.pop();
                                    },
                                    onPaste: function (e) {
                                        if (!o) {
                                            var a = ((e.originalEvent || e).clipboardData || window.clipboardData).getData("Text");
                                            e.preventDefault(), document.execCommand("insertText", !1, a);
                                        }
                                    },
                                },
                            });
                        var n = a.summernote("module", "videoDialog").createVideoNode;
                        a.summernote("module", "videoDialog").createVideoNode = function (e) {
                            var a = $('<div class="embed-responsive embed-responsive-16by9"></div>'),
                                t = n(e);
                            return (t = $(t).addClass("embed-responsive-item")), a.append(t)[0];
                        };
                    });
                },
                dateRange: function () {
                    $(".aiz-date-range").each(function () {
                        var e = $(this),
                            a = moment().startOf("day"),
                            t = (e.val(), !1),
                            l = !1,
                            i = {
                                Today: [moment(), moment()],
                                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                                "This Month": [moment().startOf("month"), moment().endOf("month")],
                                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                            },
                            o = e.data("single"),
                            n = e.data("show-dropdown"),
                            s = e.data("format"),
                            d = e.data("separator"),
                            r = e.data("past-disable"),
                            c = e.data("future-disable"),
                            u = e.data("time-picker"),
                            p = e.data("time-gap"),
                            m = e.data("advanced-range");
                        (o = o || !1),
                            (n = n || !1),
                            (s = s || "YYYY-MM-DD"),
                            (d = d || " / "),
                            (t = r ? a : t),
                            (l = c ? a : l),
                            (u = u || !1),
                            (p = p || 1),
                            (i = m ? i : ""),
                            e.daterangepicker({
                                singleDatePicker: o,
                                showDropdowns: n,
                                minDate: t,
                                maxDate: l,
                                timePickerIncrement: p,
                                autoUpdateInput: !1,
                                ranges: i,
                                locale: { format: s, separator: d, applyLabel: "Select", cancelLabel: "Clear" },
                            }),
                            o
                                ? e.on("apply.daterangepicker", function (a, t) {
                                    e.val(t.startDate.format(s));
                                })
                                : e.on("apply.daterangepicker", function (a, t) {
                                    e.val(t.startDate.format(s) + d + t.endDate.format(s));
                                }),
                            e.on("cancel.daterangepicker", function (a, t) {
                                e.val("");
                            });
                    });
                },
                timePicker: function () {
                    $(".aiz-time-picker").each(function () {
                        var e = $(this),
                            a = e.data("minute-step"),
                            t = e.data("default");
                        (a = a || 10), (t = t || "00:00"), e.timepicker({ template: "dropdown", minuteStep: a, defaultTime: t, icons: { up: "las la-angle-up", down: "las la-angle-down" }, showInputs: !1 });
                    });
                },
                fooTable: function () {
                    $(".aiz-table").each(function () {
                        var e = $(this),
                            a = e.data("empty");
                        (a = a || AIZ.local.nothing_found),
                            e.footable({
                                breakpoints: { xs: 576, sm: 768, md: 992, lg: 1200, xl: 1400 },
                                cascade: !0,
                                on: {
                                    "ready.ft.table": function (e, a) {
                                        AIZ.extra.deleteConfirm(), AIZ.plugins.bootstrapSelect("refresh");
                                    },
                                },
                                empty: a,
                            });
                    });
                },
                notify: function (e = "dark", a = "") {
                    $.notify(
                        { message: a },
                        {
                            showProgressbar: !0,
                            delay: 2500,
                            mouse_over: "pause",
                            placement: { from: "bottom", align: "left" },
                            animate: { enter: "animated fadeInUp", exit: "animated fadeOutDown" },
                            type: e,
                            template:
                                '<div data-notify="container" class="aiz-notify alert alert-{0}" style="width: 200px" role="alert"><button type="button" aria-hidden="true" data-notify="dismiss" class="btn-close close"><i class="las la-times"></i></button><span data-notify="message">{2}</span></div>',
                        }
                    );
                },
                aizUppy: function () {
                    if ($("#aiz-upload-files").length > 0) {
                        var e = Uppy.Core({ autoProceed: !0 });
                        e.use(Uppy.Dashboard, {
                            target: "#aiz-upload-files",
                            inline: !0,
                            showLinkToFileUploadResult: !1,
                            showProgressDetails: !0,
                            hideCancelButton: !0,
                            hidePauseResumeButton: !0,
                            hideUploadButton: !0,
                            proudlyDisplayPoweredByUppy: !1,
                            locale: {
                                strings: {
                                    addMoreFiles: AIZ.local.add_more_files,
                                    addingMoreFiles: AIZ.local.adding_more_files,
                                    dropPaste: AIZ.local.drop_files_here_paste_or + " %{browse}",
                                    browse: AIZ.local.browse,
                                    uploadComplete: AIZ.local.upload_complete,
                                    uploadPaused: AIZ.local.upload_paused,
                                    resumeUpload: AIZ.local.resume_upload,
                                    pauseUpload: AIZ.local.pause_upload,
                                    retryUpload: AIZ.local.retry_upload,
                                    cancelUpload: AIZ.local.cancel_upload,
                                    xFilesSelected: { 0: "%{smart_count} " + AIZ.local.file_selected, 1: "%{smart_count} " + AIZ.local.files_selected },
                                    uploadingXFiles: { 0: AIZ.local.uploading + " %{smart_count} " + AIZ.local.file, 1: AIZ.local.uploading + " %{smart_count} " + AIZ.local.files },
                                    processingXFiles: { 0: AIZ.local.processing + " %{smart_count} " + AIZ.local.file, 1: AIZ.local.processing + " %{smart_count} " + AIZ.local.files },
                                    uploading: AIZ.local.uploading,
                                    complete: AIZ.local.complete,
                                },
                            },
                        }),
                            e.use(Uppy.XHRUpload, { endpoint: AIZ.data.appUrl + "/aiz-uploader/upload", fieldName: "aiz_file", formData: !0, headers: { "X-CSRF-TOKEN": AIZ.data.csrf } }),
                            e.on("upload-success", function () {
                                AIZ.uploader.getAllUploads(AIZ.data.appUrl + "/aiz-uploader/get_uploaded_files");
                            });
                    }
                },
                tooltip: function () {
                    $("body")
                        .tooltip({ selector: '[data-toggle="tooltip"]' })
                        .click(function () {
                            $('[data-toggle="tooltip"]').tooltip("hide");
                        });
                },
                countDown: function () {
                    $(".aiz-count-down").length > 0 &&
                    $(".aiz-count-down").each(function () {
                        var e = $(this),
                            a = e.data("date");
                        e.countdown(a).on("update.countdown", function (e) {
                            $(this).html(
                                e.strftime(
                                    '<div class="countdown-item"><span class="countdown-digit">%-D</span></div><span class="countdown-separator">:</span><div class="countdown-item"><span class="countdown-digit">%H</span></div><span class="countdown-separator">:</span><div class="countdown-item"><span class="countdown-digit">%M</span></div><span class="countdown-separator">:</span><div class="countdown-item"><span class="countdown-digit">%S</span></div>'
                                )
                            );
                        });
                    });
                },
                slickCarousel: function () {
                    $(".aiz-carousel")
                        .not(".slick-initialized")
                        .each(function () {
                            var e = $(this),
                                a = !1,
                                t = e.data("xs-items"),
                                l = e.data("sm-items"),
                                i = e.data("md-items"),
                                o = e.data("lg-items"),
                                n = e.data("xl-items"),
                                s = e.data("items"),
                                d = e.data("center"),
                                r = e.data("arrows"),
                                c = e.data("dots"),
                                u = e.data("rows"),
                                p = e.data("autoplay"),
                                m = e.data("fade"),
                                f = e.data("nav-for"),
                                h = e.data("infinite"),
                                v = e.data("focus-select"),
                                g = e.data("auto-height"),
                                I = e.data("vertical"),
                                A = e.data("vertical-xs"),
                                Z = e.data("vertical-sm"),
                                b = e.data("vertical-md"),
                                x = e.data("vertical-lg"),
                                y = e.data("vertical-xl");
                            (s = s || 1),
                                (n = n || s),
                                (o = o || n),
                                (i = i || o),
                                (l = l || i),
                                (t = t || l),
                                (I = I || !1),
                                (y = void 0 === y ? I : y),
                                (x = void 0 === x ? y : x),
                                (b = void 0 === b ? x : b),
                                (Z = void 0 === Z ? b : Z),
                                (A = void 0 === A ? Z : A),
                                (d = d || !1),
                                (r = r || !1),
                                (c = c || !1),
                                (u = u || 1),
                                (p = p || !1),
                                (m = m || !1),
                                (f = f || null),
                                (h = h || !1),
                                (v = v || !1),
                                (g = g || !1),
                            "rtl" === $("html").attr("dir") && (a = !0),
                                e.slick({
                                    slidesToShow: s,
                                    autoplay: p,
                                    dots: c,
                                    arrows: r,
                                    infinite: h,
                                    vertical: I,
                                    rtl: a,
                                    rows: u,
                                    centerPadding: "0px",
                                    centerMode: d,
                                    fade: m,
                                    asNavFor: f,
                                    focusOnSelect: v,
                                    adaptiveHeight: g,
                                    slidesToScroll: 1,
                                    prevArrow: '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
                                    nextArrow: '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
                                    responsive: [
                                        { breakpoint: 1500, settings: { slidesToShow: n, vertical: y } },
                                        { breakpoint: 1200, settings: { slidesToShow: o, vertical: x } },
                                        { breakpoint: 992, settings: { slidesToShow: i, vertical: b } },
                                        { breakpoint: 768, settings: { slidesToShow: l, vertical: Z } },
                                        { breakpoint: 576, settings: { slidesToShow: t, vertical: A } },
                                    ],
                                });
                        });
                },
                chart: function (e, a) {
                    $(e).length &&
                    $(e).each(function () {
                        var e = $(this);
                        new Chart(e, a);
                    });
                },
                noUiSlider: function () {
                    $(".aiz-range-slider")[0] &&
                    $(".aiz-range-slider").each(function () {
                        var e = document.getElementById("input-slider-range"),
                            a = document.getElementById("input-slider-range-value-low"),
                            t = document.getElementById("input-slider-range-value-high"),
                            l = [a, t];
                        noUiSlider.create(e, {
                            start: [parseInt(a.getAttribute("data-range-value-low")), parseInt(t.getAttribute("data-range-value-high"))],
                            connect: !0,
                            range: { min: parseInt(e.getAttribute("data-range-value-min")), max: parseInt(e.getAttribute("data-range-value-max")) },
                        }),
                            e.noUiSlider.on("update", function (e, a) {
                                l[a].textContent = e[a];
                            }),
                            e.noUiSlider.on("change", function (e, a) {
                                rangefilter(e);
                            });
                    });
                },
                zoom: function () {
                    $(".img-zoom")[0] && ($(".img-zoom").zoom({ magnify: 1.5 }), ("ontouchstart" in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0) && $(".img-zoom").trigger("zoom.destroy"));
                },
                jsSocials: function () {
                    $(".aiz-share").jsSocials({
                        showLabel: !1,
                        showCount: !1,
                        shares: [
                            { share: "email", logo: "lar la-envelope" },
                            { share: "twitter", logo: "lab la-twitter" },
                            { share: "facebook", logo: "lab la-facebook-f" },
                            { share: "linkedin", logo: "lab la-linkedin-in" },
                            { share: "whatsapp", logo: "lab la-whatsapp" },
                        ],
                    });
                },
            }),
            (AIZ.extra = {
                refreshToken: function () {
                    $.get(AIZ.data.appUrl + "/refresh-csrf").done(function (e) {
                        AIZ.data.csrf = e;
                    });
                },
                mobileNavToggle: function () {
                    window.matchMedia("(max-width: 1200px)").matches && $("body").addClass("side-menu-closed"),
                        $('[data-toggle="aiz-mobile-nav"]').on("click", function () {
                            $("body").hasClass("side-menu-open")
                                ? $("body").addClass("side-menu-closed").removeClass("side-menu-open")
                                : $("body").hasClass("side-menu-closed")
                                ? $("body").removeClass("side-menu-closed").addClass("side-menu-open")
                                : $("body").removeClass("side-menu-open").addClass("side-menu-closed");
                        }),
                        $(".aiz-sidebar-overlay").on("click", function () {
                            $("body").removeClass("side-menu-open").addClass("side-menu-closed");
                        });
                },
                initActiveMenu: function () {
                    $('[data-toggle="aiz-side-menu"] a').each(function () {
                        var e = window.location.href.split(/[?#]/)[0];
                        (this.href == e || $(this).hasClass("active")) &&
                        ($(this).addClass("active"),
                            $(this).closest(".aiz-side-nav-item").addClass("mm-active"),
                            $(this).closest(".level-2").siblings("a").addClass("level-2-active"),
                            $(this).closest(".level-3").siblings("a").addClass("level-3-active"));
                    });
                },
                deleteConfirm: function () {
                    $(".confirm-delete").click(function (e) {
                        e.preventDefault();
                        var a = $(this).data("href");
                        $("#delete-modal").modal("show"), $("#delete-link").attr("href", a);
                    }),
                        $(".confirm-cancel").click(function (e) {
                            e.preventDefault();
                            var a = $(this).data("href");
                            $("#cancel-modal").modal("show"), $("#cancel-link").attr("href", a);
                        }),
                        $(".confirm-complete").click(function (e) {
                            e.preventDefault();
                            var a = $(this).data("href");
                            $("#complete-modal").modal("show"), $("#comfirm-link").attr("href", a);
                        }),
                        $(".confirm-alert").click(function (e) {
                            e.preventDefault();
                            var a = $(this).data("href"),
                                t = $(this).data("target");
                            $(t).modal("show"), $(t).find(".comfirm-link").attr("href", a), $("#comfirm-link").attr("href", a);
                        });
                },
                bytesToSize: function (e) {
                    if (0 == e) return "0 Byte";
                    var a = parseInt(Math.floor(Math.log(e) / Math.log(1024)));
                    return Math.round(e / Math.pow(1024, a), 2) + " " + ["Bytes", "KB", "MB", "GB", "TB"][a];
                },
                multiModal: function () {
                    $(document).on("show.bs.modal", ".modal", function (e) {
                        var a = 1040 + 10 * $(".modal:visible").length;
                        $(this).css("z-index", a),
                            setTimeout(function () {
                                $(".modal-backdrop")
                                    .not(".modal-stack")
                                    .css("z-index", a - 1)
                                    .addClass("modal-stack");
                            }, 0);
                    }),
                        $(document).on("hidden.bs.modal", function () {
                            $(".modal.show").length > 0 && $("body").addClass("modal-open");
                        });
                },
                bsCustomFile: function () {
                    $(".custom-file input").change(function (e) {
                        for (var a = [], t = 0; t < $(this)[0].files.length; t++) a.push($(this)[0].files[t].name);
                        1 === a.length
                            ? $(this).next(".custom-file-name").html(a[0])
                            : a.length > 1
                            ? $(this)
                                .next(".custom-file-name")
                                .html(a.length + " " + AIZ.local.files_selected)
                            : $(this).next(".custom-file-name").html(AIZ.local.choose_file);
                    });
                },
                stopPropagation: function () {
                    $(document).on("click", ".stop-propagation", function (e) {
                        e.stopPropagation();
                    });
                },
                outsideClickHide: function () {
                    $(document).on("click", function (e) {
                        $(".document-click-d-none").addClass("d-none");
                    });
                },
                inputRating: function () {
                    $(".rating-input").each(function () {
                        $(this)
                            .find("label")
                            .on({
                                mouseover: function (e) {
                                    $(this).find("i").addClass("hover"), $(this).prevAll().find("i").addClass("hover");
                                },
                                mouseleave: function (e) {
                                    $(this).find("i").removeClass("hover"), $(this).prevAll().find("i").removeClass("hover");
                                },
                                click: function (e) {
                                    $(this).siblings().find("i").removeClass("active"), $(this).find("i").addClass("active"), $(this).prevAll().find("i").addClass("active");
                                },
                            }),
                        $(this).find("input").is(":checked") &&
                        ($(this).find("label").siblings().find("i").removeClass("active"),
                            $(this).find("input:checked").closest("label").find("i").addClass("active"),
                            $(this).find("input:checked").closest("label").prevAll().find("i").addClass("active"));
                    });
                },
                scrollToBottom: function () {
                    $(".scroll-to-btm").each(function (e, a) {
                        a.scrollTop = a.scrollHeight;
                    });
                },
                classToggle: function () {
                    $(document).on("click", '[data-toggle="class-toggle"]', function () {
                        var e = $(this),
                            a = e.data("target"),
                            t = e.data("same");
                        $(a).hasClass("active") ? ($(a).removeClass("active"), $(t).removeClass("active"), e.removeClass("active")) : ($(a).addClass("active"), e.addClass("active"));
                    });
                },
                collapseSidebar: function () {
                    $(document).on("click", '[data-toggle="collapse-sidebar"]', function (a, t) {
                        var l = $(this),
                            i = $(this).data("target"),
                            o = $(this).data("siblings");
                        e.preventDefault(), $(i).hasClass("opened") ? ($(i).removeClass("opened"), $(o).removeClass("opened"), $(l).removeClass("opened")) : ($(i).addClass("opened"), $(l).addClass("opened"));
                    });
                },
                autoScroll: function () {
                    $(".aiz-auto-scroll").length > 0 &&
                    $(".aiz-auto-scroll").each(function () {
                        var e = $(this).data("options");
                        (e = e || '{"delay" : 2000 ,"amount" : 70 }'),
                            (e = JSON.parse(e)),
                            (this.delay = parseInt(e.delay) || 2e3),
                            (this.amount = parseInt(e.amount) || 70),
                            (this.autoScroll = $(this)),
                            (this.iScrollHeight = this.autoScroll.prop("scrollHeight")),
                            (this.iScrollTop = this.autoScroll.prop("scrollTop")),
                            (this.iHeight = this.autoScroll.height());
                        var a = this;
                        this.timerId = setInterval(function () {
                            a.iScrollTop + a.iHeight < a.iScrollHeight
                                ? ((a.iScrollTop = a.autoScroll.prop("scrollTop")), (a.iScrollTop += a.amount), a.autoScroll.animate({ scrollTop: a.iScrollTop }, "slow", "linear"))
                                : ((a.iScrollTop -= a.iScrollTop), a.autoScroll.animate({ scrollTop: "0px" }, "fast", "swing"));
                        }, a.delay);
                    });
                },
                addMore: function () {
                    $('[data-toggle="add-more"]').each(function () {
                        var e = $(this),
                            a = e.data("content"),
                            t = e.data("target");
                        e.on("click", function (e) {
                            e.preventDefault(), $(t).append(a), AIZ.plugins.bootstrapSelect();
                        });
                    });
                },
                removeParent: function () {
                    $(document).on("click", '[data-toggle="remove-parent"]', function () {
                        var e = $(this),
                            a = e.data("parent");
                        e.closest(a).remove();
                    });
                },
                selectHideShow: function () {
                    $('[data-show="selectShow"]').each(function () {
                        var e = $(this).data("target");
                        $(this).on("change", function () {
                            var a = $(this).val();
                            $(e)
                                .children()
                                .not("." + a)
                                .addClass("d-none"),
                                $(e)
                                    .find("." + a)
                                    .removeClass("d-none");
                        });
                    });
                },
                plusMinus: function () {
                    $(".aiz-plus-minus input").each(function () {
                        var e = $(this),
                            a = parseInt($(this).attr("min")),
                            t = parseInt($(this).attr("max")),
                            l = parseInt($(this).val());
                        l <= a && e.siblings('[data-type="minus"]').attr("disabled", !0), l >= t && e.siblings('[data-type="plus"]').attr("disabled", !0);
                    }),
                        $(".aiz-plus-minus button").on("click", function (e) {
                            e.preventDefault();
                            var a = $(this).attr("data-field"),
                                t = $(this).attr("data-type"),
                                l = $("input[name='" + a + "']"),
                                i = parseInt(l.val());
                            isNaN(i)
                                ? l.val(0)
                                : "minus" == t
                                ? (i > l.attr("min") && l.val(i - 1).change(), parseInt(l.val()) == l.attr("min") && $(this).attr("disabled", !0))
                                : "plus" == t && (i < l.attr("max") && l.val(i + 1).change(), parseInt(l.val()) == l.attr("max") && $(this).attr("disabled", !0));
                        }),
                        $(".aiz-plus-minus input").on("change", function () {
                            var e = parseInt($(this).attr("min")),
                                a = parseInt($(this).attr("max")),
                                t = parseInt($(this).val());
                            (name = $(this).attr("name")),
                                t >= e ? $(this).siblings("[data-type='minus']").removeAttr("disabled") : (alert("Sorry, the minimum limit has been reached"), $(this).val($(this).data("oldValue"))),
                                t <= a ? $(this).siblings("[data-type='plus']").removeAttr("disabled") : (alert("Sorry, the maximum limit has been reached"), $(this).val($(this).data("oldValue")));
                        });
                },
                hovCategoryMenu: function () {
                    $("#category-menu-icon, #category-sidebar")
                        .on("mouseover", function (e) {
                            $("#hover-category-menu").addClass("active").removeClass("d-none");
                        })
                        .on("mouseout", function (e) {
                            $("#hover-category-menu").addClass("d-none").removeClass("active");
                        });
                },
                trimAppUrl: function () {
                    "/" == AIZ.data.appUrl.slice(-1) && (AIZ.data.appUrl = AIZ.data.appUrl.slice(0, AIZ.data.appUrl.length - 1));
                },
                setCookie: function (e, a, t) {
                    var l = new Date();
                    l.setTime(l.getTime() + 24 * t * 60 * 60 * 1e3);
                    var i = "expires=" + l.toUTCString();
                    document.cookie = e + "=" + a + ";" + i + ";path=/";
                },
                getCookie: function (e) {
                    for (var a = e + "=", t = decodeURIComponent(document.cookie).split(";"), l = 0; l < t.length; l++) {
                        for (var i = t[l]; " " === i.charAt(0); ) i = i.substring(1);
                        if (0 === i.indexOf(a)) return i.substring(a.length, i.length);
                    }
                    return "";
                },
                acceptCookie: function () {
                    AIZ.extra.getCookie("acceptCookies") || $(".aiz-cookie-alert").addClass("show"),
                        $(".aiz-cookie-accept").on("click", function () {
                            AIZ.extra.setCookie("acceptCookies", !0, 60), $(".aiz-cookie-alert").removeClass("show");
                        });
                },
                setSession: function () {
                    $(".set-session").each(function () {
                        var e = $(this),
                            a = e.data("key");
                        const t = { value: e.data("value"), expiry: new Date().getTime() + 864e5 };
                        e.on("click", function () {
                            localStorage.setItem(a, JSON.stringify(t));
                        });
                    });
                },
                showSessionPopup: function () {
                    $(".removable-session").each(function () {
                        var e = $(this),
                            a = e.data("key"),
                            t = (e.data("value"), {});
                        localStorage.getItem(a) && ((t = localStorage.getItem(a)), (t = JSON.parse(t)));
                        const l = new Date();
                        (void 0 === t.expiry || l.getTime() > t.expiry) && e.removeClass("d-none");
                    });
                },
            }),
            setInterval(function () {
                AIZ.extra.refreshToken();
            }, 36e5),
            AIZ.extra.initActiveMenu(),
            AIZ.extra.mobileNavToggle(),
            AIZ.extra.deleteConfirm(),
            AIZ.extra.multiModal(),
            AIZ.extra.inputRating(),
            AIZ.extra.bsCustomFile(),
            AIZ.extra.stopPropagation(),
            AIZ.extra.outsideClickHide(),
            AIZ.extra.scrollToBottom(),
            AIZ.extra.classToggle(),
            AIZ.extra.collapseSidebar(),
            AIZ.extra.autoScroll(),
            AIZ.extra.addMore(),
            AIZ.extra.removeParent(),
            AIZ.extra.selectHideShow(),
            AIZ.extra.plusMinus(),
            AIZ.extra.hovCategoryMenu(),
            AIZ.extra.trimAppUrl(),
            AIZ.extra.acceptCookie(),
            AIZ.extra.setSession(),
            AIZ.extra.showSessionPopup(),
            AIZ.plugins.metismenu(),
            AIZ.plugins.bootstrapSelect(),
            AIZ.plugins.tagify(),
            AIZ.plugins.textEditor(),
            AIZ.plugins.tooltip(),
            AIZ.plugins.countDown(),
            AIZ.plugins.dateRange(),
            AIZ.plugins.timePicker(),
            AIZ.plugins.fooTable(),
            AIZ.plugins.slickCarousel(),
            AIZ.plugins.noUiSlider(),
            AIZ.plugins.zoom(),
            AIZ.plugins.jsSocials(),
            AIZ.uploader.initForInput(),
            AIZ.uploader.removeAttachment(),
            AIZ.uploader.previewGenerate();
    })(jQuery);
