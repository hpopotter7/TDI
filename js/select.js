/*!
 Select for DataTables 1.1.2
 2015-2016 SpryMedia Ltd - datatables.net/license/mit
*/
(function(e) {
    "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function(j) {
        return e(j, window, document)
    }) : "object" === typeof exports ? module.exports = function(j, l) {
        j || (j = window);
        if (!l || !l.fn.dataTable) l = require("datatables.net")(j, l).$;
        return e(l, j, j.document)
    } : e(jQuery, window, document)
})(function(e, j, l, i) {
    function s(a) {
        var b = a.settings()[0]._select.selector;
        e(a.table().body()).off("mousedown.dtSelect", b).off("mouseup.dtSelect", b).off("click.dtSelect", b);
        e("body").off("click.dtSelect")
    }

    function u(a) {
        var b = e(a.table().body()),
            c = a.settings()[0],
            d = c._select.selector;
        b.on("mousedown.dtSelect", d, function(c) {
            if (c.shiftKey) b.css("-moz-user-select", "none").one("selectstart.dtSelect", d, function() {
                return !1
            })
        }).on("mouseup.dtSelect", d, function() {
            b.css("-moz-user-select", "")
        }).on("click.dtSelect", d, function(c) {
            var b = a.select.items();
            if (!j.getSelection || !j.getSelection().toString()) {
                var d = a.settings()[0];
                if (e(c.target).closest("div.dataTables_wrapper")[0] == a.table().container()) {
                    var m = e(c.target).closest("td, th"),
                        h = a.cell(m).index();
                    a.cell(m).any() && ("row" === b ? (b = h.row, t(c, a, d, "row", b)) : "column" === b ? (b = a.cell(m).index().column, t(c, a, d, "column", b)) : "cell" === b && (b = a.cell(m).index(), t(c, a, d, "cell", b)), d._select_lastCell = h)
                }
            }
        });
        e("body").on("click.dtSelect", function(b) {
            c._select.blurable && !e(b.target).parents().filter(a.table().container()).length && (e(b.target).parents("div.DTE").length || q(c, !0))
        })
    }

    function k(a, b, c, d) {
        if (!d || a.flatten().length) c.unshift(a), e(a.table().node()).triggerHandler(b + ".dt", c)
    }

    function v(a) {
        var b =
            a.settings()[0];
        if (b._select.info && b.aanFeatures.i) {
            var c = e('<span class="select-info"/>'),
                d = function(b, d) {
                    c.append(e('<span class="select-item"/>').append(a.i18n("select." + b + "s", {
                        _: "%d " + b + "s selected",
                        "0": "",
                        1: "1 " + b + " selected"
                    }, d)))
                };
            d("row", a.rows({
                selected: !0
            }).flatten().length);
            d("column", a.columns({
                selected: !0
            }).flatten().length);
            d("cell", a.cells({
                selected: !0
            }).flatten().length);
            e.each(b.aanFeatures.i, function(b, a) {
                var a = e(a),
                    d = a.children("span.select-info");
                d.length && d.remove();
                "" !== c.text() &&
                    a.append(c)
            })
        }
    }

    function q(a, b) {
        if (b || "single" === a._select.style) {
            var c = new h.Api(a);
            c.rows({
                selected: !0
            }).deselect();
            c.columns({
                selected: !0
            }).deselect();
            c.cells({
                selected: !0
            }).deselect()
        }
    }

    function t(a, b, c, d, f) {
        var n = b.select.style(),
            g = b[d](f, {
                selected: !0
            }).any();
        "os" === n ? a.ctrlKey || a.metaKey ? b[d](f).select(!g) : a.shiftKey ? "cell" === d ? (d = c._select_lastCell || null, g = function(c, a) {
            if (c > a) var d = a,
                a = c,
                c = d;
            var f = !1;
            return b.columns(":visible").indexes().filter(function(b) {
                b === c && (f = !0);
                return b === a ? (f = !1, !0) : f
            })
        }, a = function(c, a) {
            var d = b.rows({
                search: "applied"
            }).indexes();
            if (d.indexOf(c) > d.indexOf(a)) var f = a,
                a = c,
                c = f;
            var g = !1;
            return d.filter(function(b) {
                b === c && (g = !0);
                return b === a ? (g = !1, !0) : g
            })
        }, !b.cells({
            selected: !0
        }).any() && !d ? (g = g(0, f.column), d = a(0, f.row)) : (g = g(d.column, f.column), d = a(d.row, f.row)), d = b.cells(d, g).flatten(), b.cells(f, {
            selected: !0
        }).any() ? b.cells(d).deselect() : b.cells(d).select()) : (a = c._select_lastCell ? c._select_lastCell[d] : null, g = b[d + "s"]({
            search: "applied"
        }).indexes(), a = e.inArray(a,
            g), c = e.inArray(f, g), !b[d + "s"]({
            selected: !0
        }).any() && -1 === a ? g.splice(e.inArray(f, g) + 1, g.length) : (a > c && (n = c, c = a, a = n), g.splice(c + 1, g.length), g.splice(0, a)), b[d](f, {
            selected: !0
        }).any()) ? (g.splice(e.inArray(f, g), 1), b[d + "s"](g).deselect()) : b[d + "s"](g).select() : (a = b[d + "s"]({
            selected: !0
        }), g && 1 === a.flatten().length ? b[d](f).deselect() : (a.deselect(), b[d](f).select())) : b[d](f).select(!g)
    }

    function r(a, b) {
        return function(c) {
            return c.i18n("buttons." + a, b)
        }
    }
    var h = e.fn.dataTable;
    h.select = {};
    h.select.version = "1.1.2";
    h.select.init = function(a) {
        var b = a.settings()[0],
            c = b.oInit.select,
            d = h.defaults.select,
            c = c === i ? d : c,
            d = "row",
            f = "api",
            n = !1,
            g = !0,
            m = "td, th",
            j = "selected";
        b._select = {};
        if (!0 === c) f = "os";
        else if ("string" === typeof c) f = c;
        else if (e.isPlainObject(c) && (c.blurable !== i && (n = c.blurable), c.info !== i && (g = c.info), c.items !== i && (d = c.items), c.style !== i && (f = c.style), c.selector !== i && (m = c.selector), c.className !== i)) j = c.className;
        a.select.selector(m);
        a.select.items(d);
        a.select.style(f);
        a.select.blurable(n);
        a.select.info(g);
        b._select.className =
            j;
        e.fn.dataTable.ext.order["select-checkbox"] = function(b, c) {
            return this.api().column(c, {
                order: "index"
            }).nodes().map(function(c) {
                return "row" === b._select.items ? e(c).parent().hasClass(b._select.className) : "cell" === b._select.items ? e(c).hasClass(b._select.className) : !1
            })
        };
        e(a.table().node()).hasClass("selectable") && a.select.style("os")
    };
    e.each([{
        type: "row",
        prop: "aoData"
    }, {
        type: "column",
        prop: "aoColumns"
    }], function(a, b) {
        h.ext.selector[b.type].push(function(c, a, f) {
            var a = a.selected,
                e, g = [];
            if (a === i) return f;
            for (var h = 0, j = f.length; h < j; h++) e = c[b.prop][f[h]], (!0 === a && !0 === e._select_selected || !1 === a && !e._select_selected) && g.push(f[h]);
            return g
        })
    });
    h.ext.selector.cell.push(function(a, b, c) {
        var b = b.selected,
            d, f = [];
        if (b === i) return c;
        for (var e = 0, g = c.length; e < g; e++) d = a.aoData[c[e].row], (!0 === b && d._selected_cells && !0 === d._selected_cells[c[e].column] || !1 === b && (!d._selected_cells || !d._selected_cells[c[e].column])) && f.push(c[e]);
        return f
    });
    var o = h.Api.register,
        p = h.Api.registerPlural;
    o("select()", function() {
        return this.iterator("table",
            function(a) {
                h.select.init(new h.Api(a))
            })
    });
    o("select.blurable()", function(a) {
        return a === i ? this.context[0]._select.blurable : this.iterator("table", function(b) {
            b._select.blurable = a
        })
    });
    o("select.info()", function(a) {
        return v === i ? this.context[0]._select.info : this.iterator("table", function(b) {
            b._select.info = a
        })
    });
    o("select.items()", function(a) {
        return a === i ? this.context[0]._select.items : this.iterator("table", function(b) {
            b._select.items = a;
            k(new h.Api(b), "selectItems", [a])
        })
    });
    o("select.style()", function(a) {
        return a ===
            i ? this.context[0]._select.style : this.iterator("table", function(b) {
                b._select.style = a;
                if (!b._select_init) {
                    var c = new h.Api(b);
                    b.aoRowCreatedCallback.push({
                        fn: function(c, a, d) {
                            a = b.aoData[d];
                            a._select_selected && e(c).addClass(b._select.className);
                            c = 0;
                            for (d = b.aoColumns.length; c < d; c++)(b.aoColumns[c]._select_selected || a._selected_cells && a._selected_cells[c]) && e(a.anCells[c]).addClass(b._select.className)
                        },
                        sName: "select-deferRender"
                    });
                    c.on("preXhr.dt.dtSelect", function() {
                        var b = c.rows({
                                selected: !0
                            }).ids(!0).filter(function(b) {
                                return b !==
                                    i
                            }),
                            a = c.cells({
                                selected: !0
                            }).eq(0).map(function(b) {
                                var a = c.row(b.row).id(!0);
                                return a ? {
                                    row: a,
                                    column: b.column
                                } : i
                            }).filter(function(b) {
                                return b !== i
                            });
                        c.one("draw.dt.dtSelect", function() {
                            c.rows(b).select();
                            a.any() && a.each(function(b) {
                                c.cells(b.row, b.column).select()
                            })
                        })
                    });
                    c.on("draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt", function() {
                        v(c)
                    });
                    c.on("destroy.dtSelect", function() {
                        s(c);
                        c.off(".dtSelect")
                    })
                }
                var d = new h.Api(b);
                s(d);
                "api" !== a && u(d);
                k(new h.Api(b), "selectStyle", [a])
            })
    });
    o("select.selector()",
        function(a) {
            return a === i ? this.context[0]._select.selector : this.iterator("table", function(b) {
                s(new h.Api(b));
                b._select.selector = a;
                "api" !== b._select.style && u(new h.Api(b))
            })
        });
    p("rows().select()", "row().select()", function(a) {
        var b = this;
        if (!1 === a) return this.deselect();
        this.iterator("row", function(b, a) {
            q(b);
            b.aoData[a]._select_selected = !0;
            e(b.aoData[a].nTr).addClass(b._select.className)
        });
        this.iterator("table", function(a, d) {
            k(b, "select", ["row", b[d]], !0)
        });
        return this
    });
    p("columns().select()", "column().select()",
        function(a) {
            var b = this;
            if (!1 === a) return this.deselect();
            this.iterator("column", function(b, a) {
                q(b);
                b.aoColumns[a]._select_selected = !0;
                var f = (new h.Api(b)).column(a);
                e(f.header()).addClass(b._select.className);
                e(f.footer()).addClass(b._select.className);
                f.nodes().to$().addClass(b._select.className)
            });
            this.iterator("table", function(a, d) {
                k(b, "select", ["column", b[d]], !0)
            });
            return this
        });
    p("cells().select()", "cell().select()", function(a) {
        var b = this;
        if (!1 === a) return this.deselect();
        this.iterator("cell",
            function(b, a, f) {
                q(b);
                a = b.aoData[a];
                a._selected_cells === i && (a._selected_cells = []);
                a._selected_cells[f] = !0;
                a.anCells && e(a.anCells[f]).addClass(b._select.className)
            });
        this.iterator("table", function(a, d) {
            k(b, "select", ["cell", b[d]], !0)
        });
        return this
    });
    p("rows().deselect()", "row().deselect()", function() {
        var a = this;
        this.iterator("row", function(b, a) {
            b.aoData[a]._select_selected = !1;
            e(b.aoData[a].nTr).removeClass(b._select.className)
        });
        this.iterator("table", function(b, c) {
            k(a, "deselect", ["row", a[c]], !0)
        });
        return this
    });
    p("columns().deselect()", "column().deselect()", function() {
        var a = this;
        this.iterator("column", function(b, a) {
            b.aoColumns[a]._select_selected = !1;
            var d = new h.Api(b),
                f = d.column(a);
            e(f.header()).removeClass(b._select.className);
            e(f.footer()).removeClass(b._select.className);
            d.cells(null, a).indexes().each(function(a) {
                var c = b.aoData[a.row],
                    d = c._selected_cells;
                c.anCells && (!d || !d[a.column]) && e(c.anCells[a.column]).removeClass(b._select.className)
            })
        });
        this.iterator("table", function(b, c) {
            k(a, "deselect", ["column",
                a[c]
            ], !0)
        });
        return this
    });
    p("cells().deselect()", "cell().deselect()", function() {
        var a = this;
        this.iterator("cell", function(b, a, d) {
            a = b.aoData[a];
            a._selected_cells[d] = !1;
            a.anCells && !b.aoColumns[d]._select_selected && e(a.anCells[d]).removeClass(b._select.className)
        });
        this.iterator("table", function(b, c) {
            k(a, "deselect", ["cell", a[c]], !0)
        });
        return this
    });
    e.extend(h.ext.buttons, {
        selected: {
            text: r("selected", "Selected"),
            className: "buttons-selected",
            init: function(a) {
                var b = this;
                a.on("draw.dt.DT select.dt.DT deselect.dt.DT",
                    function() {
                        var a = b.rows({
                            selected: !0
                        }).any() || b.columns({
                            selected: !0
                        }).any() || b.cells({
                            selected: !0
                        }).any();
                        b.enable(a)
                    });
                this.disable()
            }
        },
        selectedSingle: {
            text: r("selectedSingle", "Selected single"),
            className: "buttons-selected-single",
            init: function(a) {
                var b = this;
                a.on("draw.dt.DT select.dt.DT deselect.dt.DT", function() {
                    var c = a.rows({
                        selected: !0
                    }).flatten().length + a.columns({
                        selected: !0
                    }).flatten().length + a.cells({
                        selected: !0
                    }).flatten().length;
                    b.enable(1 === c)
                });
                this.disable()
            }
        },
        selectAll: {
            text: r("selectAll",
                "Select all"),
            className: "buttons-select-all",
            action: function() {
                this[this.select.items() + "s"]().select()
            }
        },
        selectNone: {
            text: r("selectNone", "Deselect all"),
            className: "buttons-select-none",
            action: function() {
                q(this.settings()[0], !0)
            },
            init: function(a) {
                var b = this;
                a.on("draw.dt.DT select.dt.DT deselect.dt.DT", function() {
                    var c = a.rows({
                        selected: !0
                    }).flatten().length + a.columns({
                        selected: !0
                    }).flatten().length + a.cells({
                        selected: !0
                    }).flatten().length;
                    b.enable(0 < c)
                });
                this.disable()
            }
        }
    });
    e.each(["Row", "Column", "Cell"],
        function(a, b) {
            var c = b.toLowerCase();
            h.ext.buttons["select" + b + "s"] = {
                text: r("select" + b + "s", "Select " + c + "s"),
                className: "buttons-select-" + c + "s",
                action: function() {
                    this.select.items(c)
                },
                init: function(a) {
                    var b = this;
                    a.on("selectItems.dt.DT", function(a, d, e) {
                        b.active(e === c)
                    })
                }
            }
        });
    e(l).on("preInit.dt.dtSelect", function(a, b) {
        "dt" === a.namespace && h.select.init(new h.Api(b))
    });
    return h.select
});