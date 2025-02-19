/*=========================================================================================
    File Name: tagging.js
    Description: tagging js initialization
    ----------------------------------------------------------------------------------------
    Item Name: Apex - Responsive Admin Theme
    Version: 2.1
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
/*! taggingJS - v1.3.3 - 2015-05-04 */

!function(a,
          b,
          c,
          d) {
    var e=function(b, c) {
            this.elem=b, this.$elem=a(b), this.options=c, this.tags=[]
        }
    ;
    e.prototype= {
        keys: {
            add: {
                comma: 188, enter: 13, spacebar: 32
            }
            ,
            remove: {
                del: 46, backspace: 8
            }
        }
        ,
        defaults: {
            "case-sensitive": !1, "close-char": "&times;", "close-class": "tag-i", "edit-on-delete": !0, "forbidden-chars": [".", "_", "?"], "forbidden-chars-callback": b.alert, "forbidden-chars-text": "Forbidden character:", "forbidden-words": [], "forbidden-words-callback": b.alert, "forbidden-words-text": "Forbidden word:", "no-backspace": !1, "no-comma": !1, "no-del": !1, "no-duplicate": !0, "no-duplicate-callback": b.alert, "no-duplicate-text": "Duplicate tag:", "no-enter": !1, "no-spacebar": !1, "pre-tags-separator": ", ", "tag-box-class": "tagging", "tag-char": "#", "tag-class": "tag", "tags-input-name": "tag", "tag-on-blur": !0, "type-zone-class": "type-zone"
        }
        ,
        add:function(b) {
            var d, e, f, g, h, i, j;
            if(f=this, a.isArray(b))return a.each(b, function() {
                    f.add(this+"")
                }
            );
            if(h=f.config["forbidden-words"],
            b||(b=f.valInput(),
                f.emptyInput()),
            !b||!b.length)return!1;
            for(f.config["case-sensitive"]||(b=b.toLowerCase()),
                    e=h.length;
                e--;
            )if(g=b.indexOf(h[e]),
            g>=0)return f.emptyInput(),
                i=f.config["forbidden-words-callback"],
                j=f.config["forbidden-words-text"],
                f.throwError(i,
                    j,
                    b);
            if(f.config["no-duplicate"])for(e=f.tags.length;
                                            e--;
            )if(f.tags[e].pure_text===b)return f.emptyInput(),
                    i=f.config["no-duplicate-callback"],
                    j=f.config["no-duplicate-text"],
                    f.throwError(i,
                        j,
                        b);
            return d=a(c.createElement("div")).addClass(f.config["tag-class"]).html("<span>"+f.config["tag-char"]+"</span> "+b),
                a(c.createElement("input")).attr("type",
                    "hidden").attr("name",
                    f.config["tags-input-name"]+"[]").val(b).appendTo(d),
                a(c.createElement("a")).attr("role",
                    "button").addClass(f.config["close-class"]).html(f.config["close-char"]).click(function() {
                        f.remove(d)
                    }
                ).appendTo(d),
                d.pure_text=b,
                f.tags.push(d),
                f.$type_zone.before(d),
                f.$elem.trigger("add:after",
                    [b,
                        f]),
                !0
        }
        ,
        addSpecialKeys:function(b) {
            var c, d, e, f, g;
            if(c=this, g=b[0], f=b[1], e= {}, a.isArray(f))return a.each(f, function() {
                    c.addSpecialKeys([g, this])
                }
            );
            if(!f&&f.constructor!==Object)return"Error -> The second argument is not an Object!";
            for(d in f)f.hasOwnProperty(d)&&f[d]===+f[d]&&f[d]===(0|f[d])&&a.extend(e,
                f);
            return c.keys[g]=a.extend( {},
                e,
                c.keys[g]),
                c.keys[g]
        }
        ,
        destroy:function() {
            return this.$elem.find("."+this.config["type-zone-class"]).remove(), this.$elem.find("."+this.config["tag-class"]).remove(), this.$elem.data("tag-box", null), !0
        }
        ,
        emptyInput:function() {
            return this.focusInput(), this.valInput("")
        }
        ,
        focusInput:function() {
            return this.$type_zone.focus()
        }
        ,
        getDataOptions:function() {
            var a, b, c;
            c= {};
            for(a in this.defaults)b=this.$elem.data(a), b&&(c[a]=b);
            return c
        }
        ,
        getSpecialKeys:function() {
            return a.extend( {}, this.keys.add, this.keys.remove)
        }
        ,
        getSpecialKeysD:function() {
            return this.keys
        }
        ,
        getTags:function() {
            var a, b, c;
            for(c=this.tags.length, a=[], b=0;
                c>b;
                b+=1)a.push(this.tags[b].pure_text);
            return a
        }
        ,
        getTagsObj:function() {
            return this.tags
        }
        ,
        init:function() {
            var b, d, e;
            return d=this, d.config=a.extend( {}, d.defaults, d.options, d.getDataOptions()), b=d.$elem.text(), d.$elem.empty(), d.$type_zone=a(c.createElement("input")).addClass(d.config["type-zone-class"]).attr("contenteditable", !0), d.$elem.addClass(d.config["tag-box-class"]).append(d.$type_zone), d.$type_zone.keydown(function(a) {
                    var b, c, e, f, g, h, i, j, k;
                    if(g=d.getSpecialKeys(), h=d.config["forbidden-chars"], i=d.valInput(), f=a.which, i) {
                        for(e=h.length;
                            e--;
                        )if(c=i.indexOf(h[e]), c>=0)return a.preventDefault(), i=i.replace(h[e], ""), d.focusInput(), d.valInput(i), j=d.config["forbidden-chars-callback"], k=d.config["forbidden-chars-text"], d.throwError(j, k, h[e]);
                        for(b in d.keys.add)if(f===d.keys.add[b]&&!d.config["no-"+b])return a.preventDefault(), d.add()
                    }
                    else for(b in g)if(f===g[b]) {
                        if(d.keys.add[b])return a.preventDefault(), !0;
                        if(d.keys.remove[b]&&!d.config["no-"+b])return a.preventDefault(), d.remove()
                    }
                    return!0
                }
            ),
            d.config["tag-on-blur"]&&d.$type_zone.focusout(function() {
                    return e=d.valInput(), e&&e.length?d.add(): !1
                }
            ),
                d.$elem.on("click",
                    function() {
                        d.focusInput()
                    }
                ),
                d.refresh(b),
                d
        }
        ,
        refresh:function(b) {
            var c, d;
            return c=this, d=c.config["pre-tags-separator"], b=b||c.getTags().join(d), c.reset(), a.each(b.split(d), function() {
                    c.add(this+"")
                }
            ),
                !0
        }
        ,
        remove:function(b) {
            var c, d, e;
            if(c=this, a.isArray(b))return a.each(b, function() {
                    c.remove(this+"")
                }
            );
            if("string"==typeof b&&(d=b,
                b=c.$elem.find("input[value="+d+"]").parent(),
                !b.length))return"Error -> Tag not found";
            if(b)for(e=c.tags.length;
                     e--;
            )c.tags[e][0].innerHTML===b[0].innerHTML&&c.tags.splice(e,
                    1);
            else b=c.tags.pop();
            return d=d||b.pure_text,
                b.remove(),
            c.config["edit-on-delete"]&&(c.emptyInput(),
                c.valInput(b.pure_text)),
                c.$elem.trigger("remove:after",
                    [d,
                        c]),
                b
        }
        ,
        removeAll:function() {
            return this.reset()
        }
        ,
        removeSpecialKeys:function(b) {
            var c, e, f, g, h;
            if(c=this, h=b[0], g=b[1], f= {}, a.isArray(g))return a.each(g, function() {
                    c.removeSpecialKeys([h, this])
                }
            );
            for(e in c.keys[h])c.keys[h].hasOwnProperty(e)&&c.keys[h][e]===g&&(c.keys[h][e]=d);
            return c.keys[h]
        }
        ,
        reset:function() {
            for(;
                this.tags.length;
            )this.remove(this.tags[this.tags.length]);
            return this.emptyInput(), this.tags
        }
        ,
        throwError:function(a,
                            b,
                            c) {
            return a([b+" '"+c+"'."])
        }
        ,
        valInput:function(a) {
            return null==a?this.$type_zone.val(): this.$type_zone.val(a)
        }
    }
        ,
        a.fn.tagging=function(b,
                              c) {
            var d=[];
            return this.each(function() {
                    var f, g, h;
                    f=a(this), g=f.data("tag-box"), g?(h=g[b](c), h&&d.push(h)): (g=new e(this, b), f.data("tag-box", g), g.init(), d.push(g.$elem))
                }
            ),
                "string"==typeof b?d.length>1?d:d[0]:d
        }
}
(window.jQuery,
    window,
    document);
