import ActionDispatcher from './action-dispatcher';
import Canvas from './canvas';
import { ActionKind, ActionHandler } from './types';
import { BlockBehaviorKind, BlockBehaviorContext } from './block';
import BlockComponent from './block-component';


export interface Config {
  id: string;
  title: string;  
}



export default class Editor {

  private  _dispatch: ActionDispatcher;

  private _config: Config;

  private _blockComponents: BlockComponent[] = [];

  private _blockBehavior: Map<BlockBehaviorKind, BlockBehaviorContext[BlockBehaviorKind]> = new Map();

  
  
  constructor(config: Config) {
    this._config = {
      id: config.id,
      title: config.title,
    };

    this._dispatch = new ActionDispatcher();
  }

  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): this {
    this._dispatch.on(event, handler);
    return this;
  }

  /**
   * Register block behavior
   * @param name The name of the behavior.
   * @param behavior The behavior object to register.
   * 
   *  editor.addBlockBehavior("__Text", {
   *     onChange: (newText) => {
   *       console.log(newText);
   *     }
   *  })
   */
  addBlockBehavior<K extends BlockBehaviorKind>(name: K, behavior: BlockBehaviorContext[K]): this {      
    this._blockBehavior.set(name, behavior);
    return this;
  }

  adoptBlockComponents(blockComponents: BlockComponent[] | string[]): this {
    blockComponents.forEach(blockComponent => {
      if (typeof blockComponent === 'string') {
        blockComponent = BlockComponent.fromJSON(blockComponent);
      }

      this._blockComponents.push(blockComponent);
    });

    return this;
  }

  blockComponents(): BlockComponent[] {
    return this._blockComponents;
  }

  mount(canvas: Canvas): void {
    
  }


  private destory(): void {
    this._dispatch.removeAllListeners();
  }

}