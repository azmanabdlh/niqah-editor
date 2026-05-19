import { Registry, ScrollBlot } from "parchment";

import ActionDispatcher from './action-dispatcher';
import { ActionKind, ActionHandler } from './types';
import Block, { HeadingProps } from './block';
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
      fragment.appendChild(
        this.resolveBlocks(root, blockComponent.blocks)
      );
    }

    target.appendChild(fragment);
  }


  destory(): void {
    this._dispatch.removeAllListeners();
  }

  private resolveBlocks(root: ScrollBlot, blocks: Block[]): Node {
    const fragment = document.createDocumentFragment();

    for (const block of blocks) {
      const ctx = {
        tagName: block.node,
        value: block.value, 
        props: block.props 
      }

      const blot = this._registry.create(root, block.name, ctx);

      if (block.children.length > 0) {
        blot.domNode.appendChild(
          this.resolveBlocks(root, block.children)
        );
      }

      fragment.appendChild(blot.domNode);
    }

    return fragment;
  }
}