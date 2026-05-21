import { DispatchContext, ActionKind, ActionHandler } from './types';


export default class ActionDispatcher {
  private _listeners: Map<string, Set<Function>> = new Map();

  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): this {
    if (!this._listeners.has(event)) {
      this._listeners.set(event, new Set());
    }
    
    this._listeners.get(event)!.add(handler as Function);
    return this;
  }

  off<T extends ActionKind>(event: T, handler: ActionHandler<T>): this {
    this._listeners.get(event)?.delete(handler as Function);
    return this;
  }

  once<T extends ActionKind>(event: T, handler: ActionHandler<T>): this {
    const wrapper = (payload: DispatchContext[T]) => {
      handler(payload);
      this.off(event, wrapper as ActionHandler<T>);
    };
    return this.on(event, wrapper as ActionHandler<T>);
  }

  emit<T extends ActionKind>(event: T, payload: DispatchContext[T]): this {
    this._listeners.get(event)?.forEach((h) => h(payload));
    // wildcard
    this._listeners.get('*')?.forEach((h) => h({ event, payload }));
    return this;
  }

  removeAllListeners(event?: ActionKind): this {
    if (event) {
      this._listeners.delete(event);
    } else {
      this._listeners.clear();
    }
    return this;
  }
}
