import { EmbedBlot } from "parchment";

import { BlockProps } from "../block";
import { NodeConfigurator } from "./utils";

export default class Image extends NodeConfigurator(EmbedBlot) {
  static blotName = 'image';

  static tagName = 'img';

  static create<T extends BlockProps>(props: T) {
    const node = super.create() as HTMLElement;

    return this.mergeProps(node, props);
  }
  
}