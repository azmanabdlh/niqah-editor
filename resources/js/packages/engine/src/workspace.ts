import BlockComponent from './block-component';
import ActionDispatcher from './action-dispatcher';
import Block from './block';

interface EngineListener {
  onEvent: (event: string, value: any) => void;
}

export interface Context {
  version: string;
  id: string;
  title: string;
  issuedAt: number;
}


export default class Workspace {

  private _context: Context;
  
  private  _engine: EngineListener;

  private  _blockComponents: BlockComponent[] = [];

  private _inspect: string;


  constructor(
    engine: EngineListener,
    context: Context
  ) {    
    this._context = context;
    this._engine = engine;
  }


  createNode(blockComponent: BlockComponent): void {
    // TODO: Need to be sorted to the position
    this.blockComponents().push(blockComponent);

    this._engine.onEvent('add', blockComponent);
  }

  removeNode(idx: number): void {
    this.blockComponents().splice(idx, 1);

    this._engine.onEvent('remove', idx);
  }

  setBlockNode(idx: number, block: Block): void {
    let blockId = this.blockComponents()[idx].blocks.findIndex(block => block.id == this._inspect);
    this.blockComponents()[idx].blocks[blockId] = block;

    this._engine.onEvent('change', idx);
  }
  
  
  inspect(idx: number, blockId: string): void {
    this._inspect = blockId;
    const block = this.blockComponents()[idx].blocks.find(block => block.id == blockId);
    
    this._engine.onEvent('inspect', block);
  }

  blockComponents(): BlockComponent[] {
    return this._blockComponents;
  }
}