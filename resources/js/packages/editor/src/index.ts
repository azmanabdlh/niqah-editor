import { Registry } from 'parchment';
import Engine from './engine';
import BlockComponent from './block-component';

// init blocks
import ImageBlock from './blocks/image';
import HeadingBlock from './blocks/heading';
import SectionBlock from './blocks/section';
import ButtonBlock from './blocks/button';
import engine from './engine';


function required(s: string): Boolean {
  return s.trim().length > 0;
}


interface Config {
  target: HTMLElement;

  id: string;
  title: string;

  resolve: () => Promise<BlockComponent[]>;
}


async function init(config: Config): Promise<Engine> {
  // if (!config.target) throw new Error('"target" is required');

  if (!required(config.id)) config.id = 'none';

  if (!required(config.title)) throw new Error('"title" is required');

  const engine = (new Engine(config.id, config.title))
      .adoptBlocks(
        ImageBlock,
        HeadingBlock,
        SectionBlock,
        ButtonBlock,
      );
  const workspace = engine.workspace();
  
  const blockComponents = await config.resolve();
  
  for(const blockComponent of blockComponents) {
    workspace.add(blockComponent);
  }

  // engine.mount(config.target);
  return engine;
}


export default {
  init
}

