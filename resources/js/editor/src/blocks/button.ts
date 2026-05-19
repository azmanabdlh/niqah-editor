import { EmbedBlot } from "parchment";

import { BlockProps } from "../block";
import { NodeConfigurator } from "./utils";


export default class ButtonBlot extends NodeConfigurator(EmbedBlot) {
  static blotName = 'button';

  static tagName = 'button';

  static create<T extends BlockProps>(props: T) {
    const node = super.create() as HTMLElement;

    return this.mergeProps(node, props);
  }
}