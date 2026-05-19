import { BlockBlot } from "parchment";
import { BlockProps } from "../block";

import { NodeConfigurator } from "./utils";



export default class Heading extends NodeConfigurator(BlockBlot) {
  static blotName = 'heading';

  static tagName = [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
  ];


  static create<T extends BlockProps>(props: T) {
    const node = super.create() as HTMLElement;

    return this.mergeProps(node, props);
  }

  
}
