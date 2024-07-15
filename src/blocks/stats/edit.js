/**
 * External dependencies
 */

/**
 * Internal dependencies
 */

const { __ } = wp.i18n; // Import __() from wp.i18n
const { useBlockProps, BlockControls, AlignmentToolbar, InspectorControls } = wp.blockEditor || wp.editor;
const { Placeholder, PanelBody, PanelRow, ToggleControl } = wp.components;
const { serverSideRender: ServerSideRender } = wp;
const { Fragment } = wp.element;
const { select } = wp.data;

export default function BlockEdit( { attributes, setAttributes } ) {

	const blockProps = useBlockProps();

	if ( attributes.isPreview ) {
		return ( <img
			src={ pvcblock.preview }
			alt={ __( 'Page Views Count Preview', 'page-views-count' ) }
			style={ {
				width: '100%',
				height: 'auto',
			} }
		/> );
	}

	const { align, isDisabled } = attributes;
	const postID = select('core/editor').getCurrentPostId();

	function onChangeAlign(newAlign) {
		setAttributes({ align: newAlign });
	}

	function toggleManualShow(isDisabled) {
		setAttributes({ isDisabled: !isDisabled });
		const activateOption = document.querySelector('#a3_pvc_activated');

		if (isDisabled) {
			activateOption.removeAttribute('checked');
			activateOption.setAttribute('disabled', true);
		} else {
			activateOption.setAttribute('checked', true);
			activateOption.removeAttribute('disabled');
		}
	}

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title={__('PVC Settings', 'page-views-count')} opened="true">
					<PanelRow>
						<ToggleControl
							label={__('Manual Show', 'page-views-count')}
							help={
								isDisabled
									? __('Using global show', 'page-views-count')
									: __('Using manual show', 'page-views-count')
							}
							checked={!isDisabled}
							onChange={toggleManualShow}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			{isDisabled ? (
				<Placeholder label={__('Page Views', 'page-views-count')}>
					{__('Need to active from Settings of this block', 'page-views-count')}
				</Placeholder>
			) : (
				<Fragment>
					<BlockControls>
						<AlignmentToolbar value={align} onChange={onChangeAlign} />
					</BlockControls>
					<div { ...blockProps }>
						<ServerSideRender block="page-views-count/stats" attributes={ { ...attributes, postID } } />
					</div>
				</Fragment>
			)}
		</Fragment>
	);
}
