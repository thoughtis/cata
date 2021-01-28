/**
 * Mark Format 
 */
( function( wp ) {

	/**
	 * @link https://material.io/resources/icons/?icon=border_color&style=baseline
	 */
	const icon = wp.element.createElement( 'svg', {
		children: [
			wp.element.createElement( 'path', {
				d: 'M22,24H2v-4h20V24z M13.06,5.19l3.75,3.75L7.75,18H4v-3.75L13.06,5.19z M17.88,7.87l-3.75-3.75 l1.83-1.83c0.39-0.39,1.02-0.39,1.41,0l2.34,2.34c0.39,0.39,0.39,1.02,0,1.41L17.88,7.87z'
			})
		]
	} );

	const MarkButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton,
			{
				icon: icon,
				title: 'Mark / Highlight',
				style: 'margin-block-end: 8px;',
			   	onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'cata/mark' }
					) );
				},
				isActive: props.isActive
			}
		);
	};
	
	const ConditionalButton = wp.compose.compose(
		wp.data.withSelect( function( select ) {
			return {
				selectedBlock: select( 'core/editor' ).getSelectedBlock()
			}
		} ),
		wp.compose.ifCondition( function( props ) {
			return (
				props.selectedBlock &&
				props.selectedBlock.name === 'core/paragraph'
			);
		} )
	)( MarkButton );
	
	wp.richText.registerFormatType(
		'cata/mark',
		{
			title: 'Mark / Highlight',
			tagName: 'mark',
			className: null,
			edit: ConditionalButton
		}
	);

} )( window.wp );
