import { Registry, ScrollBlot } from "parchment";

import ActionDispatcher from './action-dispatcher';
import { ActionKind, ActionHandler } from './types';
import Block from './block';
import BlockComponent from './block-component';
import Workspace, { Context } from './workspace';



interface WorkspaceAction {  
  add(blockComponent: BlockComponent): void;
  remove(blockComponentId: string): void;
  
  inspect(blockId: string): void;  
  setBlock(block: Block): void
}

export default class {

  private  _dispatch: ActionDispatcher;

  private _workspace: Workspace;

  private _registry: Registry;

  constructor(id: string, title: string) {
    const ctx = { id, title, version: '1.0.0' } as Context;

    this._dispatch = new ActionDispatcher();
    this._workspace = new Workspace(this._dispatch, ctx);
    this._registry = new Registry();
    
  }

  workspace(): WorkspaceAction {
    return this._workspace;
  }

  adoptBlocks(...definitions: any[]): this {
    this._registry.register(...definitions)
    return this;
  }

  mount(target: HTMLElement): void {
    const blockComponents = this._workspace.blockComponents();
    const fragment = document.createDocumentFragment();
  
    const root = new ScrollBlot(
      this._registry,
      document.createElement('div'),
    );

    for(const blockComponent of blockComponents) {
      // TODO:
      // add indetifier
      const sectionNode = document.createElement('section');
      
      for (const block of blockComponent.blocks) {
        const node = document.createElement(block.node);
        const blot = this._registry.create(root, node, block.props);
        
        sectionNode.appendChild(blot.domNode);
      }


      fragment.appendChild(sectionNode);
    }

    
    // mount to target
    target.appendChild(fragment);
  }

  destory(): void {
    this._dispatch.removeAllListeners();
  }

}