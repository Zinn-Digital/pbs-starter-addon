/**
 * The starter's block: a notice. Its saved HTML is plain (a heading and a line), styled by
 * style.scss, which WordPress loads only on pages that use the block.
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import metadata from './block.json';
import './style.scss';

type Attributes = { heading: string; text: string };

type EditProps = {
	attributes: Attributes;
	setAttributes: ( next: Partial< Attributes > ) => void;
};

/**
 * The editor view: a named component (React hooks such as useBlockProps run only in one).
 *
 * @param props               Block props.
 * @param props.attributes    The notice's attributes.
 * @param props.setAttributes Updates them.
 */
function Edit( { attributes, setAttributes }: EditProps ) {
	return (
		<div { ...useBlockProps( { className: 'pbs-starter-notice' } ) }>
			<RichText
				tagName="strong"
				placeholder={ __( 'Heading', 'pbs-starter-addon' ) }
				value={ attributes.heading }
				onChange={ ( heading: string ) => setAttributes( { heading } ) }
			/>
			<RichText
				tagName="span"
				placeholder={ __( 'A line of text', 'pbs-starter-addon' ) }
				value={ attributes.text }
				onChange={ ( text: string ) => setAttributes( { text } ) }
			/>
		</div>
	);
}

registerBlockType< Attributes >( metadata as never, {
	edit: Edit,
	save: ( { attributes } ) => (
		<div { ...useBlockProps.save( { className: 'pbs-starter-notice' } ) }>
			<RichText.Content tagName="strong" value={ attributes.heading } />
			<RichText.Content tagName="span" value={ attributes.text } />
		</div>
	),
} );
