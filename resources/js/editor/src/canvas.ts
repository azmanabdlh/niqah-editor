import BlockComponent from './block-component';
import { CanvasContext } from './types';


export default class Canvas {

  private  _blockComponents: BlockComponent[] = [];

  private  _activeComponents: BlockComponent[] = [];

  private  _id: string;
  
  private  _title: string;

  private  _createdAt: string = Date.now().toString();

  private _onChange?: (context: CanvasContext) => void;

  constructor(id: string, title: string) {
    this._id = id;
    this._title = title;
    this._createdAt = Date.now().toString();    
  }

  onChange(handler: (context: CanvasContext) => void): this {
    this._onChange = handler;
    return this;
  }
  
  addBlockComponent(name: string, blockComponent: BlockComponent): void {
    this._blockComponents.push(blockComponent);    
  }

  removeBlockComponent(blockComponentId: string): void {
    this._blockComponents = this._blockComponents.filter((component) => component.id !== blockComponentId);
  }

  mount(activeComponents: BlockComponent[]): void {
    
  }

}