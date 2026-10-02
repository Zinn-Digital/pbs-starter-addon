/**
 * A panel on Page Builder Sandwich's admin screen, typed with @zinn-digital/pbs-types: it lists
 * what add-ons registered (GET /pbs/v1/extensions).
 */
import { addFilter } from '@wordpress/hooks';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import type { PbsFilters, ExtensionsResponse } from '@zinn-digital/pbs-types';

function ExtensionsPanel() {
	const [ ext, setExt ] = useState< ExtensionsResponse | null >( null );
	useEffect( () => {
		apiFetch< ExtensionsResponse >( { path: '/pbs/v1/extensions' } ).then( setExt );
	}, [] );
	if ( ! ext ) {
		return null;
	}
	const count = Object.values( ext ).reduce( ( n, list ) => n + list.length, 0 );
	return (
		<div className="pbs-starter-extensions">
			<h2>{ __( 'Add-on extensions', 'pbs-starter-addon' ) }</h2>
			<p>
				{ count } { __( 'registered (blocks, style controls, sources, conditions, form actions).', 'pbs-starter-addon' ) }
			</p>
		</div>
	);
}

addFilter(
	'pbs.admin.panels',
	'pbs-starter/extensions',
	( list: PbsFilters[ 'pbs.admin.panels' ] ): PbsFilters[ 'pbs.admin.panels' ] => [
		...list,
		{ name: 'pbs-starter-extensions', Component: ExtensionsPanel },
	]
);
