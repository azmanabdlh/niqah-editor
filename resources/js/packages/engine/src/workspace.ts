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


export type WorkspaceEventType =
  | 'add'
  | 'remove'
  | 'change'
  | 'inspect'
  | 'clear';

type ListenerFunc = (
  event: WorkspaceEventType,
  value: any
) => void

export default class Workspace {

  private context: Context;

  private blockComponents: BlockComponent[] = [];

  private inspect: string = '';

  private listeners = new Set<ListenerFunc>();


  constructor(context: Context) {    
    this.context = context;

  }


  subscribe(fn: ListenerFunc) {
    this.listeners.add(fn);

    return () => {
      this.listeners.delete(
        fn,
      );
    }
  }


  private notify(
    event: WorkspaceEventType,
    value: any
  ): void {
    this.listeners.forEach(fn =>
      fn(event, value),
    );
  }


  createNode(blockComponent: BlockComponent): void {
    // TODO: Need to be sorted to the position
    this.data().push(blockComponent);

    this.notify('add', blockComponent);
  }

  removeNode(idx: number): void {
    this.data().splice(idx, 1);

    this.notify('remove', idx);
  }

  setBlockNode(idx: number, block: Block): void {
    let blockId = this.data()[idx].blocks.findIndex(block => block.id == this.inspect);
    this.data()[idx].blocks[blockId] = block;

    this.notify('change', idx);
  }
  
  
  inspectNode(idx: number, blockId: string): void {
    this.inspect = blockId;
    const block = this.data()[idx].blocks.find(block => block.id == blockId);
    
    this.notify('inspect', block);
  }

  data(): BlockComponent[] {
    return this.blockComponents;
  }
}