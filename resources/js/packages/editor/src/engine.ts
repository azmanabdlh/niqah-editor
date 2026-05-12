import { Registry, ScrollBlot, Root, Blot } from "parchment";

import ActionDispatcher from './action-dispatcher';
import { ActionKind, ActionHandler } from './types';
import Block, { HeadingProps } from './block';
import BlockComponent from './block-component';
import Workspace, { Context } from './workspace';



interface WorkspaceCommand {  
  add(blockComponent: BlockComponent): void;
  remove(blockComponentId: string): void;
  
  inspect(blockId: string): void;  
  setBlock(block: Block): void
}

export interface BlockNode extends Blot {}


export default class {

  private  _dispatch: ActionDispatcher;

  private _workspace: Workspace;

  private _registry: Registry;

  private _root: Root;

  constructor(id: string, title: string) {
    const ctx = { id, title, version: '1.0.0' } as Context;

    this._dispatch = new ActionDispatcher();
    this._workspace = new Workspace(this._dispatch, ctx);
    this._registry = new Registry();

    this._root =  new ScrollBlot(
      this._registry,
      document.createElement('div'),
    );
    
  }

  workspace(): WorkspaceCommand {
    return this._workspace;
  }

  adoptBlocks(...definitions: any[]): this {
    this._registry.register(...definitions)
    return this;
  }

  resolve(block: Block): BlockNode {
    const ctx = {
      tagName: block.node,
      value: block.value, 
      props: block.props 
    }

    const blot = this._registry.create(
      this._root,
      block.node,
      ctx
    )

    return blot;
  }


  destory(): void {
    this._dispatch.removeAllListeners();
  }
}