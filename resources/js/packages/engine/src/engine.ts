import ActionDispatcher from './action-dispatcher';
import { ActionKind, ActionHandler, DispatchContext } from './types';
import Block, { HeadingProps } from './block';
import BlockComponent from './block-component';
import Workspace, { Context } from './workspace';



export interface ActionNode {  
  createNode(blockComponent: BlockComponent): void;
  removeNode(idx: number): void
  setBlockNode(idx: number, block: Block): void;
  inspect(idx: number, blockId: string): void;
}



export default class {
  private  _dispatch: ActionDispatcher;

  private _workspace: Workspace;

  
  constructor(id: string, title: string) {
    this._dispatch = new ActionDispatcher();

    this._workspace = new Workspace(this, { id, title, version: '1.0.0', issuedAt: Date.now()});
  }


  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): void {
    this._dispatch.on(event, handler);
  }

  onEvent(event: string, value: any): void {
    const eventName = 'block-component:' + event as (keyof DispatchContext);
    
    this._dispatch.emit(eventName, value);
  }


  workspace(): ActionNode {
    return this._workspace;
  }


  destory(): void {
    this._dispatch.removeAllListeners();
  }
}