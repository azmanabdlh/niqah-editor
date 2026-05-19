import { BlockProps } from "../block";

type Constructor<T = {}> = new (...args: any[]) => T;

export function NodeConfigurator<T extends Constructor>(Base: T) {
  return class extends Base {
    

    static mergeProps<K extends BlockProps>(
      node: HTMLElement,
      props: K,
    ): HTMLElement {
      Object.entries(props).forEach(([k,v]) => {
        if (k == "className") {
          node.classList.add(v);
          return;
        }
        node.setAttribute(k, v);
      })

      return node;
    }

  };
}