import ActionDispatcher from './action-dispatcher';
import Canvas from './canvas';
import { ActionKind, ActionHandler } from './types';


export interface EditorConfig {
  id: string;
  title: string;
  autoSaveInterval: number; // ms  
}


export default class Editor {
  private readonly _dispatch: ActionDispatcher;

  private _config: EditorConfig;

  private _canvas: Canvas;

  constructor(config: Partial<EditorConfig>) {
    this._config = {
      id: "niqah-editor",
      title: "Untitled Page",
      autoSaveInterval: 0,      
      ...config,
    };

    this._dispatch = new ActionDispatcher();
    this._canvas = new Canvas(this._config.id, this._config.title);

    this._canvas.onChange((context) => {
      this._dispatch.emit('canvas:change', context);
      // this.onStateChange?.(context.blockComponents);
    });
  }

  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): this {
    this._dispatch.on(event, handler);
    return this;
  }

  private isAutoSave(): boolean {
    return this._config.autoSaveInterval > 0;
  }

}

