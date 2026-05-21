import ActionDispatcher from './action-dispatcher';
import { ActionKind, ActionHandler, DispatchContext } from './types';
import Block, { HeadingProps } from './block';
import BlockComponent from './block-component';
import Workspace, { Context } from './workspace';



export interface ActionNode {  
  createNode(blockComponent: BlockComponent): void;
  removeNode(idx: number): void
  setBlockNode(idx: number, block: Block): void;
  inspectNode(idx: number, blockId: string): void;
}



export default class {
  private  _dispatch: ActionDispatcher;

  private _workspace: Workspace;

  
  constructor(id: string, title: string) {
    this._dispatch = new ActionDispatcher();

    this._workspace = new Workspace({ id, title, version: '1.0.0', issuedAt: Date.now()});

    this._workspace.subscribe((action, value) => {
      const event = 'block-component:' + action as (keyof DispatchContext);
      
      this._dispatch.emit(event, value);
    })
    
  }


  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): void {
    this._dispatch.on(event, handler);
  }


  workspace(): ActionNode {
    return this._workspace;
  }


  destory(): void {
    this._dispatch.removeAllListeners();
  }
}