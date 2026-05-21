
import { BlockProps } from "./block";

export function mergeProps<K extends BlockProps>(
      node: HTMLElement,
      props: K,
    ): HTMLElement {
  Object.entries(props).forEach(([k,v]) => {
    if (k == "className") {
      node.classList.add(v);
      return;
    }
    node.setAttribute(k, v);
  });

  return node;
}
