import BlockComponent from './block-component';
import ActionDispatcher from './action-dispatcher';
import Block from './block';


export interface Context {
  version: string;
  id: string;
  title: string;
  issuedAt: number;
}

interface InspectContext {
  containerId: string;
  blockId: string;
}

export default class Workspace {

  private _context: Context;
  
  private  _dispatch: ActionDispatcher;

  private  _blockComponents: BlockComponent[] = [];

  // private _inspect: InspectContext = {};


  constructor(
    dispatch: ActionDispatcher,
    context: Context
  ) {
    this._context = { ...context, issuedAt: Date.now() }

    this._dispatch = dispatch;
    
  }


  add(blockComponent: BlockComponent): void {    
    // TODO: Need to be sorted to the position
    this._blockComponents.push(blockComponent);

    this._dispatch.emit('block-component:add', blockComponent);
  }

  remove(id: string): void {
    this._blockComponents.filter(({id: _id}) => _id != id );
    this._dispatch.emit('block-component:remove', id);
  }
  
  
  inspect(blockId: string): void {
    // this._inspect = { containerId, blockId };
    this._dispatch.emit('block-component:inspect', blockId);    
  }

  blockComponents(): BlockComponent[] {
    return this._blockComponents;
  }

  serialize(): void {
    // this._onChange?.(context);
  }

  setBlock(block: Block): void {
    // if ( Object.keys(this._inspect).length == 0 ) throw new Error('invalid set block');
    
    // const blockComponent = this.blockComponents().find(blockComponent => blockComponent.id == this._inspect.containerId);
    // if (!blockComponent) throw new Error('invalid "containerId"');

    // blockComponent.blocks.map(currBlock =>{
    //   if (currBlock.id === this._inspect.blockId) return block

    //   return currBlock;
    // })
  }
}