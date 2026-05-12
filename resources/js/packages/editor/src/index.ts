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
  id: string;
  title: string;
}


function init(config: Config): Engine {
  if (!required(config.id)) config.id = 'none';

  if (!required(config.title)) throw new Error('"title" is required');

  return (new Engine(config.id, config.title))
          .adoptBlocks(
            ImageBlock,
            HeadingBlock,
            SectionBlock,
            ButtonBlock,
          );            
}


export default {
  init
}

