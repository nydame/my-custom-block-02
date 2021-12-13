import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

const blockStyle = {
  backgroundColor: '#900',
  color: '#fff',
  padding: '20px',
}
 
registerBlockType( 'pss-blocks/my-first-gutenberg-block', {
  apiVersion: 2,
  title: 'Basic Example with ESNext',
  icon: 'smiley',
  category: 'design',
  example: {},
  edit() {
    const blockProps = useBlockProps({style: blockStyle});
    return (<div { ...blockProps }>Hello World (from the editor)</div>);
  },
  save() {
    const blockProps = useBlockProps.save({style: blockStyle});
    return (<div { ...blockProps }>Hello World (from the frontend)</div>);
  },
} );