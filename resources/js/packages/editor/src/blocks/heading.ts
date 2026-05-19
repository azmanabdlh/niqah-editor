import { BlockBlot } from "parchment";
import { BlockContext, SectionProps } from "../block";

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


  static create(context: BlockContext<SectionProps>) {
    const node =  document.createElement(context.tagName);
    node.innerText = context.value;

    return this.mergeProps(node, context.props);
  }

  
}
