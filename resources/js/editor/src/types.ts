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
  'block-component:remove': string;
  'block-component:update': { id: string; changes: Partial<BlockComponent> };
  'block-component:selected': string;
  'block-component:release': string | null;
  'canvas:change': CanvasContext;
  'canvas:clear': void;
  'save:before': CanvasContext;
  'save:after': unknown;
  'publish:before': CanvasContext;
  'publish:after': unknown;
  'editor:ready': void;
  'editor:destroy': void;
};
  

