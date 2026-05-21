import { ActionKind, ActionHandler, DispatchContext } from './types';
import Engine, { ActionNode } from './engine';
import BlockComponent from './block-component';

function required(s: string): Boolean {
  return s.trim().length > 0;
}


interface EngineAction {
  on<T extends ActionKind>(event: T, handler: ActionHandler<T>): void;
  workspace(): ActionNode;
  destory(): void;
}

export default {
  init(id: string, title: string): EngineAction {
    if (!required(id)) id = 'none';

    if (!required(title)) throw new Error('"title" is required');

    return (new Engine(id, title));
  }
}
