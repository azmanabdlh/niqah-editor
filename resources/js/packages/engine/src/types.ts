import BlockComponent from './block-component';
import Block from './block';


export type ActionKind = keyof DispatchContext;

export type ActionHandler<T extends ActionKind> = (
  payload: DispatchContext[T]
) => void;



export type DispatchContext = {
  'block-component:remove': string | number; // blockComponentIdx
  'block-component:sorted': BlockComponent; 
  'block-component:inspect': Block;
  'block-component:change': string;  // idx of Array<BlockComponent>
  'block-component:add': BlockComponent;  
};
  

