import { BlockType, AttributeSet } from './block';
import BlockComponent from './block-component';



export interface CanvasContext {
  version: string;
  context: {
    id: string;
    title: string;
    createdAt: string;
    updatedAt: string;
  };
  blockComponents: BlockComponent[]
}


export type ActionKind = keyof DispatchContext;

export type ActionHandler<T extends ActionKind> = (
  payload: DispatchContext[T]
) => void;



export type DispatchContext = {
  'block-component:add': BlockComponent;
  'block-component:release': string;
  'block-component:change': { id: string; changes: Partial<BlockComponent> };
  'block-component:selected': string;  
  
  'save': CanvasContext;
  'saved': unknown;
  
  'publish': CanvasContext;
  'published': unknown;
  
  'editor:ready': void;
  'editor:submit': CanvasContext
};
  

