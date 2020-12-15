import { registerBlockType } from '@wordpress/blocks';
import { TextControl, PanelBody, PanelRow } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render'


registerBlockType(
    'mtv/basic',
    {
        title: 'Basic Block',
        description: 'Este es nuestro primer bloque',
        icon: 'smiley',
        category: 'layout',
        attributes: {
            content: {
                type: 'string',
                default: 'Hello World'
            }
        },
        edit: (props) => {
            const {
                attributes: {content},
                setAttributes,
                className,
                isSelected,
            } = props;

            // Función para guardar el atributo content
            const handlerOnChangeInput = (newContent) => {
                setAttributes({content: newContent})
            }
            return  <> 
                <InspectorControls>
                    <PanelBody  // Primer panel en el sidebar
                        title= 'Modificar texto del bloque básico'
                        initialOpen={false}
                    >
                        <PanelRow>
                            <TextControl
                                label= 'Complete el campo'  // Indicaciones del campo 
                                value= {content} // Asignacion del atributo correspondiente
                                onChange= {handlerOnChangeInput} // Asignacion de función para gestionar el evento OnChange
                            />
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender   // Renderizado del bloque dinámico
                    block= 'mtv/basic'  // Nombre del bloque
                    attributes={props.attributes}   // Se envían todos los atributos
                />
            </>    
        },   // mostrar como se verá en el editor
        // save: (props) => <h2>{props.attributes.content}</h2>    // lo que procesará nuestro front
        save: () => null
    }
)