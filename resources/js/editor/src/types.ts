import { BlockType, AttributeSet } from './block';
import BlockComponent from './block-component';



export type ActionKind = keyof DispatchContext;

export type ActionHandler<T extends ActionKind> = (
  payload: DispatchContext[T]
) => void;



export type DispatchContext = {
  'block-component:add': BlockComponent;
  'block-component:remove': string;
  'block-component:sorted': string;
  'block-component:inspect': string; 
  
  'block:selected': string;  

  'workspace:change': string;
};
  

