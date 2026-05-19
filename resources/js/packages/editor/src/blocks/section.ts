import { BlockBlot } from "parchment";

import { BlockContext, SectionProps } from "../block";
import { NodeConfigurator } from "./utils";

export default class SectionBlot extends NodeConfigurator(BlockBlot) {
  static blotName = 'section';

  static tagName = 'section';

  static create(context: BlockContext<SectionProps>) {
    const node = super.create();

    return this.mergeProps(node, context.props);
  }
}