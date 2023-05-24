jQuery( function( $ ) {
	var call_url = typeof pvc_vars.ajax_load_type != 'undefined' && pvc_vars.ajax_load_type == 'admin_ajax' ? pvc_vars.ajax_url : pvc_vars.rest_api_url;

	pvc = { apps: {}, models: {}, collections: {}, views: {} };

	_.templateSettings = {
  		evaluate: /[<{][%{](.+?)[%}][}>]/g,
    	interpolate: /[<{][%{]=(.+?)[%}][}>]/g,
    	escape: /[<{][%{]-(.+?)[%}][}>]/g
	}
	
	pvc.models.State = Backbone.Model.extend({
		defaults: {
			post_id: 0,
			total_view: 1,
			today_view: 1
		}
	});
	
	pvc.collections.Stats = Backbone.Collection.extend({
		model: pvc.models.State,
		
		url: call_url
		
	});
	
	pvc.views.State = Backbone.View.extend({
		model: pvc.models.State,
				
		tagName: 'span',
		
		template: _.template( $('#pvc-stats-view-template').html() ),
		
		initialize: function() {
			
		},
		
		render: function() {
			//console.log('Rendering Page View Count of ID #' + this.model.get('post_id') + ' - Today: #' + this.model.get('today_view') + ' - Total: #' + this.model.get('total_view'));
			this.$el.html( this.template( this.model.toJSON() ) );
			
			return this;
		}
		
	});
	
	pvc.views.AppView = Backbone.View.extend({
		
		initialize: function() {
			this.listenTo( this.collection, 'add', this.addOne );
				
		},
		addOne: function( state_model ) {
			var state_view = new pvc.views.State( { model: state_model } );
			this.$el.html( state_view.render().el );
		}
	});
	
	pvc.apps.app = {
		initialize: function( pvc_ids ) {
			this.call_url = call_url;
			//console.log('Load Page View Count of ' + JSON.stringify(pvc_ids) );

			view_pvc_ids = [];
			increase_pvc_ids = [];

			$.each( pvc_ids, function (index, data) {
				if ( data.ask_update ) {
					increase_pvc_ids.push( data.post_id );
				} else {
					view_pvc_ids.push( data.post_id );
				}
			});

			if ( increase_pvc_ids.length ) {
				action = typeof pvc_vars.ajax_load_type != 'undefined' && pvc_vars.ajax_load_type == 'admin_ajax' ? '?action=pvc_increase&security=' + pvc_vars.security + '&ids=' : '/increase/';
				$.get( this.call_url + action + increase_pvc_ids.join(','), function( data_pvc ) {
					//console.log(data_pvc);
					if ( data_pvc.success ) {
						$.each( data_pvc.items, function (index, data) {
							collection = new pvc.collections.Stats;
							new pvc.views.AppView( { collection: collection, el : $('#pvc_stats_' + index ) } );
							collection.add( data );
							
						});
					}
				});
			}

			if ( view_pvc_ids.length ) {
				action = typeof pvc_vars.ajax_load_type != 'undefined' && pvc_vars.ajax_load_type == 'admin_ajax' ? '?action=pvc_view&security=' + pvc_vars.security + '&ids=' : '/view/';
				$.get( this.call_url + action + view_pvc_ids.join(','), function( data_pvc ) {
					//console.log(data_pvc);
					if ( data_pvc.success ) {
						$.each( data_pvc.items , function (index, data) {
							collection = new pvc.collections.Stats;
							new pvc.views.AppView( { collection: collection, el : $('#pvc_stats_' + index ) } );
							collection.add( data );
							
						});
					}
				});
			}
		}

	}
		
});

jQuery( document ).ready( function( $ ) {
	var pvc_stats = $( '.pvc_stats' );
	if ( pvc_stats.length ) {
		var pvc_ids = {};
		$(".pvc_stats").each( function() {
			post_id = $(this).data('element-id');
			update_status = $(this).hasClass('pvc_load_by_ajax_update');
			pvc_ids[post_id] = { post_id: post_id, ask_update : update_status };
		});
		
		var app = pvc.apps.app;
		app.initialize( pvc_ids );
	}
});