import { Registry } from 'parchment';
import Engine from './engine';
import BlockComponent from './block-component';

// init blocks
import ImageBlock from './blocks/image';
import HeadingBlock from './blocks/heading';
import SectionBlock from './blocks/section';
import ButtonBlock from './blocks/button';


function required(s: string): Boolean {
  return s.trim().length > 0;
}


interface Config {
  target: HTMLElement;

  id: string;
  title: string;
}


function init({ id, title, target  }: Config) {
  if (!target) throw new Error('"target" is required');

  if (!required(id)) id = 'none';

  if (!required(title)) throw new Error('"title" is required');

  const engine = (new Engine(id, title))
    .adoptBlocks(
      ImageBlock,
      HeadingBlock,
      SectionBlock,
      ButtonBlock,
    );

  engine.mount(target);

  return engine;
}


export default {
  init
}

