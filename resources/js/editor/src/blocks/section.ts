import { BlockBlot } from "parchment";

import { BlockProps } from "../block";
import { NodeConfigurator } from "./utils";

export default class SectionBlot extends NodeConfigurator(BlockBlot) {
  static blotName = 'section';

  static tagName = 'section';

  static create<T extends BlockProps>(props: T) {
    const node = super.create();

    return this.mergeProps(node, props);
  }
}