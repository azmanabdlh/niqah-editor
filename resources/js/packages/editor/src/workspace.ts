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


  setBlock(block: Block): void {
    
  }
}