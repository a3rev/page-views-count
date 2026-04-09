/**
 * Block Editor — Page View Counter document panel (parity with legacy meta box).
 */
( function () {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editPost;
	const { ToggleControl, TextControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;
	const { createElement: el, Fragment } = wp.element;
	const { __ } = wp.i18n;
	const { store: editorStore } = wp.editor;

	const REST_KEY = 'a3_pvc';

	function defaultPanel() {
		return {
			activated: false,
			total_views: 0,
			today_views: 0,
		};
	}

	function mergePanel( current ) {
		if ( ! current || typeof current !== 'object' ) {
			return defaultPanel();
		}
		return {
			activated: !! current.activated,
			total_views:
				current.total_views !== undefined && current.total_views !== null
					? parseInt( current.total_views, 10 ) || 0
					: 0,
			today_views:
				current.today_views !== undefined && current.today_views !== null
					? parseInt( current.today_views, 10 ) || 0
					: 0,
		};
	}

	function PvcDocumentPanel() {
		const edited = useSelect( ( select ) => {
			return select( editorStore ).getEditedPostAttribute( REST_KEY );
		}, [] );

		const saved = useSelect( ( select ) => {
			return select( editorStore ).getCurrentPostAttribute( REST_KEY );
		}, [] );

		const { editPost } = useDispatch( editorStore );

		const base =
			edited !== undefined && edited !== null
				? edited
				: saved !== undefined && saved !== null
					? saved
					: defaultPanel();

		const panel = mergePanel( base );

		function setPanel( next ) {
			editPost( { [ REST_KEY ]: mergePanel( next ) } );
		}

		function onToggle( value ) {
			setPanel(
				Object.assign( {}, panel, {
					activated: value,
				} )
			);
		}

		function onChangeTotal( value ) {
			setPanel(
				Object.assign( {}, panel, {
					total_views: parseInt( value, 10 ) || 0,
				} )
			);
		}

		function onChangeToday( value ) {
			setPanel(
				Object.assign( {}, panel, {
					today_views: parseInt( value, 10 ) || 0,
				} )
			);
		}

		return el(
			Fragment,
			null,
			el( ToggleControl, {
				label: __( 'Activate on this item', 'page-views-count' ),
				checked: panel.activated,
				onChange: onToggle,
			} ),
			panel.activated
				? el(
						Fragment,
						null,
						el( TextControl, {
							label: __( 'All Time Views', 'page-views-count' ),
							value: String( panel.total_views ),
							onChange: onChangeTotal,
							type: 'text',
						} ),
						el( TextControl, {
							label: __( 'Today Views', 'page-views-count' ),
							value: String( panel.today_views ),
							onChange: onChangeToday,
							type: 'text',
						} )
				  )
				: null
		);
	}

	registerPlugin( 'a3-pvc-document-panel', {
		icon: 'chart-bar',
		render: function () {
			return el(
				PluginDocumentSettingPanel,
				{
					name: 'a3-pvc-panel',
					title: __( 'Page View Counter', 'page-views-count' ),
					className: 'a3-pvc-document-panel',
				},
				el( PvcDocumentPanel, null )
			);
		},
	} );
} )();
