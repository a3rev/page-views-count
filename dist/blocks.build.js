!(function(e) {
  function t(o) {
    if (n[o]) return n[o].exports;
    var l = (n[o] = { i: o, l: !1, exports: {} });
    return e[o].call(l.exports, l, l.exports, t), (l.l = !0), l.exports;
  }
  var n = {};
  (t.m = e),
    (t.c = n),
    (t.d = function(e, n, o) {
      t.o(e, n) || Object.defineProperty(e, n, { configurable: !1, enumerable: !0, get: o });
    }),
    (t.n = function(e) {
      var n =
        e && e.__esModule
          ? function() {
              return e.default;
            }
          : function() {
              return e;
            };
      return t.d(n, 'a', n), n;
    }),
    (t.o = function(e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }),
    (t.p = ''),
    t((t.s = 0));
})([
  function(e, t, n) {
    'use strict';
    Object.defineProperty(t, '__esModule', { value: !0 });
    n(1);
  },
  function(e, t, n) {
    'use strict';
    var o = n(2),
      l = wp.i18n.__,
      r = wp.blocks.registerBlockType,
      a = wp.editor,
      i = a.BlockControls,
      s = a.AlignmentToolbar,
      c = a.InspectorControls,
      u = wp.components,
      p = u.Placeholder,
      w = u.ServerSideRender,
      m = u.PanelBody,
      d = u.PanelRow,
      g = u.ToggleControl,
      v = wp.element.Fragment,
      b = wp.data.select;
    r('page-views-count/stats', {
      title: l('Page Views', 'page-views-count'),
      description: l('Show all time views and views today', 'page-views-count'),
      icon: o.a,
      category: 'common',
      supports: { multiple: !1 },
      keywords: [
        l('Page Views Count', 'page-views-count'),
        l('Views', 'page-views-count'),
        l('Stats', 'page-views-count'),
      ],
      attributes: {
        align: { type: 'string' },
        postID: { type: 'string' },
        isDisabled: { type: 'boolean', default: !0 },
      },
      edit: function(e) {
        function t(e) {
          r({ align: e });
        }
        function n(e) {
          r({ isDisabled: !e });
          var t = document.querySelector('#a3_pvc_activated');
          e
            ? (t.removeAttribute('checked'), t.setAttribute('disabled', !0))
            : (t.setAttribute('checked', !0), t.removeAttribute('disabled'));
        }
        var o = e.attributes,
          r = e.setAttributes,
          a = o.align,
          u = o.isDisabled,
          f = b('core/editor').getCurrentPostId();
        return (
          (o.postID = f),
          wp.element.createElement(
            v,
            null,
            wp.element.createElement(
              c,
              null,
              wp.element.createElement(
                m,
                { title: l('PVC Settings', 'page-views-count'), opened: 'true' },
                wp.element.createElement(
                  d,
                  null,
                  wp.element.createElement(g, {
                    label: l('Manual Show', 'page-views-count'),
                    help: u
                      ? l('Using global show', 'page-views-count')
                      : l('Using manual show', 'page-views-count'),
                    checked: !u,
                    onChange: n,
                  }),
                ),
              ),
            ),
            u
              ? wp.element.createElement(
                  p,
                  { label: l('Page Views', 'page-views-count') },
                  l('Need to active from Settings of this block', 'page-views-count'),
                )
              : wp.element.createElement(
                  v,
                  null,
                  wp.element.createElement(
                    i,
                    null,
                    wp.element.createElement(s, { value: a, onChange: t }),
                  ),
                  wp.element.createElement(w, {
                    block: 'page-views-count/stats-editor',
                    attributes: o,
                  }),
                ),
          )
        );
      },
      save: function() {
        return null;
      },
    });
  },
  function(e, t, n) {
    'use strict';
    n.d(t, 'a', function() {
      return l;
    });
    var o = wp.components.SVG,
      l = function() {
        return wp.element.createElement(
          o,
          { xmlns: 'http://www.w3.org/2000/svg', width: '24', height: '24', viewBox: '0 0 24 24' },
          wp.element.createElement('path', { d: 'M0 0h24v24H0z', fill: 'none' }),
          wp.element.createElement('path', {
            d:
              'M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z',
          }),
        );
      };
  },
]);
